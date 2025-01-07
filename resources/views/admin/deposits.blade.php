<?php
$user = Auth::user();

//import models of deposit and withdraw
use App\Models\deposit;
use App\Models\withdraw;
use App\Models\User;

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

        <x-adminsidebar />

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Deposit</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
        
        
            <div class="col-md">
                <div class="card">
                    <div class="card-header p-2">
                        <!-- Navigation Tabs -->
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#pending" data-toggle="tab">Pending</a></li>
                            <li class="nav-item"><a class="nav-link" href="#complete" data-toggle="tab">Complete</a></li>
                            <li class="nav-item"><a class="nav-link" href="#failed" data-toggle="tab">Failed</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- User's Complete Transaction History -->
                            <div class="active tab-pane" id="pending">
                                <div class="card">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User ID</th>
                                                <th>Transaction ID</th>
                                                <th>Amount</th>
                                                <th>Proof</th>
                                                <th>UPI</th>
                                                <!-- <th>Remark</th> -->
                                                <th>UTR</th>
                                                <th>Time</th>
                                                
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $deposit = Deposit::where('status', 0)->orderBy('id', 'DESC')->get();
                                    
                                            @endphp
                                           
                                            @foreach ($deposit as $row)
                                                @php
                                                    $user = User::where('id', $row->userid)->first();
                                                @endphp
                                            
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $row->order_id }}</td>
                                                    <td>{{ $row->amount }}</td>
                                                    <td>
                                                        <img 
                                                            src="{{ asset('storage/payment_ss/'.$row->payment_ss) }}" 
                                                            alt="proof" 
                                                            style="width: 100px; height: 100px; cursor: pointer;" 
                                                            onclick="showFullImage('{{ asset('storage/payment_ss/'.$row->payment_ss) }}')">
                                                    </td>

                                                    <td>{{ $row->upi }}</td>
                                                    <!-- <td>{{ $row->remark }}</td> -->
                                                    <td>{{ $row->utr }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                    <td>
                                                        <form>
                                                            @csrf
                                                            <button class="btn btn-success"
                                                                onclick="depositApprove('{{ $row->order_id }}','confirm')">Approve</button>
                                                            <button class="btn btn-warning"
                                                                onclick="depositApprove('{{ $row->order_id }}','decline')">Decline</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        
                                        </tbody>
                                    </table>
        
                                </div>
                            </div>
        
                            <!-- Deposit-Specific Transactions -->
                            <div class="tab-pane" id="complete">
                                <div class="card">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User ID</th>
                                                <th>Order ID</th>
                                                <th>Amount</th>
                                                <th>Proof</th>
                                                <th>UPI</th>
                                                <th>Remark</th> 
                                                <th>UTR</th>
                                                <th>Time</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @php
                                                $deposit = Deposit::where('status', 1)->orderBy('id', 'DESC')->get();
                                    
                                            @endphp
                                           
                                            @foreach ($deposit as $row)
                                                @php
                                                    $user = User::where('id', $row->userid)->first();
                                                @endphp
                                            
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $row->order_id }}</td>
                                                    <td>{{ $row->amount }}</td>
                                                    <td>
                                                        <img 
                                                            src="{{ asset('storage/payment_ss/'.$row->payment_ss) }}" 
                                                            alt="proof" 
                                                            style="width: 100px; height: 100px; cursor: pointer;" 
                                                            onclick="showFullImage('{{ asset('storage/payment_ss/'.$row->payment_ss) }}')">
                                                    </td>

                                                    <td>{{ $row->upi }}</td>
                                                     <td>{{ $row->remark }}</td> 
                                                    <td>{{ $row->utr }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
        
                                </div>
                            </div>
        
                            <!-- Withdrawal-Specific Transactions -->
                            <div class="tab-pane" id="failed">
                                <div class="card">
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mobile No.</th>
                                                <th>Order ID</th>
                                                <th>Amount</th>
                                                <th>Proof</th>
                                                <th>UPI</th>
                                                <th>Remark</th> 
                                                <th>UTR</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $deposit = Deposit::where('status', 2)->orderBy('id', 'DESC')->get();
                                    
                                            @endphp
                                           
                                            @foreach ($deposit as $row)
                                                @php
                                                    $user = User::where('id', $row->userid)->first();
                                                @endphp
                                            
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $row->order_id }}</td>
                                                    <td>{{ $row->amount }}</td>
                                                    <td>
                                                        <img 
                                                            src="{{ asset('storage/payment_ss/'.$row->payment_ss) }}" 
                                                            alt="proof" 
                                                            style="width: 100px; height: 100px; cursor: pointer;" 
                                                            onclick="showFullImage('{{ asset('storage/payment_ss/'.$row->payment_ss) }}')">
                                                    </td>
                                                    
                                                    <td>{{ $row->upi }}</td>
                                                  <td>{{ $row->remark }}</td> 
                                                    <td>{{ $row->utr }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
        
                                </div>
                            </div>
        
        
                        </div>
        
                    </div>
                </div>
        
            </div>
        
        </div>
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
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

        });
    </script>


<script>
    function depositApprove(order_id, r_type) {
        const actionTitle = r_type === 'confirm' ? 'Approving Deposit...' : 'Declining Deposit...';
        const actionMessage = r_type === 'confirm' ? 'Please wait while the deposit is approved.' :
            'Please wait while the deposit is declined.';

        // Approve request using AJAX and Swal.fire
        $.ajax({
            url: '{{ route('approve-deposit') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for security
            },
            data: {
                order_id: order_id,
                r_type: r_type
            },
            beforeSend: function() {
                Swal.fire({
                    title: actionTitle,
                    text: actionMessage,
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });
            },

            success: function(data) {
                swal.close();

                const response = data;


                if (response === 'success') {
                    const message = response.type === 'confirm' ? 'Transaction Approved Successfully' :
                        'Transaction Declined Successfully';

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,

                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(xhr) {
                Swal.close();
                const errorMessage = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    }

    function withdrawApprove(txnid, r_type) {
        const actionTitle = r_type === 'confirm' ? 'Approving Withdraw...' : 'Declining Withdraw...';
        const actionMessage = r_type === 'confirm' ? 'Please wait while the withdraw is approved.' :
            'Please wait while the withdraw is declined.';
        // Approve request using AJAX and Swal.fire
        $.ajax({
            url: '{{ route('approve-withdraw') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for security
            },
            data: {
                txnid: txnid,
                r_type: r_type
            },
            beforeSend: function() {
                Swal.fire({
                    title: actionTitle,
                    text: actionMessage,
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });
            },
            success: function(data) {
                Swal.close();
                const response = data;

                if (response === 'success') {
                    const message = r_type === 'confirm' ?
                        'Withdraw Approved Successfully' :
                        'Withdraw Declined Successfully';

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(xhr) {
                Swal.close();
                const errorMessage = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    }
</script>


<script>
    function showFullImage(imageUrl) {
        Swal.fire({
            title: 'Proof Image',
            imageUrl: imageUrl,
            imageAlt: 'Proof Image',
            width: 'auto',
            confirmButtonText: 'Close',
        });
    }
</script>


</body>

</html>
