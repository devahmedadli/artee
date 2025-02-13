<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\OrderCreatedNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders         = Order::where('admin_archived', false)->with('customer')->get();
        $freelancers    = User::where('role', 'freelancer')->get();
        // dd($orders);
        return view('admin.orders.index', compact('orders', 'freelancers'));
    }

    public function customerIndex()
    {
        $orders = Order::with('customer')->where('customer_id', Auth::user()->id)->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function freelancerIndex()
    {
        $orders = Order::with('customer')->where('freelancer_id', Auth::user()->id)->get();
        return view('freelancer.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = User::all();
        return view('admin.orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\StoreOrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $data               = $request->validated();
        $data['customer_id'] = Auth::user()->id;
        $order = Order::create($data);
        // storing attachments and adding to order attachments table
        foreach ($request->attachments as $attachment) {
            // 
            $path = $attachment->store('attachments/' . $order->id, 'public');
            $order->attachments()->create([
                'path' => $path,
                'name' => $attachment->getClientOriginalName(),
            ]);
        }
        // send email to customer
        // $order->customer->notify(new OrderCreatedNotification($order));
        // try {
        //     app(\App\Services\NotificationService::class)->notifyAdmin(new \App\Notifications\OrderCreatedNotification($order, true));
        // } catch (\Exception $e) {
        //     \Log::error('Error notifying admin: ' . $e->getMessage());
        // }

        flash()->success(__('Order created successfully.'));
        return to_route('customer.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        // ($order->assignedTo)
        $freelancers = User::where('role', 'freelancer')->get();
        // dd($order->offers);
        return view('admin.orders.show', compact('order', 'freelancers'));
    }
    public function freelancerShow(Order $order)
    {
        return view('freelancer.orders.show', compact('order'));
    }

    public function customerShow(Order $order)
    {
        $services = Service::all();
        return view('customer.orders.show', compact('order', 'services'));
    }

    public function edit(Order $order)
    {
        $customers = User::all();
        return view('admin.orders.edit', compact('order', 'customers'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        flash()->success(__('Order updated successfully.'));
        return to_route('customer.orders.show', $order->id);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        flash()->success(__('Order deleted successfully.'));
        return to_route('orders.index');
    }

    public function cancel(Order $order)
    {
        $order->update(['status' => 'canceled']);
        flash()->success(__('Order canceled successfully.'));
        return to_route('customer.orders.index');
    }
    public function freelancerUpload(Request $request, Order $order)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif|max:2048',
        ]);

        foreach ($request->files as $file) {
            $file->store('attachments');
            $order->files()->create([
                'path' => $file->hashName(),
                'name' => $file->getClientOriginalName(),
            ]);
        }
        flash()->success(__('Files uploaded successfully.'));
        return to_route('freelancer.orders.show', $order->id);
    }

    // reject order
    public function reject(Order $order)
    {
        $order->update(['status' => 'rejected', 'admin_archived' => true]);
        flash()->success(__('Order rejected successfully.'));
        return to_route('orders.index');
    }

    public function freelancerMarkCompleted(Order $order)
    {
        $order->update(['status' => 'needs_approval']);
        flash()->success(__('Order marked as completed successfully.'));
        return to_route('freelancer.orders.show', $order->id);
    }
    public function setPrice(Request $request, Order $order)
    {
        $request->validate(
            [
                'subtotal' => 'required|numeric',
                'discount' => 'required|numeric',
            ],
            [
                'subtotal.required' => __('Cost is required.'),
                'subtotal.numeric'  => __('Cost must be a number.'),
                'discount.required' => __('Discount is required.'),
                'discount.numeric'  => __('Discount must be a number.'),
            ]
        );
        $order->update(
            [
                'subtotal'      => $request->subtotal,
                'discount'      => $request->discount,
                'total'         => $request->subtotal - $request->discount,
            ]
        );
        flash()->success(__('Order price set successfully.'));
        return to_route('orders.show', $order->id);
    }
    public function customerAcceptOffer(Order $order)
    {
        $order->update(['customer_accepted' => true]);
        flash()->success(__('Offer accepted successfully.'));
        return to_route('customer.orders.show', $order->id);
    }
    public function approve(Order $order)
    {
        $order->update(['status' => 'completed']);
        flash()->success(__('Order approved successfully.'));
        return to_route('admin.orders.show', $order->id);
    }
}
