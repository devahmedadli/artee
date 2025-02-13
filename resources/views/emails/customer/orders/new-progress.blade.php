<x-mail::message>
    # New Order Progress

    Dear {{ $order->customer->name }},

    There has been an update to your order.

    <x-mail::button :url="route('customer.orders.show', $order->id)">
        View Order Details
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
