<x-mail::message>
    # Payment Confirmation

    Dear {{ $order->customer->name }},

    Your payment has been confirmed.

    <x-mail::button :url="route('customer.orders.show', $order->id)">
        View Order Details
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
