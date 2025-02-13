<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        if ($payment->status === 'paid') {
            // Payment successful, update your order status
            $order = Order::where('id', $payment->metadata['order_id'])->firstOrFail();
            $order->update(['status' => 'paid']);

            return redirect()->route('orders.show', $order)->with('success', 'Payment successful!');
        } else {
            // Payment failed
            return redirect()->route('checkout')->with('error', 'Payment failed. Please try again.');
        }
    }
}
