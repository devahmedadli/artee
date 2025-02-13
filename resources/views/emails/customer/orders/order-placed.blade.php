<x-mail::message>
    # Order Placed Successfully

    <p>Dear {{ $order->customer->name }},</p>

    <p>Thank you for your order. We are pleased to confirm that your order has been successfully placed.</p>

    <p><strong>Order Details:</strong></p>
    <ul>
        <li>Order Number: {{ $order->order_number }}</li>
        <li>Date of Order: {{ $order->created_at->format('M d, Y') }}</li>
        <li>Service: {{ $order->service->name }}</li>
        <li>Total Amount: {{ number_format($order->total) }} KD</li>
    </ul>

    <p>You can view your order details by clicking the button below:</p>
    <x-mail::button :url="route('customer.orders.show', $order->id)">
        View Order Details
    </x-mail::button>

    <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>

    <p>Thank you for choosing our services. We appreciate your business!</p>

    <p>Best regards,</p>
    <p>Techs Gate Co.</p>
    <p><a href="https://www.artee.com.sa">www.artee.com.sa</a></p>
</x-mail::message>
