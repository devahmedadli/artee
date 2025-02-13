<x-mail::message>
    # New Customer Registered

    Hello {{ $user->name }},

    A new customer has registered on the platform.

    Customer Details:
    Name: {{ $customer->name }}
    Email: {{ $customer->email }}
    Registered at: {{ $customer->created_at->format('d-m-Y h:i A') }}

    <x-mail::button :url="route('admin.customers.show', $customer->id)">
        View Customer
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
