<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Order Completed') }}</title>
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
            <h1>{{ __('Order Completed') }}</h1>
        </div>
        
        <p>{{ __('Dear') }} {{ $order->customer->name }},</p>
        
        <p>{{ __('Your order has been completed successfully.') }}</p>
        
        <div style="text-align: center;">
            <a href="{{ route('customer.orders.show', $order->id) }}" class="button">
                {{ __('View Order Details') }}
            </a>
        </div>
        
        <div class="footer">
            <p>{{ __('Thanks') }},<br>
            {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>