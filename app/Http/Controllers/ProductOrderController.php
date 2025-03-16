<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\OptionValue;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductOrderRequest;
use App\Notifications\OrderCreatedNotification;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $orders = ProductOrder::all();
        return view('admin.product-orders.index', compact('orders'));
    }

    /**
     * Store a newly created product order in storage.
     *
     * @param  \App\Http\Requests\StoreProductOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            // Get the product
            $product = Product::findOrFail($request->product_id);
            // Calculate total price and prepare order data
            $orderData = $this->prepareOrderData($request, $product);
            // Create the order
            $order = ProductOrder::create($orderData);
            DB::commit();
            try {
                $order->customer->notify(new OrderCreatedNotification($order, false, 'product'));
                app(\App\Services\NotificationService::class)->notifyAdmin(new \App\Notifications\OrderCreatedNotification($order, true, 'product'));
            } catch (\Exception $e) {
                \Log::error('Error notifying customer: ' . $e->getMessage());
            }
            return $this->handleOrderResponse($request, $order);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order creation error: ' . $e->getMessage());
            return $this->handleOrderError($request, $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductOrder $productOrder)
    {
        return view('admin.product-orders.show', compact('productOrder'));
    }

    /**
     * Display the order success page.
     *
     * @param  \App\Models\ProductOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function success(ProductOrder $order)
    {
        // Check if the order belongs to the current user
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        return view('product-order-success', compact('order'));
    }

    /**
     * Get requirements for selected option values.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRequirements(Request $request)
    {
        $selectedOptions = json_decode($request->options, true);
        $requirements = [];

        foreach ($selectedOptions as $option) {
            $optionValue = OptionValue::with('requirements')->find($option['valueId']);

            if ($optionValue && $optionValue->requirements->count() > 0) {
                foreach ($optionValue->requirements as $requirement) {
                    $requirements[] = [
                        'id' => $requirement->id,
                        'ar_name' => $requirement->ar_name,
                        'en_name' => $requirement->en_name,
                        'type' => $requirement->type,
                        'required' => $requirement->required,
                        'option_value_name' => $option['optionName'] . ': ' . $option['valueName']
                    ];
                }
            }
        }

        return response()->json([
            'requirements' => $requirements
        ]);
    }

    /**
     * Show the payment page for an order.
     *
     * @param  \App\Models\ProductOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function payment(ProductOrder $order)
    {
        // Check if the order belongs to the current user
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        // Check if the order is already paid
        if ($order->is_paid) {
            flash()->info(__('This order has already been paid.'));
            return redirect()->route('product.order.success', $order->id);
        }

        return view('product-order-payment', [
            'order' => $order,
            'publishable_key' => config('services.moyasar.publishable_key'),
        ]);
    }

    /**
     * Handle payment callback.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentCallback(Request $request)
    {
        $paymentId = $request->input('id');

        // Verify the payment by fetching it from Moyasar API
        $response = Http::withBasicAuth(config('services.moyasar.secret_key'), '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if ($response->successful()) {
            $paymentData = $response->json();

            // Extract order ID from the description (format: "Order #ORD12345")
            $orderNumber = null;
            if (preg_match('/Order #(ORD\d+)/', $paymentData['description'], $matches)) {
                $orderNumber = $matches[1];
            }

            $order = ProductOrder::where('order_number', $orderNumber)->firstOrFail();

            switch ($paymentData['status']) {
                case 'paid':
                case 'captured':
                    // Convert amount from halala/cents to the actual currency
                    $paidAmount = $paymentData['amount'] / 100;

                    if ($paidAmount == $order->total) {
                        // Create a payment record using the Payment model
                        $payment = Payment::create([
                            'order_id' => $order->id,
                            'amount' => $paidAmount,
                            'method' => $paymentData['source']['type'],
                            'details' => json_encode($paymentData),
                            'invoice_number' => 'INV-' . $order->order_number,
                            'status' => 'paid',
                            'type' => 'in',
                            'date' => now()->toDateString(),
                        ]);

                        // Update the order
                        $order->update([
                            'is_paid' => true,
                            'payment_id' => $paymentId,
                            'data' => array_merge($order->data ?? [], [
                                'payment' => [
                                    'id' => $paymentId,
                                    'method' => $paymentData['source']['type'],
                                    'amount' => $paidAmount,
                                    'currency' => $paymentData['currency'],
                                    'date' => now()->toDateTimeString(),
                                ]
                            ])
                        ]);

                        flash()->success(__('Payment successful!'));
                        return redirect()->route('product.order.success', $order->id);
                    } else {
                        flash()->error(__('Payment amount mismatch. Please contact support.'));
                        return redirect()->route('product.order.payment', $order->id);
                    }

                case 'failed':
                    // Create a payment record with failed status
                    Payment::create([
                        'order_id' => $order->id,
                        'amount' => $order->total,
                        'method' => $paymentData['source']['type'] ?? 'unknown',
                        'details' => json_encode($paymentData),
                        'invoice_number' => 'INV-' . $order->order_number,
                        'status' => 'failed',
                        'type' => 'in',
                        'date' => now()->toDateString(),
                    ]);

                    flash()->error(__('Payment failed. Please try again.'));
                    return redirect()->route('product.order.payment', $order->id);

                default:
                    return redirect()->route('product.order.payment', $order->id)
                        ->with('warning', __("Unexpected payment status: {$paymentData['status']}. Please contact support."));
            }
        } else {
            // API request failed
            flash()->error(__('Unable to verify payment. Please contact support.'));
            return redirect()->route('customer.orders.index');
        }
    }

    /**
     * Prepare order data from request and product
     *
     * @param  \App\Http\Requests\StoreProductOrderRequest  $request
     * @param  \App\Models\Product  $product
     * @return array
     */
    private function prepareOrderData(StoreProductOrderRequest $request, Product $product)
    {
        // Calculate subtotal and get selected options
        $subtotalData = $this->calculateSubtotal($request, $product);
        $subtotal = $subtotalData['subtotal'];
        $selectedOptions = $subtotalData['selectedOptions'];
        // Use the total price from the form if provided, otherwise use calculated subtotal
        $total = $request->has('total_price') ? $request->total_price : $subtotal;
        // Prepare order data
        $orderData = [
            'product_id' => $product->id,
            'customer_id' => Auth::id(),
            'subtotal' => $subtotal,
            'total' => $total,
            'order_number' => 'ORD' . time() . rand(100, 999),
            'data' => [
                'product' => [
                    'name' => $product->{app()->getLocale() . '_name'},
                    'base_price' => $product->base_price,
                    'description' => $product->{app()->getLocale() . '_description'},
                ],
                'selected_options' => $selectedOptions,
                'notes' => $request->notes,
            ]
        ];
        // Handle requirements if any
        if ($request->has('requirements')) {
            $orderData['data']['requirements'] = $this->processRequirements($request);
        }
        return $orderData;
    }

    /**
     * Calculate subtotal and process selected options
     *
     * @param  \App\Http\Requests\StoreProductOrderRequest  $request
     * @param  \App\Models\Product  $product
     * @return array
     */
    private function calculateSubtotal(StoreProductOrderRequest $request, Product $product)
    {
        $subtotal = $product->base_price;
        $selectedOptions = [];
        if ($request->has('options')) {
            // \Log::info($request->options);
            foreach ($request->options as $optionId => $valueId) {
                $optionValue = OptionValue::findOrFail($valueId);
                $subtotal += $optionValue->price;

                // Store selected option details
                $selectedOptions[] = [
                    'option_id'     => $optionId,
                    'value_id'      => $valueId,
                    'option_name'   => $optionValue->option->{app()->getLocale() . '_name'},
                    'value_name'    => $optionValue->{app()->getLocale() . '_value'},
                    'price'         => $optionValue->price
                ];
            }
        }
        return [
            'subtotal'          => $subtotal,
            'selectedOptions'   => $selectedOptions
        ];
    }

    /**
     * Process requirements from the request
     *
     * @param  \App\Http\Requests\StoreProductOrderRequest  $request
     * @return array
     */
    private function processRequirements(StoreProductOrderRequest $request)
    {
        $requirementsData = [];

        foreach ($request->requirements as $requirementId => $value) {
            // Check if it's a file upload
            if ($request->hasFile("requirements.$requirementId")) {
                $requirementsData[$requirementId] = $this->handleFileUpload($request->file("requirements.$requirementId"));
            }
            // Check if it's a base64 image (from business card designer)
            else if (is_string($value) && strpos($value, 'data:image') === 0) {
                $requirementsData[$requirementId] = $this->handleBase64Image($value, $requirementId);
            }
            // Regular text input
            else {
                $requirementsData[$requirementId] = [
                    'value' => $value,
                    'type' => 'text'
                ];
            }
        }

        return $requirementsData;
    }

    /**
     * Handle file upload for requirements
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return array
     */
    private function handleFileUpload($file)
    {
        $path = $file->store('requirements', 'public');
        return [
            'value' => $path,
            'type' => 'file',
            'original_name' => $file->getClientOriginalName()
        ];
    }

    /**
     * Handle base64 image for requirements
     *
     * @param  string  $base64Image
     * @param  string  $requirementId
     * @return array
     */
    private function handleBase64Image($base64Image, $requirementId)
    {
        // Extract the base64 data
        $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
        $decodedImage = base64_decode($imageData);

        // Generate a unique filename
        $filename = 'business_card_' . time() . '_' . $requirementId . '.png';
        $path = 'requirements/' . $filename;

        // Store the image
        Storage::disk('public')->put($path, $decodedImage);

        return [
            'value' => $path,
            'type' => 'custom_design',
            'original_name' => 'business_card.png'
        ];
    }

    /**
     * Handle response after successful order creation
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductOrder  $order
     * @return \Illuminate\Http\Response
     */
    private function handleOrderResponse(Request $request, ProductOrder $order)
    {
        // For AJAX requests, return JSON response
        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success'       => true,
                'order_id'      => $order->id,
                'redirect_to_payment' => false,
                'payment_url'   => null,
                'success_url'   => route('checkout', $order->id)
            ]);
        }
        // For regular form submissions, redirect
        return redirect()->route('checkout', $order->id);
    }

    /**
     * Handle error response when order creation fails
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    private function handleOrderError(Request $request, \Exception $exception)
    {
        // For AJAX requests, return JSON response
        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => __('There was an error processing your order. Please try again.'),
                'error' => config('app.debug') ? $exception->getMessage() : null
            ], 500);
        }

        // For regular form submissions, redirect with error
        flash()->error(__('There was an error processing your order. Please try again.'));
        return redirect()->back()->withInput();
    }

    /**
     * Update the status of a product order
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(ProductOrder $productOrder, Request $request)
    {
        $productOrder->update(['status' => $request->status]);
        flash()->success(__('Order status updated successfully.'));
        return redirect()->back();
    }
}
