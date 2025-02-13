<x-mail::message>
    # Order Completed

    Dear {{ $order->customer->name }},

    Your order has been completed successfully.

    <x-mail::button :url="route('customer.orders.show', $order->id)">
        View Order Details
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>