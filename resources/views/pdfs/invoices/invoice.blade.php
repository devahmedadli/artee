<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            color: #6f6b7d;
        }

        .text-muted {
            color: #a5a3ae !important;
        }

        .border-secondary {
            border-color: #a8aaae !important;
        }

        b,
        strong {
            font-weight: 700 !important;
        }

        .table-bordered {
            border-width: 1px;
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #a8aaae;
            padding: 8px;
        }

        .table-bordered th {
            background-color: #2c3f92;
            color: white;
        }

        .invoice-header,
        .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
</head>

<body>

    <div class="invoice-header" style="margin-bottom: 50px;">
        @if (!$noTemp)
            <img src="{{ public_path('assets/img/logo/pdf-banner.png') }}" alt="Techs Gate" style="width: 100%;">
            @else 
            <div style="height:100px;"></div>
        @endif
    </div>

    <div class="invoice-body">
        <div style="margin-bottom: 20px;">
            <div style="width: 50%; float: left;" class="text-muted">
                <div>Bill date: {{ $invoice->start_date }}</div>
                <div>Due date: {{ $invoice->end_date }}</div>
            </div>
            <div style="width: 50%; float: right; text-align: left;">
                <div style="background-color: #2c3f92; color: white; padding: 10px;">
                    Invoice #{{ $invoice->invoice_number }}
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="margin-bottom: 20px;">
            <div style="width: 50%; float: left;">
                <div><strong>Techs Gate Co.</strong></div>
                <div>Al Mutawa Building, Salem Al Mubarak St.</div>
                <div>Floor 2 Office 2, Salmiya, Kuwait</div>
                <div>Phone: 22209505</div>
            </div>
            <div style="width: 50%; float: right;">
                <div><strong>Bill To</strong></div>
                <div>{{ $invoice->client_name }}</div>
                <div>{{ $invoice->business_name }}</div>
                <div>{{ $invoice->mobile_number }}</div>
                <div>{{ $invoice->email }}</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <table class="table-bordered">
            <thead>
                <tr>
                    <th style="text-align: left;">Item</th>
                    <th style="text-align: center;">Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                    <tr>
                        <td>
                            <div>{{ $item->name }}</div>
                            <div class="text-muted">{!! nl2br($item->description) !!}</div>
                        </td>
                        <td style="text-align: center;">
                            {{ \App\Helpers\PriceHandlerHelper::handleDecimalPrice($item->cost) }} KD
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: right;">Sub Total</td>
                    <td style="text-align: center;">
                        {{ \App\Helpers\PriceHandlerHelper::handleDecimalPrice($invoice->subtotal) }} KD</td>
                </tr>
                @if ($invoice->discount > 0)
                    <tr>
                        <td style="text-align: right;">Discount</td>
                        <td style="text-align: center;">
                            {{ $invoice->discount_type == 'percentage' ? \App\Helpers\PriceHandlerHelper::handleDecimalPrice($invoice->discount) . '%' : \App\Helpers\PriceHandlerHelper::handleDecimalPrice($invoice->discount) . ' KD' }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td style="text-align: right;"><strong>Total</strong></td>
                    <td style="text-align: center;">
                        <strong>{{ \App\Helpers\PriceHandlerHelper::handleDecimalPrice($invoice->total) }} KD</strong>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">Paid</td>
                    <td style="text-align: center;">
                        {{ \App\Helpers\PriceHandlerHelper::handleDecimalPrice($invoice->payments->sum('amount')) }} KD
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">Balance Due</td>
                    <td style="text-align: center;">
                        {{ \App\Helpers\PriceHandlerHelper::handleDecimalPrice($invoice->dueTotal) }} KD</td>
                </tr>
            </tfoot>
        </table>

        <div style="margin-top: 20px;">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: left;">Payment Date</th>
                        <th style="text-align: left;">Method</th>
                        <th style="text-align: center;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->payments as $payment)
                        <tr>
                            <td>{{ $payment->date }}</td>
                            <td>
                                {{ $payment->payment_method }} -
                                @foreach ($paymentMethods as $paymentMethod)
                                    {{ Str::slug($paymentMethod->name) == Str::slug($payment->payment_method) ? $paymentMethod->identifier : '' }}
                                @endforeach
                                : {{ $payment->payment_method_details }}
                            </td>
                            <td style="text-align: center;">
                                {{ \App\Helpers\PriceHandlerHelper::handleDecimalPrice($payment->amount) }} KD</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="invoice-footer">
        info@techsgate.com | www.techsgate.com | +965 222 09505 / 22209505
    </div>


</body>

</html>
