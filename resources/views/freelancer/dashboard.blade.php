@extends('layouts.admin')
@section('title', __('Dashboard'))
@section('content')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Orders Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card orders-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Orders') }} <span>| {{ __('This Month') }}</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $ordersCount }}</h6>
                                        <span
                                            class="text-{{ $orderPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($orderPercentage, 2) }}%</span>
                                        @if ($orderPercentage > 0)
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
                    <!-- End Orders Card -->

                    <!-- Offers Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card offers-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Offers') }} <span>| {{ __('This Month') }}</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $offersCount }}</h6>
                                        <span
                                            class="text-{{ $offersPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($offersPercentage, 2) }}%</span>
                                        @if ($offersPercentage > 0)
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
                    <!-- End Earnings Card -->
                    <!-- Earnings Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card earnings-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Earnings') }} <span>| {{ __('This Month') }}</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>${{ $totalEarnings }}</h6>
                                        <span
                                            class="text-{{ $earningsPercentage > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ round($earningsPercentage, 2) }}%</span>
                                        @if ($earningsPercentage > 0)
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
                    <!-- End Earnings Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Reports') }} <span>/ {{ __('This Month') }}</span></h5>
                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const reportsData = @json($reportsData);
                                        const dates = Object.keys(reportsData);
                                        const ordersData = dates.map(date => reportsData[date].orders);
                                        const offersData = dates.map(date => reportsData[date].offers);

                                        const maxValue = Math.max(...ordersData, ...offersData);
                                        const yaxisMax = maxValue + 10;

                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: '{{ __('Orders') }}',
                                                data: ordersData
                                            }, {
                                                name: '{{ __('Offers') }}',
                                                data: offersData
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
                                            colors: ['#4154f1', '#2eca6a'],
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

                    <!-- Recent Orders -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Recent Orders') }}</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Customer') }}</th>
                                            <th>{{ __('Order Date') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestOrders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->customer->name }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->amount }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'in_progress' ? 'warning' : 'info') }} text-capitalize">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Recent Orders -->
                </div>
            </div>
            <!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Upcoming Deadlines -->
                {{-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Upcoming Deadlines') }}</h5>
                        <div class="activity">
                            @forelse ($upcomingDeadlines as $deadline)
                                <div class="activity-item d-flex justify-content-between mb-3">
                                    <div class="">
                                        <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                        <div class="d-inline-block">
                                            <strong>{{ $deadline->order->title }}</strong>
                                            <p class="text-muted mb-0">{{ $deadline->order->customer->name }}</p>
                                        </div>
                                    </div>
                                    <div class="activity-date text-muted">{{ $deadline->deadline->diffForHumans() }}</div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-4">{{ __('No upcoming deadlines') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div> --}}
                <!-- End Upcoming Deadlines -->
            </div>
            <!-- End Right side columns -->
        </div>
    </section>
@endsection
