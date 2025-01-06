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

		@media (max-width: 600px) {
			.custom-container {
				padding: 0 calc(15px + 5*(100vw - 320px) / 280);
			}
		}

		.custom-container {
			padding: 0 20px;
		}

		.request-list {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
			margin-top: 20px;
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

		.auth-forms .form-group {
			position: relative;
			display: block;
			margin-top: 20px;
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
	<!-- header end -->

	@if(session('error'))
	<script>
		Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = "{{ route('deposit') }}";
        });
	</script>
	@endif



	<!-- Finding Transaction List Starts -->
	<section class="transaction-request section-b-space">
		<div class="custom-container">
			<!-- Step 1 -->
			<div class="condition-part">
				<h4 class="fw-semibold title-color">Step 1 :</h4>
				<ul class="condition-list">
					<li>
						<h5>Scan QR</h5>
						<p>Scan the QR code or copy the UPI ID by clicking the button below.</p>
					</li>
					<li>
						<h5>Pay Amount</h5>
						<p>Pay the requested amount to proceed.</p>
					</li>
				</ul>
			</div>

			<!-- QR Code and UPI Details -->
			<ul class="transaction-list">
				<li>
					<div class="game-container">
						<div class="card text-center">
							<img src="<?= $qr_img ?>" alt="QR Code" class="img-fluid">
						</div>
					</div>
				</li>
			</ul>
			<br>
			<div class="form-group mt-0">
				<label class="form-label mb-2" for="upiId">UPI ID:</label>
				<input type="text" class="form-control" id="upiId" value="<?= $upi ?>" disabled>
			</div>

			<div class="grid-btn mt-4">
				<button onclick="copyUPI()" class="btn btn-primary w-100 m-0">Copy UPI ID</button>
			</div>

			<!-- Step 2 -->
			<div class="condition-part">
				<h4 class="fw-semibold title-color">Step 2 :</h4>
				<ul class="condition-list">
					<li>
						<h5>Upload Payment Proof</h5>
						<p>Upload a screenshot of your payment.</p>
					</li>
					<li>
						<h5>Fill UTR</h5>
						<p>Enter your UTR number.</p>
				</ul>
			</div>

			<!-- Upload Payment Proof Form -->
			<div>
				<!-- Upload Payment Proof Form -->
				<form class="auths-form" enctype="multipart/form-data" id="paymentForm">
					{{-- @csrf --}}
					<div class="form-group mt-0">
						<label class="form-label mb-2" for="ss">Upload Screenshot:
							<span style="color:red">* <sup>(Required)</sup></span>
						</label>
						<input type="file" class="form-control" name="ss" id="ss" required>
						<input type="hidden" name="txn_id" value="{{ $txn_id }}">
					</div>
					<br>
					<div class="form-group mt-0">
						<label class="form-label mb-2" for="utr">Enter UTR:
							<span style="color:red">* <sup>(Required)</sup></span>
						</label>
						<input type="text" class="form-control" name="utr" id="utr"
							placeholder="Enter Bank Reference Number" required>
					</div>
					<br>
					<button type="button" onclick="uploadRef()" class="btnn theme-btn w-100 auth-btn">Upload</button>
				</form>
			</div>
		</div>
	</section>






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
		<!-- JavaScript 
		-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		function copyUPI() {
			navigator.clipboard.writeText("{{ $upi }}").then(() => {
				Swal.fire({
					icon: 'success',
					title: 'Copied',
					text: 'UPI ID copied to clipboard!',
					showConfirmButton: false,
					timer: 1000
				});
			});
		}

		function uploadRef() {
			let utr = document.getElementById("utr").value;
			let ss = document.getElementById("ss").files[0];

			if (!utr || utr.length !== 12) {
				Swal.fire({ icon: 'error', title: 'Invalid UTR', text: 'Enter a valid 12-digit UTR number!', timer: 1500 });
				return;
			}

			if (!ss) {
				Swal.fire({ icon: 'error', title: 'Screenshot Required', text: 'Upload the payment screenshot!', timer: 1500 });
				return;
			}

			let formData = new FormData();
			formData.append("utr", utr);        // Add the UTR value
			formData.append("ss", ss);          // Add the screenshot file
			formData.append("txn_id", "{{ $txn_id }}");  // Add the transaction ID

			

			$.ajax({
				url: '{{ route("uploadRef") }}',
				type: 'POST',
				headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for security
            },
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function () {
					Swal.fire({ icon: 'info', title: 'Uploading', text: 'Please wait...', showConfirmButton: false });
				},
				success: function (response) {
					Swal.fire({
						icon: response.icon,
						title: response.title,
						text: response.message,
						timer: 1500
					}).then(() => {
						if (response.redirect) {
							window.location.href = response.redirect;
						}
					});
				},
				error: function () {
					Swal.fire({ icon: 'error', title: 'Error', text: 'An unexpected error occurred!', timer: 1500 });
				}
			});
		}
	</script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>



</html>