<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Order Confirmation') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .title {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
        }
        .content {
            padding: 30px 20px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .message {
            margin-bottom: 25px;
            color: #555;
        }
        .order-details {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .order-details h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 15px;
        }
        .detail-label {
            font-weight: 600;
            color: #555;
        }
        .detail-value {
            color: #333;
        }
        .total-row {
            font-size: 18px;
            font-weight: 600;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-size: 14px;
            border-top: 1px solid #f0f0f0;
        }
        .social-links {
            margin: 15px 0;
        }
        .social-link {
            display: inline-block;
            margin: 0 10px;
        }
        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
                border-radius: 0;
            }
            .detail-row {
                flex-direction: column;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://www.artee.com.sa/images/logo.png" alt="Techs Gate Co." class="logo">
            <h1 class="title">{{ __('Order Confirmation') }}</h1>
            <p class="subtitle">{{ __('Thank you for your purchase!') }}</p>
        </div>
        
        <div class="content">
            <p class="greeting">{{ __('Dear :name', ['name' => $order->customer->name]) }}</p>
            
            <div class="message">
                <p>{{ __('Thank you for your order. We are pleased to confirm that your order has been successfully placed.') }}</p>
            </div>
            
            <div class="order-details">
                <h2>{{ __('Order Details') }}</h2>
                
                <div class="detail-row">
                    <span class="detail-label">{{ __('Order Number:') }}</span>
                    <span class="detail-value">{{ $order->order_number }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">{{ __('Date of Order:') }}</span>
                    <span class="detail-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">{{ $type == 'service' ? __('Service:') : __('Product:') }}</span>
                    <span class="detail-value">{{ $serviceName }}</span>
                </div>
                
                <div class="detail-row total-row">
                    <span class="detail-label">{{ __('Total Amount:') }}</span>
                    <span class="detail-value">{{__('Negotiating')}}</span>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ route('customer.orders.show', ['order' => $order->id, 'type' => $type]) }}" class="button">
                    {{ __('View Order Details') }}
                </a>
            </div>
            
            <div class="message">
                <p>{{ __('If you have any questions or need further assistance, please don\'t hesitate to contact us.') }}</p>
                <p>{{ __('Thank you for choosing our services. We appreciate your business!') }}</p>
                <p>
                    {{ __('Best regards,') }}<br>
                    {{ __('Artee Team.') }}
                </p>
            </div>
        </div>
        
        <div class="footer">
            <div class="social-links">
                <a href="https://facebook.com/arteesa" class="social-link">Facebook</a>
                <a href="https://twitter.com/arteesa" class="social-link">Twitter</a>
                <a href="https://instagram.com/arteesa" class="social-link">Instagram</a>
            </div>
            <p>
                <a href="https://www.artee.com.sa" style="color: #3498db; text-decoration: none;">www.artee.com.sa</a>
            </p>
            <p>© {{ date('Y') }} Artee Team. {{ __('All rights reserved.') }}</p>
        </div>
    </div>
</body>
</html>
