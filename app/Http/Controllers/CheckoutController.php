<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function checkout(Order $order)
    {
        return view('payments.moyasar.checkout', [
            'order' => $order,
            'publishable_key' => config('services.moyasar.publishable_key'),
        ]);
    }

    public function callback(Request $request)
    {
        $paymentId = $request->input('id');

        // Verify the payment by fetching it from Moyasar API
        $response = Http::withBasicAuth(config('services.moyasar.secret_key'), '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if ($response->successful()) {
            $paymentData = $response->json();
            $orderNumber = substr($paymentData['description'], 1); // Remove the '#' character
            $order = Order::where('order_number', $orderNumber)->firstOrFail();
            switch ($paymentData['status']) {
                case 'paid':
                case 'captured':
                    if ($paymentData['amount'] / 100 == $order->total) {
                        $order->update(['is_paid' => true, 'payment_id' => $paymentId]);
                        flash()->success(__('Payment successful!'));
                        return redirect()->route('customer.orders.show', $order);
                    } else {
                        flash()->error(__('Payment verification failed. Please contact support.'));
                        return redirect()->route('checkout', $order);
                    }

                case 'authorized':
                    $order->update(['is_paid' => true]);
                    flash()->info(__('Payment authorized. Awaiting capture.'));
                    return redirect()->route('customer.orders.show', $order);

                case 'failed':
                    $order->update(['is_paid' => false]);
                    flash()->error(__("Payment failed. Please try again."));
                    return redirect()->route('checkout', $order);

                case 'initiated':
                    flash()->info(__('Payment initiated. Please complete the payment.'));
                    return redirect()->route('checkout', $order);

                case 'refunded':
                    $order->update(['is_paid' => false]);
                    flash()->info(__('Payment has been refunded.'));
                    return redirect()->route('customer.orders.show', $order);

                case 'voided':
                    $order->update(['is_paid' => false]);
                    flash()->info(__('Payment has been voided.'));
                    return redirect()->route('customer.orders.show', $order);

                default:
                    flash()->warning(__("Unexpected payment status: {$paymentData['status']}. Please contact support."));
                    return redirect()->route('customer.orders.show', $order);
            }
        } else {
            // API request failed
            flash()->error(__('Unable to verify payment. Please contact support.'));
            return redirect()->route('checkout', $order);
        }
    }
}
