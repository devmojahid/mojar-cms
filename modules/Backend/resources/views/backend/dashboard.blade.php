@extends('cms::layouts.backend')

@section('content')

<div class="col-12">
    <div class="row row-cards">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span
                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ trans('cms::app.posts') }}
                            </div>
                            <div class="text-secondary">
                                {{ trans('cms::app.total') }}: {{ number_format($posts) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span
                                class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l11 0" /><path d="M9 12l11 0" /><path d="M9 18l11 0" /><path d="M5 6l0 .01" /><path d="M5 12l0 .01" /><path d="M5 18l0 .01" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ trans('cms::app.pages') }}
                            </div>
                            <div class="text-secondary">
                                {{ trans('cms::app.total') }}: {{ number_format($pages) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span
                                class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ trans('cms::app.users') }}
                            </div>
                            <div class="text-secondary">
                                {{ trans('cms::app.total') }}: {{ number_format($users) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span
                                class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-server"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M7 8l0 .01" /><path d="M7 16l0 .01" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ trans('cms::app.storage') }}
                            </div>
                            <div class="text-secondary">
                                {{ trans('cms::app.total') }}/Free: {{ $storage }}/{{ $diskFree }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @do_action('backend.dashboard.statis')

    <div class="row">
        <div class="col-md-12">
            <canvas id="curve_chart" style="width: 100%; height: 300px"></canvas>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('cms::app.new_users') }}</h5>
                </div>

                <div class="card-body">
                    <table class="table" id="users-table">
                        <thead>
                            <tr>
                                <th data-formatter="index_formatter" data-width="5%">#</th>
                                <th data-field="name">{{ trans('cms::app.name') }}</th>
                                <th data-field="created" data-width="30%" data-align="center">{{ trans('cms::app.created_at') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('cms::app.top_views') }}</h5>
                </div>

                <div class="card-body">
                    <table class="table" id="posts-top-views">
                        <thead>
                            <tr>
                                <th data-formatter="index_formatter" data-width="5%">#</th>
                                <th data-field="title">{{ trans('cms::app.title') }}</th>
                                <th data-field="views" data-width="10%">{{ trans('cms::app.views') }}</th>
                                <th data-field="created" data-width="30%" data-align="center">{{ trans('cms::app.created_at') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @do_action('backend.dashboard.view')

    <script type="text/javascript">
        setTimeout(function () {
            const ctx = document.getElementById('curve_chart');
            let jsonData = $.ajax({
                url: "{{ route('admin.dashboard.views_chart') }}",
                dataType: "json",
                async: false
            }).responseText;

            jsonData = JSON.parse(jsonData);
            let labels = [];
            let views = [];
            let users = [];

            $.each(jsonData, function (index, item) {
                labels.push(item[0]);
                views.push(item[1]);
                users.push(item[2]);
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Page Views',
                            data: views,
                            borderWidth: 1
                        },
                        {
                            label: 'New Users',
                            data: users,
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }, 200);
    </script>

    <script type="text/javascript">
        function index_formatter(value, row, index) {
            return (index + 1);
        }

        function subject_formatter(value, row, index) {
            return '<a href="'+ row.url +'">'+ value +'</a>';
        }

        const table1 = new JuzawebTable({
            table: '#users-table',
            page_size: 5,
            url: '{{ route('admin.dashboard.users') }}',
        });

        const table2 = new JuzawebTable({
            table: '#posts-top-views',
            page_size: 5,
            url: '{{ route('admin.dashboard.top_views') }}',
        });
    </script>
@endsection
