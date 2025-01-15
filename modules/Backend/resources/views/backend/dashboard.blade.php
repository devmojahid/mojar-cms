@extends('cms::layouts.backend')

@section('content')
    <div class="col-12" style="padding: 0px !important;">
        <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span
                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l11 0" />
                                        <path d="M9 12l11 0" />
                                        <path d="M9 18l11 0" />
                                        <path d="M5 6l0 .01" />
                                        <path d="M5 12l0 .01" />
                                        <path d="M5 18l0 .01" />
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-server">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                        <path
                                            d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                        <path d="M7 8l0 .01" />
                                        <path d="M7 16l0 .01" />
                                    </svg>
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
    
    <div class="row row-cards mt-3">
        <div class="col-lg-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div id="chart-completion-tasks-9"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div id="chart-completion-tasks-10"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div id="chart-completion-tasks-11"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 mt-3" style="padding: 0px !important;">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Invoices</h3>
          </div>
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                  <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                </div>
                entries
              </div>
              <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                  <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                  <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                  </th>
                  <th>Invoice Subject</th>
                  <th>Client</th>
                  <th>VAT No.</th>
                  <th>Created</th>
                  <th>Status</th>
                  <th>Price</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001401</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-us me-2"></span>
                    Carlson Limited
                  </td>
                  <td>
                    87956621
                  </td>
                  <td>
                    15 Dec 2017
                  </td>
                  <td>
                    <span class="badge bg-success me-1"></span> Paid
                  </td>
                  <td>$887</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001402</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">UX Wireframes</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-gb me-2"></span>
                    Adobe
                  </td>
                  <td>
                    87956421
                  </td>
                  <td>
                    12 Apr 2017
                  </td>
                  <td>
                    <span class="badge bg-warning me-1"></span> Pending
                  </td>
                  <td>$1200</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001403</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">New Dashboard</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-de me-2"></span>
                    Bluewolf
                  </td>
                  <td>
                    87952621
                  </td>
                  <td>
                    23 Oct 2017
                  </td>
                  <td>
                    <span class="badge bg-warning me-1"></span> Pending
                  </td>
                  <td>$534</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001404</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">Landing Page</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-br me-2"></span>
                    Salesforce
                  </td>
                  <td>
                    87953421
                  </td>
                  <td>
                    2 Sep 2017
                  </td>
                  <td>
                    <span class="badge bg-secondary me-1"></span> Due in 2 Weeks
                  </td>
                  <td>$1500</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001405</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">Marketing Templates</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-pl me-2"></span>
                    Printic
                  </td>
                  <td>
                    87956621
                  </td>
                  <td>
                    29 Jan 2018
                  </td>
                  <td>
                    <span class="badge bg-danger me-1"></span> Paid Today
                  </td>
                  <td>$648</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001406</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">Sales Presentation</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-br me-2"></span>
                    Tabdaq
                  </td>
                  <td>
                    87956621
                  </td>
                  <td>
                    4 Feb 2018
                  </td>
                  <td>
                    <span class="badge bg-secondary me-1"></span> Due in 3 Weeks
                  </td>
                  <td>$300</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001407</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">Logo & Print</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-us me-2"></span>
                    Apple
                  </td>
                  <td>
                    87956621
                  </td>
                  <td>
                    22 Mar 2018
                  </td>
                  <td>
                    <span class="badge bg-success me-1"></span> Paid Today
                  </td>
                  <td>$2500</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                  <td><span class="text-secondary">001408</span></td>
                  <td><a href="invoice.html" class="text-reset" tabindex="-1">Icons</a></td>
                  <td>
                    <span class="flag flag-xs flag-country-pl me-2"></span>
                    Tookapic
                  </td>
                  <td>
                    87956621
                  </td>
                  <td>
                    13 May 2018
                  </td>
                  <td>
                    <span class="badge bg-success me-1"></span> Paid Today
                  </td>
                  <td>$940</td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                          Action
                        </a>
                        <a class="dropdown-item" href="#">
                          Another action
                        </a>
                      </div>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
            <ul class="pagination m-0 ms-auto">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                  <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                  prev
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

    @do_action('backend.dashboard.view')

    <script type="text/javascript">
        setTimeout(function() {
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

            $.each(jsonData, function(index, item) {
                labels.push(item[0]);
                views.push(item[1]);
                users.push(item[2]);
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Page Views',
                            data: views,
                            borderWidth: 1
                        },
                        {
                            label: 'New Users',
                            data: users,
                            borderWidth: 1
                        }
                    ]
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
            return '<a href="' + row.url + '">' + value + '</a>';
        }

        const table1 = new MojarTable({
            table: '#users-table',
            page_size: 5,
            url: '{{ route('admin.dashboard.users') }}',
        });

        const table2 = new MojarTable({
            table: '#posts-top-views',
            page_size: 5,
            url: '{{ route('admin.dashboard.top_views') }}',
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-completion-tasks-9'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
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
                name: "",
                data: [155, 65, 465, 265, 225, 325, 80]
            },{
                name: "",
                data: [113, 42, 65, 54, 76, 65, 35]
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
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26'
            ],
            colors: [tabler.getColor("primary"), tabler.getColor("red")],
            legend: {
                show: false,
            },
        })).render();
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-completion-tasks-10'), {
            chart: {
                type: "area",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
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
                name: "",
                data: [155, 65, 465, 265, 225, 325, 80]
            },{
                name: "",
                data: [113, 42, 65, 54, 76, 65, 35]
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
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26'
            ],
            colors: [tabler.getColor("primary"), tabler.getColor("red")],
            legend: {
                show: false,
            },
        })).render();
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-completion-tasks-11'), {
            chart: {
                type: "area",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
                stacked: true,
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
                name: "",
                data: [155, 65, 465, 265, 225, 325, 80]
            },{
                name: "",
                data: [113, 42, 65, 54, 76, 65, 35]
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
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26'
            ],
            colors: [tabler.getColor("primary"), tabler.getColor("red")],
            legend: {
                show: false,
            },
        })).render();
    });
  </script>
@endsection
