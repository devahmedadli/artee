<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ __('New Customer Notification') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        h1 {
            color: #2d3748;
        }
        .customer-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 14px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1> {{ __('New Customer Registered') }}</h1>
        </div>
        
        <p> {{ __('Hello Admin') }},</p>
        
        <p> {{ __('A new customer has registered on Artee.') }}</p>
        
        <div class="customer-details">
            <p><strong> {{ __('Customer Details:') }}</strong></p>
            <p> {{ __('Name:') }} {{ $customer->name }}</p>
            <p> {{ __('Email:') }} {{ $customer->email }}</p>
            <p> {{ __('Registered at:') }} {{ $customer->created_at->format('d-m-Y h:i A') }}</p>
        </div>
        
        <div style="text-align: center;">
            <a href="{{ route('admin.customers.show', $customer->id) }}" class="button">
                {{ __('View Customer') }}
            </a>
        </div>
        
        <div class="footer">
            <p> {{ __('Thanks') }},<br>
            {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
