<!-- views/dashboard/revenue-chart.blade.php -->
<div class="row row-cards mt-3">
    <div class="col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('ecomm::content.monthly_sales') }}</h3>
            </div>
            <div class="card-body">
                <div id="chart-monthly-sales"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('ecomm::content.revenue_trend') }}</h3>
            </div>
            <div class="card-body">
                <div id="chart-revenue-trend"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('ecomm::content.order_status') }}</h3>
            </div>
            <div class="card-body">
                <div id="chart-order-status"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // Load data for all charts
    $.ajax({
        url: '{{ route('admin.ecommerce.dashboard.charts_data') }}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Monthly Sales Chart (Bar)
            if (window.ApexCharts) {
                new ApexCharts(document.getElementById('chart-monthly-sales'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: true,
                            speed: 500
                        },
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: "{{ trans('ecomm::content.sales') }}",
                        data: response.monthlySales.values
                    }, {
                        name: "{{ trans('ecomm::content.refunds') }}",
                        data: response.monthlyRefunds.values
                    }],
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        categories: response.monthlySales.labels
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                            formatter: function(val) {
                                return '{{ ecom_price_with_unit(0) }}'.replace('0', val);
                            }
                        },
                    },
                    colors: [tabler.getColor("primary"), tabler.getColor("red")],
                    legend: {
                        show: true,
                        position: 'bottom'
                    },
                }).render();
            }

            // Revenue Trend Chart (Area)
            if (window.ApexCharts) {
                new ApexCharts(document.getElementById('chart-revenue-trend'), {
                    chart: {
                        type: "area",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: true,
                            speed: 500
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: .16,
                        type: 'solid'
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "{{ trans('ecomm::content.revenue') }}",
                        data: response.revenueTrend.values
                    }, {
                        name: "{{ trans('ecomm::content.orders') }}",
                        data: response.ordersTrend.values
                    }],
                    tooltip: {
                        theme: 'dark',
                        y: {
                            formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                                if (seriesIndex === 0) {
                                    return '{{ ecom_price_with_unit(0) }}'.replace('0', value);
                                }
                                return value;
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        categories: response.revenueTrend.labels
                    },
                    yaxis: [
                        {
                            labels: {
                                padding: 4,
                                formatter: function(val) {
                                    return '{{ ecom_price_with_unit(0) }}'.replace('0', val);
                                }
                            },
                        },
                        {
                            opposite: true,
                            labels: {
                                padding: 4,
                                formatter: function(val) {
                                    return Math.round(val);
                                }
                            },
                        }
                    ],
                    colors: [tabler.getColor("primary"), tabler.getColor("green")],
                    legend: {
                        show: true,
                        position: 'bottom'
                    },
                }).render();
            }

            // Order Status Chart (Pie)
            if (window.ApexCharts) {
                new ApexCharts(document.getElementById('chart-order-status'), {
                    chart: {
                        type: "donut",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: true,
                            speed: 500
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: response.orderStatus.values,
                    labels: response.orderStatus.labels,
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                    },
                    colors: [
                        tabler.getColor("green"),
                        tabler.getColor("primary"),
                        tabler.getColor("yellow"),
                        tabler.getColor("orange"),
                        tabler.getColor("red")
                    ],
                    legend: {
                        show: true,
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: '{{ trans('ecomm::content.total_orders') }}',
                                        formatter: function (w) {
                                            return response.orderStatus.values.reduce((a, b) => a + b, 0);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }).render();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading chart data:', error);
        }
    });
});
</script>
