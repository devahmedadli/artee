<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('New Order Notification') }}</title>
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
            background-color: #2c3e50;
            color: white;
            border-radius: 6px 6px 0 0;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }
        .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 20px;
        }
        .alert-box {
            background-color: #e74c3c;
            color: white;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-weight: 600;
            text-align: center;
            font-size: 18px;
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
            border-left: 4px solid #3498db;
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
            width: 40%;
        }
        .detail-value {
            color: #333;
            width: 60%;
            text-align: right;
        }
        .total-row {
            font-size: 18px;
            font-weight: 600;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            color: #e74c3c;
        }
        .button {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background-color: #219653;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-size: 14px;
            border-top: 1px solid #f0f0f0;
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
            .detail-label, .detail-value {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://www.artee.com.sa/images/logo.png" alt="Artee Team." class="logo">
            <h1 class="title">{{ __('New Order Received') }}</h1>
            <p class="subtitle">{{ __('Action Required') }}</p>
        </div>
        
        <div class="content">
            <div class="alert-box">
                {{ __('New order requires your attention!') }}
            </div>
            
            <p class="greeting">{{ __('Hello Admin') }}</p>
            
            <div class="message">
                <p>{{ __('A new order has been placed and requires your attention. Please review the details below.') }}</p>
            </div>
            
            <div class="order-details">
                <h2>{{ __('Order Details') }}</h2>
                
                <div class="detail-row">
                    <span class="detail-label">{{ __('Order Number:') }}</span>
                    <span class="detail-value">{{ $order->order_number }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">{{ __('Customer Name:') }}</span>
                    <span class="detail-value">{{ $order->customer->name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">{{ __('Customer Email:') }}</span>
                    <span class="detail-value">{{ $order->customer->email }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">{{ __('Date of Order:') }}</span>
                    <span class="detail-value">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
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
                <a href="{{ route('orders.show', ['order' => $order->id, 'type' => $type]) }}" class="button">
                    {{ __('Process This Order') }}
                </a>
            </div>
            
            <div class="message">
                <p>{{ __('Please process this order as soon as possible to ensure customer satisfaction.') }}</p>
                <p>{{ __('This is an automated notification. Please do not reply to this email.') }}</p>
            </div>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Artee Team. {{ __('Admin Portal') }}</p>
            <p>{{ __('This email contains confidential information and is intended for admin use only.') }}</p>
        </div>
    </div>
</body>
</html>
