<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Moyasar\Moyasar;
use Moyasar\Providers\PaymentService;

class MoyasarController extends Controller
{
    public function checkout(Order $order)
    {
        return view('payments.moyasar.checkout', [
            'order' => $order,
            'publishable_key' => config('services.moyasar.publishable_key'),
            'apple_pay_label' => 'Artee Payment',
            'apple_pay_validate_url' => route('apple-pay.validate'),
            'country' => 'SA'
        ]);
    }

    public function callback(Request $request)
    {
        $paymentId = $request->input('id');

        Moyasar::setApiKey(config('services.moyasar.secret_key'));

        $paymentService = new PaymentService();
        $payment = $paymentService->fetch($paymentId);

        // Check if this is a product order or regular order
        if (isset($payment->metadata['order_type']) && $payment->metadata['order_type'] === 'product') {
            return $this->handleProductOrderPayment($payment);
        } else {
            return $this->handleRegularOrderPayment($payment);
        }
    }

    /**
     * Handle payment for regular orders
     *
     * @param  \Moyasar\Providers\PaymentService $payment
     * @return \Illuminate\Http\Response
     */
    private function handleRegularOrderPayment($payment)
    {
        if ($payment->status === 'paid') {
            // Payment successful, update your order status
            $order = Order::where('id', $payment->metadata['order_id'])->firstOrFail();
            $order->update(['status' => 'paid', 'is_paid' => true]);

            flash()->success(__('Payment successful!'));
            return redirect()->route('customer.orders.show', $order)->with('success', 'Payment successful!');
        } else {
            // Payment failed
            flash()->error(__('Payment failed. Please try again.'));
            return redirect()->route('checkout')->with('error', 'Payment failed. Please try again.');
        }
    }

    /**
     * Handle payment for product orders
     *
     * @param  \Moyasar\Providers\PaymentService $payment
     * @return \Illuminate\Http\Response
     */
    private function handleProductOrderPayment($payment)
    {
        $order = ProductOrder::where('id', $payment->metadata['order_id'])->firstOrFail();

        switch ($payment->status) {
            case 'paid':
            case 'captured':
                // Convert amount from halala/cents to the actual currency
                $paidAmount = $payment->amount / 100;
                
                if ($paidAmount == $order->total) {
                    // Update the order
                    $order->update([
                        'is_paid' => true, 
                        'payment_id' => $payment->id,
                        'data' => array_merge($order->data ?? [], [
                            'payment' => [
                                'id' => $payment->id,
                                'method' => $payment->source->type,
                                'amount' => $paidAmount,
                                'currency' => $payment->currency,
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
                flash()->error(__('Payment failed. Please try again.'));
                return redirect()->route('product.order.payment', $order->id);
                
            default:
                flash()->warning(__("Unexpected payment status: {$payment->status}. Please contact support."));
                return redirect()->route('product.order.payment', $order->id);
        }
    }
}
