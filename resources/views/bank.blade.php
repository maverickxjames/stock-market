<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradingView Chart with Data</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Dexignlabs">
    <meta name="robots" content="index, follow">

    <meta name="keywords"
        content="Admin Dashboard, Bootstrap Template, FrontEnd, Web Application, Responsive Design, User Experience, Customizable, Modern UI, Dashboard Template, Admin Panel, Bootstrap 5, HTML5, CSS3, JavaScript, Admin Template, UI Kit, SASS, SCSS, Analytics, Responsive Dashboard, responsive admin dashboard, ui kit, web app, Admin Dashboard, Template, Admin, Authentication, FrontEnd Integration, Web Application UI, Bootstrap Framework, User Interface Kit, SASS Integration, Customizable Template, HTML5/CSS3, Analytics Dashboard, Admin Dashboard UI, Mobile-Friendly Design, UI Components, Dashboard Widgets, Dashboard Framework, Data Visualization, User Experience (UX), Dashboard Widgets, Real-time Analytics, Cross-Browser Compatibility, Interactive Charts, Performance Optimization, Multi-Purpose Template, Efficient Admin Tools, Modern Web Technologies, Responsive Tables, Dashboard Widgets, Invoice Management, Access Control, Modular Design, Trend Analysis, User-Friendly Interface, Crypto Trading UI, Cryptocurrency Dashboard, Trading Platform Interface, Responsive Crypto Admin, Financial Dashboard, UI Components for Crypto, Cryptocurrency Exchange, Blockchain , Crypto Portfolio Template, Crypto Market Analytics">

    <meta name="description"
        content="Empower your cryptocurrency trading platform with Jiade, the ultimate Crypto Trading UI Admin Bootstrap 5 Template. Seamlessly combining sleek design with the power of Bootstrap 5, Jiade offers a sophisticated and user-friendly interface for managing your crypto assets. Packed with customizable components, responsive charts, and a modern dashboard, Jiade accelerates your development process. Crafted for efficiency and aesthetics, this template is your key to creating a cutting-edge crypto trading experience. Explore Jiade today and elevate your crypto trading platform to new heights with a UI that blends functionality and style effortlessly.">

    <meta property="og:title" content="Jiade : Crypto Trading UI Admin  Bootstrap 5 Template | Dexignlabs">
    <meta property="og:description"
        content="Empower your cryptocurrency trading platform with Jiade, the ultimate Crypto Trading UI Admin Bootstrap 5 Template. Seamlessly combining sleek design with the power of Bootstrap 5, Jiade offers a sophisticated and user-friendly interface for managing your crypto assets. Packed with customizable components, responsive charts, and a modern dashboard, Jiade accelerates your development process. Crafted for efficiency and aesthetics, this template is your key to creating a cutting-edge crypto trading experience. Explore Jiade today and elevate your crypto trading platform to new heights with a UI that blends functionality and style effortlessly.">

    <meta property="og:image" content="social-image.png">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Jiade : Crypto Trading UI Admin  Bootstrap 5 Template | Dexignlabs">
    <meta name="twitter:description"
        content="Empower your cryptocurrency trading platform with Jiade, the ultimate Crypto Trading UI Admin Bootstrap 5 Template. Seamlessly combining sleek design with the power of Bootstrap 5, Jiade offers a sophisticated and user-friendly interface for managing your crypto assets. Packed with customizable components, responsive charts, and a modern dashboard, Jiade accelerates your development process. Crafted for efficiency and aesthetics, this template is your key to creating a cutting-edge crypto trading experience. Explore Jiade today and elevate your crypto trading platform to new heights with a UI that blends functionality and style effortlessly.">

    <meta name="twitter:image" content="social-image.png">
    <meta name="twitter:card" content="summary_large_image">

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="/">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <!-- Datatable -->
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- FONT -->
    <!-- Swal Fire CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://kit.fontawesome.com/734dee5206.js" crossorigin="anonymous"></script>


    <style>
        /* General Styling */
        body {
            font-family: "Lexend", sans-serif;
            max-width: 600px;
            position: relative;
            width: 100%;
            margin: 0 auto;
            height: 100vh;
            background-color: rgba(var(--white), 1);
        }

        #top {
            display: block;
            height: 80px;
        }

        .main-header {
            position: sticky;
            top: 0;
            padding-top: 25px;
            background-color: rgba(var(--box-bg), 1);
            z-index: 2;
        }

        .inner-page-header {
            background-color: #ffffff;
            padding: 20px 0;
            border-radius: 0px 0px 20px 20px;
        }

        .custom-container {

            padding: 0 20px;

        }

        .header-panel {
            position: relative;
            padding-bottom: 20px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            line-height: 1;
            z-index: 1;
        }

        .header-panel a {
            text-decoration: none;
            line-height: 1;
        }

        .iconsax.icon-btn {
            font-size: 24px;
            color: #292D32;
            transition: transform 0.3s ease;
        }

        .iconsax.icon-btn:hover {
            transform: scale(1.1);
        }

        .main-header .header-panel h3 {
            position: absolute;
            font-weight: 600;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
            /* padding-bottom: 20px; */
            color: rgba(var(--title-color), 1);
            white-space: nowrap;
        }

        h3.title-color {
            font-size: 24px;
            font-weight: 600;
            color: #292D32;
            margin: 0;
        }

        @media (max-width: 768px) {
            /* .header-panel {
        flex-direction: column;
        align-items: flex-start;
    } */

            .header-panel a {
                margin-right: 0;
                margin-bottom: 10px;
            }

            h3.title-color {
                font-size: 20px;
            }
        }

        /* For SVG Icon */
        .iconsax {
            width: 24px;
            height: 24px;
            fill: #292D32;
        }

        .iconsax:hover {
            fill: #000000;
        }

        /* Header Style for Mobile */
        @media (max-width: 600px) {
            .header-panel {
                padding: 10px;
            }

            .header-panel a {
                margin-right: 10px;
            }
        }



        .request-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .auth-formm {
            padding: 3.125rem 0;
        }

        .card {
            display: block;
            margin: auto;
            width: 90%;
            aspect-ratio: 1 / 1;
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: 15px 15px 30px #bebebe, -15px -15px 30px #ffffff;
        }

        .auth-content-bg {
            padding-bottom: 20px;
            /* background-color: #9CC1E5; */
            border-radius: 0 0 20px 20px;
        }

        .card img {
            width: 90%;
            display: block;
            margin: 5% auto;
        }

        .condition-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .condition-part {
            padding: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .grid-btn .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .grid-btn .btn:hover {
            background-color: #0056b3;
        }

        .game-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .form-group {
            position: relative;
            display: block;
            margin-top: 25px;
        }

        @media (max-width: 600px) {
            .auth-forms .form-group {
                margin-top: calc(10px + 10*(100vw - 320px) / 280);
            }
        }

        .theme-btn {
            background-color: rgb(8, 8, 8);
            color: rgb(255, 255, 255);
        }

        @media (max-width: 600px) {
            .btn {
                padding: calc(10px + 5*(100vw - 320px) / 280);
            }
        }

        .btnn {
            padding: 15px;
            border-radius: 10px;
            background-color: rgb(8, 8, 8);
            color: rgb(255, 255, 255);
            border: none;
            cursor: pointer;
        }
    </style>

    {{-- bootstrap cdn --}}





    <!-- Style css -->
    <link class="main-css" href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


</head>


<body>
    {{-- <div id="top"></div> --}}
    <!-- header starts -->
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <div>
                    <a href="dashboard">
                        <img src="https://cdn-icons-png.flaticon.com/512/2985/2985162.png" alt="" width="20"
                            height="auto">
                    </a>
                </div>


                <h3 class="fw-semibold title-color">Add Funds</h3>
            </div>
        </div>
    </header>


    <section class="section-b-space pt-0">
        <div class="auth-content-bg">
            <div class="custom-container">
                <form id="bank-form" class="auth-formm mt-0 ">
                    @csrf
                    <div class="form-group mt-0">
                        <label class="form-label mb-2" for="Inputname">Bank Name</label>
                        <input type="text" class="form-control" id="Inputname"
                            value="{{ $bankDetails->bank_name ?? '' }}" placeholder="Enter bank name">
                    </div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputholder">Bank Holder Name</label>
                        <input type="text" class="form-control" id="Inputholder"
                            value="{{ $bankDetails->bank_holder ?? '' }}" placeholder="Enter holder name">
                    </div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputnumber">Account No.</label>
                        <input type="number" class="form-control" id="Inputnumber"
                            value="{{ $bankDetails->bank_acc ?? '' }}" placeholder="Enter your account no">
                    </div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputbranch">Branch Name</label>
                        <input type="text" class="form-control" id="Inputbranch"
                            value="{{ $bankDetails->bank_branch ?? '' }}" placeholder="Enter branch name">
                    </div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputcode">IFSC Code</label>
                        <input type="text" class="form-control" id="Inputcode"
                            value="{{ $bankDetails->bank_ifsc ?? '' }}" placeholder="Enter IFSC code">
                    </div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputswift">UPI ID</label>
                        <input type="text" class="form-control" id="Inputswift"
                            value="{{ $bankDetails->upi ?? '' }}" placeholder="Enter UPI ID">
                    </div>
                    <div class="fixed-btn">
                        <div class="custom-container">
                            <button type="button" onclick="bankUpdate()"
                                class="btnn theme-btn w-100 mt-0 auth-btn">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <!-- bank details section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>



    <!-- iconsax js -->
    <script src="../assets/js/iconsax.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function bankUpdate() {
            // Fetching input field values
            var bank_name = document.getElementById('Inputname').value;
            var bank_holder = document.getElementById('Inputholder').value;
            var bank_acc = document.getElementById('Inputnumber').value; // Corrected ID
            var bank_branch = document.getElementById('Inputbranch').value;
            var bank_ifsc = document.getElementById('Inputcode').value;
            var upi = document.getElementById('Inputswift').value;

            // Validate input fields
            if (!bank_name || !bank_holder || !bank_acc || !bank_branch || !bank_ifsc || !upi) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'All fields are required',
                });
                return;
            }

            // Data to send via AJAX
            var data = {
                bank_name: bank_name,
                bank_holder: bank_holder,
                bank_acc: bank_acc,
                bank_branch: bank_branch,
                bank_ifsc: bank_ifsc,
                upi: upi
            };

            // Display loading indicator
            Swal.fire({
                title: 'Updating...',
                text: 'Please wait while your bank details are being updated.',
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            // AJAX request
            $.ajax({
                url: '{{ route('update-bank-details') }}',
                method: 'post',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function(response) {
                    // Stop loading indicator
                    Swal.close();

                    // Process response
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page to reflect changes
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    // Handle errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                }
            });
        }
    </script>

    <script>
        <!-- JavaScript 
        -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>



</html>
