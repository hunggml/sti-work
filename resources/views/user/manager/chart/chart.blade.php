<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Biểu đồ thống kê</title>
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('img/logo.jpeg') }}">
    <!-- Tell the browser to be responsive to screen width -->
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="{{ asset('plugins/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    @toastr_css
    {{-- css/style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('mycss')
    {{-- datatable --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">


    {{-- chart --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js"
        integrity="sha512-dnUg2JxjlVoXHVdSMWDYm2Y5xcIrJg1N+juOuRi0yLVkku/g26rwHwysJDAMwahaDfRpr1AxFz43ktuMPr/l1A=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="sidebar-mini layout-fixed sidebar-mini sidebar-collapse" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        @include('user.core.header')

        <!-- Content Wrapper. Contains page content -->

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="card">
                        <div class="card-body" id="car-body">
                            <div class="card-header">
                                <h3 class="card-title">Biểu đồ quá trình làm việc</h3>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @push('script')
            <script>
                $.ajax({
                    url: window.location.origin + '/api/chart-api/',
                    type: 'GET',
                    error: function(jqXHR, textStatus, errorThrown) {

                    },
                    success: function(users) {
                        users = users;
                        var barChartData = {
                            labels: callback(users),
                            datasets: [{
                                    // type: 'bar',
                                    label: 'Quá hạn',
                                    data: outTime(users),
                                    backgroundColor: ['red'],
                                    borderColor: ['rgba(255, 99, 132, 0.2)'],
                                    borderWidth: 1

                                },
                                {
                                    // type: 'bar',
                                    label: 'Đúng hạn',
                                    data: onTime(users),
                                    backgroundColor: ['greenyellow'],
                                    borderColor: ['rgb(75, 192, 192)'],
                                    borderWidth: 1

                                },
                                {
                                    // type: 'bar',
                                    label: 'Chưa đến hạn',
                                    data: inTime(users),
                                    backgroundColor: ['rgb(163, 163, 163)'],
                                    borderColor: ['rgb(201, 203, 207)'],
                                    borderWidth: 1

                                }
                            ],
                        };
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: barChartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                            }
                        });
                    }
                });

                function outTime(users) {
                    let outTime = [];
                    users.map((user, index) => {
                        outTime[index] = user.progress;
                    })
                    return outTime;
                }

                function inTime(users) {
                    let inTime = [];
                    users.map((user, index) => {
                        inTime[index] = (user.work.filter(work => work.progress == 0)).length;
                    })
                    return inTime;
                }

                function onTime(users) {
                    let onTime = [];
                    users.map((user, index) => {
                        onTime[index] = (user.work.filter(work => work.progress == 1)).length;
                    })
                    return onTime;
                }

                function callback(users) {
                    let labels = [];
                    users.forEach(function(user) {
                        labels.push(user.name)
                    });

                    return labels;
                    // console.log(on_time, out_time);

                }

            </script>
        @endpush


        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        @include('user.core.footer')
    </div>

    <!-- ./wrapper -->


    {{-- jqre --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- js --}}
    <script src="{{ asset('js/master.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    @stack('script')
    <script>
        $(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('notification') }}",
                // data: { text : text1},
                success: function(data) {
                    //  console.log('run')
                    let dem = 0;
                    let notification = '';
                    $.each(data.data, function(index, value) {
                        dem++;
                        notification = notification + `<p class="dropdown-item">` + index +
                            ` {{ __('Cần Xác Nhận Công Việc') }}</p>`
                    });

                    $.each(data.data1, function(index, value) {
                        dem++;
                        notification = notification + `<p class="dropdown-item">` + index +
                            ` {{ __('Cần Xác Nhận Đã Họp') }}</p>`
                    });
                    $('#notification-main').append(notification)
                    $('#navbarNotificationCounter').append(dem)
                },
                error: function() {
                    $('#unit').val('');
                    $('#unit1').val('');
                }
            });
            $('#navbarNotification').on('click', function() {
                $('#navbarNotificationCounter').attr('style', 'display:none')
            })
        })

    </script>
    {{-- @jquery --}}
    @toastr_js
    @toastr_render
</body>

</html>
