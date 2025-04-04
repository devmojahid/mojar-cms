<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecomm::content.revenue_overview') }}</h3>
        </div>
        <div class="card-body">
            <div id="revenue-chart" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Ajax function to get revenue data
    $.ajax({
        url: '{{ route('admin.ecommerce.dashboard.revenue_chart') }}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Create chart with the response data
            new ApexCharts(document.querySelector("#revenue-chart"), {
                chart: {
                    type: 'area',
                    height: 300,
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                series: [{
                    name: '{{ trans('ecomm::content.revenue') }}',
                    data: response.revenue
                }, {
                    name: '{{ trans('ecomm::content.orders') }}',
                    data: response.orders
                }],
                xaxis: {
                    categories: response.dates,
                    labels: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            if (this.seriesIndex === 0) {
                                return '{{ ecom_price_with_unit(0) }}'.replace('0', val);
                            }
                            return val;
                        }
                    }
                },
                colors: ['#206bc4', '#4299e1']
            }).render();
        },
        error: function(xhr, status, error) {
            console.error('Error loading revenue chart data:', error);
        }
    });
});
</script>