@extends('layouts.admin')
@section('title', __('Dashboard'))
@section('content')
    <section class="section dashboard">
        <div class="row">
            <!-- Freelancers Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card users-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Freelancers') }} <span>| {{ __('All') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $freelancersCount }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Freelancers Card -->
            <!-- Users Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card users-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Customers') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $customersCount }}</h6>
                                <span
                                    class="text-{{ $customersPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($customersPercentage, 2) }}%</span>
                                @if ($customersPercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Users Card -->
            <!-- Order Value Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card orders-value-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Orders Value') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>${{ $ordersTotalValue }}</h6>
                                <span
                                    class="text-{{ $ordersValuePercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($ordersValuePercentage, 2) }}%</span>
                                @if ($ordersValuePercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Orders Value Card -->
            <!-- orders Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card orders-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Orders') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $ordersCount }}</h6>
                                <span
                                    class="text-{{ $ordersPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($ordersPercentage, 2) }}%</span>
                                @if ($ordersPercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End orders Card -->
        </div>
        
        <!-- Detailed Orders Row -->
        <div class="row mt-4">
            <!-- Service Orders Count Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card service-orders-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Service Orders') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $serviceOrdersCount }}</h6>
                                <span
                                    class="text-{{ $serviceOrdersPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($serviceOrdersPercentage, 2) }}%</span>
                                @if ($serviceOrdersPercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Service Orders Count Card -->
            
            <!-- Service Orders Value Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card service-orders-value-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Service Orders Value') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>${{ $serviceOrdersTotalValue }}</h6>
                                <span
                                    class="text-{{ $serviceOrdersValuePercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($serviceOrdersValuePercentage, 2) }}%</span>
                                @if ($serviceOrdersValuePercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Service Orders Value Card -->
            
            <!-- Product Orders Count Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card product-orders-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Product Orders') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $productOrdersCount }}</h6>
                                <span
                                    class="text-{{ $productOrdersPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($productOrdersPercentage, 2) }}%</span>
                                @if ($productOrdersPercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Orders Count Card -->
            
            <!-- Product Orders Value Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card product-orders-value-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Product Orders Value') }} <span>| {{ __('This Month') }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>${{ $productOrdersTotalValue }}</h6>
                                <span
                                    class="text-{{ $productOrdersValuePercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($productOrdersValuePercentage, 2) }}%</span>
                                @if ($productOrdersValuePercentage > 0)
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Increase') }}
                                    </span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">
                                        {{ __('Decrease') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Orders Value Card -->
        </div>
        <!-- End Detailed Orders Row -->
        
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Reports') }} <span>/{{ __('This Month') }}</span></h5>
                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const reportsData = @json($reportsData);
                                        const dates = Object.keys(reportsData);
                                        const customersData = dates.map(date => reportsData[date].customers);
                                        const ordersCountData = dates.map(date => reportsData[date].orders);
                                        const serviceOrdersData = dates.map(date => reportsData[date].serviceOrders);
                                        const productOrdersData = dates.map(date => reportsData[date].productOrders);

                                        const maxValue = Math.max(
                                            ...customersData, 
                                            ...ordersCountData,
                                            ...serviceOrdersData,
                                            ...productOrdersData
                                        );
                                        const yaxisMax = maxValue + 10;

                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: '{{ __('Customers') }}',
                                                data: customersData
                                            }, {
                                                name: '{{ __('Total Orders') }}',
                                                data: ordersCountData
                                            }, {
                                                name: '{{ __('Service Orders') }}',
                                                data: serviceOrdersData
                                            }, {
                                                name: '{{ __('Product Orders') }}',
                                                data: productOrdersData
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                }
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#ff771d', '#2eca6a', '#9061F9'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: dates
                                            },
                                            yaxis: {
                                                min: 0,
                                                max: yaxisMax,
                                                tickAmount: 5
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy'
                                                }
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->
                            </div>
                        </div>
                    </div>
                    <!-- End Reports -->
                    
                    <!-- Recent Service Orders -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Latest Service Orders') }}</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Service') }}</th>
                                            <th>{{ __('Order Date') }}</th>
                                            <th>{{ __('Customer') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestOrders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->service->name ?? '' }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->customer->name ?? '' }}</td>
                                                <td>{{ $order->customer_accepted ? $order->total . " $" : __('Not Specified') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $order->status == 'approved' ? 'success' : ($order->status == 'rejected' ? 'danger' : 'warning') }} text-capitalize">
                                                        @if ($order->status == 'pending')
                                                            {{ __('Pending') }}
                                                        @else
                                                            {{ $order->status }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Recent Service Orders -->
                    
                    <!-- Latest Product Orders -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Latest Product Orders') }}</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Order Number') }}</th>
                                            <th>{{ __('Product') }}</th>
                                            <th>{{ __('Order Date') }}</th>
                                            <th>{{ __('Customer') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Payment') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestProductOrders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->product->name ?? '' }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->customer->name ?? '' }}</td>
                                                <td>${{ $order->total }}</td>
                                                <td>
                                                    <span class="badge bg-{{ 
                                                        $order->status == 'completed' || $order->status == 'delivered' ? 'success' : 
                                                        ($order->status == 'canceled' ? 'danger' : 
                                                        ($order->status == 'in_progress' ? 'info' : 'warning')) 
                                                    }} text-capitalize">
                                                        {{ str_replace('_', ' ', $order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $order->is_paid ? 'success' : 'warning' }}">
                                                        {{ $order->is_paid ? __('Paid') : __('Unpaid') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Latest Product Orders -->
                </div>
            </div>
        </div>
    </section>
@endsection
