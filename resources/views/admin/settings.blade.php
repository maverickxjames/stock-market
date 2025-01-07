<?php
$user = Auth::user();

use App\Models\User;

// $settings = $data['settings'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <style>
        .swal2-popup {
            font-size: 1.6rem;
        }
    </style>

    {{-- meta csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">



                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-adminsidebar />
        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Adjust Limits</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <div class="card-body">


                <!-- Min Recharge Section -->
                <form id="minRechargeForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="minRecharge">Min Recharge</label>
                        <div class="col-sm-8 d-flex">
                            <input type="text" class="form-control" id="minRecharge" name="minRecharge"
                                value="{{ $settings['minRecharge'] ?? '' }}">
                            <button type="button" class="btn btn-primary ml-2"
                                onclick="updateMinRecharge()">Update</button>
                        </div>
                    </div>
                </form>

                <!-- Min Withdraw Section -->
                <form id="minWithdrawForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="minWithdraw">Min Withdraw</label>
                        <div class="col-sm-8 d-flex">
                            <input type="text" class="form-control" id="minWithdraw" name="minWithdraw"
                                value="{{ $settings['minWithdraw'] ?? '' }}">
                            <button type="button" class="btn btn-primary ml-2"
                                onclick="updateMinWithdraw()">Update</button>
                        </div>
                    </div>
                </form>




            </div>

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Adjust Message</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <div class="card-body">
                {{-- UPDATE deposit msg --}}
                <form id="depositmsgForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="depositmsg">Deposit Message</label>
                        <div class="col-sm-8 d-flex">
                            <input type="text" class="form-control" id="depositmsg" name="depositmsg"
                                value="{{ $settings['deposit_msg'] ?? '' }}">
                            <button type="button" class="btn btn-primary ml-2"
                                onclick="updateDepositMsg()">Update</button>
                        </div>
                    </div>
                </form>

                {{-- UPDATE Withdraw msg --}}
                <form id="withdrawmsgForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="withdrawmsg">Withdraw Message</label>
                        <div class="col-sm-8 d-flex">
                            <input type="text" class="form-control" id="withdrawmsg" name="withdrawmsg"
                                value="{{ $settings['withdraw_msg'] ?? '' }}">
                            <button type="button" class="btn btn-primary ml-2"
                                onclick="updateWithdrawMsg()">Update</button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Update UPI</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <div class="card-body">
                {{-- UPDATE UPI --}}

                <form id="upiForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="upi">UPI</label>
                        <div class="col-sm-8 d-flex">
                            <input type="text" class="form-control" id="upi" name="upi"
                                value="{{ $settings['upi'] ?? '' }}">
                            <button type="button" class="btn btn-primary ml-2" onclick="updateUpi()">Update</button>
                        </div>
                    </div>
                </form>

            </div>


            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Adjust Status</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Recharge Status -->
                <form id="rechargeStatusForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="recharge_status">Recharge Status</label>
                        <div class="col-sm-8">
                            <input type="checkbox" id="recharge_status"
                                {{ $settings->recharge_status == 'on' ? 'checked' : '' }} data-toggle="toggle"
                                data-on="On" data-off="Off" data-onstyle="primary" data-offstyle="light">
                        </div>
                    </div>
                </form>

                <!-- Withdraw Status -->
                <form id="withdrawStatusForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="withdraw_status">Withdraw Status</label>
                        <div class="col-sm-8">
                            <input type="checkbox" id="withdraw_status"
                                {{ $settings->withdraw_status == 'on' ? 'checked' : '' }} data-toggle="toggle"
                                data-on="On" data-off="Off" data-onstyle="primary" data-offstyle="light">
                        </div>
                    </div>
                </form>

                {{-- upi status --}}
              <form id="upiStatusForm">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="upi_status">UPI Status</label>
                        <div class="col-sm-8">
                            <input type="checkbox" id="upi_status"
                                {{ $settings->upi_status == 'on' ? 'checked' : '' }} data-toggle="toggle"
                                data-on="On" data-off="Off" data-onstyle="primary" data-offstyle="light">
                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/dist/js/pages/dashboard.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="../../plugins/codemirror/codemirror.js"></script>
    <script src="../../plugins/codemirror/mode/css/css.js"></script>
    <script src="../../plugins/codemirror/mode/xml/xml.js"></script>
    <script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js"></script> -->

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateMinWithdraw() {
            const value = document.getElementById('minWithdraw').value;

            $.ajax({
                url: '{{ route('settings.updateMinWithdraw') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                },
                data: {
                    value
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Updating...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Occurred',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK',
                    });
                },
            });
        }

        function updateMinRecharge() {
            const value = document.getElementById('minRecharge').value;

            $.ajax({
                url: '{{ route('settings.updateMinRecharge') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                },
                data: {
                    value
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Updating...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Occurred',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK',
                    });
                },
            });
        }

        function updateDepositMsg() {
            const value = document.getElementById('depositmsg').value;

            $.ajax({
                url: '{{ route('settings.updateDepositMsg') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                },
                data: {
                    value
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Updating...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Occurred',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK',
                    });
                },
            });
        }

        function updateWithdrawMsg() {
            const value = document.getElementById('withdrawmsg').value;

            $.ajax({
                url: '{{ route('settings.updateWithdrawMsg') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                },
                data: {
                    value
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Updating...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Occurred',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK',
                    });
                },
            });
        }

        function updateUpi() {
            const value = document.getElementById('upi').value;

            $.ajax({
                url: '{{ route('settings.updateUpi') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                },
                data: {
                    value
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Updating...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Occurred',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK',
                    });
                },
            });
        }


        $(document).ready(function() {
            $('#recharge_status').change(function() {
                const status = $(this).prop('checked') ? 'on' : 'OFF';
                updateStatus('recharge', status);
            });

            $('#withdraw_status').change(function() {
                const status = $(this).prop('checked') ? 'on' : 'OFF';
                updateStatus('withdraw', status);
            });

            $('#upi_status').change(function() {
                const status = $(this).prop('checked') ? 'on' : 'OFF';
                updateStatus('upi', status);
            });

            function updateStatus(type, status) {
                let url;

        if (type === 'recharge') {
            url = '{{ route("settings.updateRechargeStatus") }}';
        } else if (type === 'withdraw') {
            url = '{{ route("settings.updateWithdrawStatus") }}';
        } else if (type === 'upi') {
            url = '{{ route("settings.updateUpiStatus") }}';
        }

                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Updating...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        Swal.fire({
                            icon: response.success ? 'success' : 'error',
                            title: response.success ? 'Success' : 'Error',
                            text: response.message,
                            confirmButtonText: 'OK',
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonText: 'OK',
                        });
                    },
                });
            }
        });
    </script>




</body>

</html>
