@php
$user=Auth::user();
use Illuminate\Support\Facades\Http;
@endphp


<?php
// URL for the API request
$url = "https://ow-scanx-analytics.dhan.co/customscan/fetchdt";

// Common headers
$headers = [
    'Content-Type: application/json; charset=UTF-8',
    'Accept: */*',
    'User-Agent: Mozilla/5.0'
];

// Data for NSE (National Stock Exchange)
$nseData = [
    "data" => [
        'sort' => 'PPerchange',
        'sorder' => 'desc',
        'count' => 5,
        'params' => [
            ['field' => 'Sid', 'op' => '', 'val' => '13,25,27,38,17'],
            ['field' => 'Exch', 'op' => '', 'val' => 'IDX'],
        ],
        "fields" => [
            'DispSym', 'Exch', 'High1Yr', 'Inst', 
            'Low1Yr', 'Ltp', 
            'PPerchange', 'Pchange', 'Seg', 'Seosym', 
            'Sid', 'TickSize', 'Volume', 'Sym',
        ],
        "pgno" => 1  // Page number for testing
    ]
];

// Data for BSE (Bombay Stock Exchange)
$bseData = [
    "data" => [
        'count' => 5,
        'params' => [
            ['field' => 'Sid', 'op' => '', 'val' => '51,82,64,69,65'],
            ['field' => 'Exch', 'op' => '', 'val' => 'IDX'],
        ],
        "fields" => [
            'DispSym', 'Exch', 'High1Yr', 'Inst', 
            'Low1Yr', 'Ltp', 
            'PPerchange', 'Pchange', 'Seg', 'Seosym', 
            'Sid', 'TickSize', 'Volume', 'Sym',
        ],
        "pgno" => 1  // Page number for testing
    ]
];

// Function to send the request and fetch data
function fetchData($url, $headers, $data) {
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the request
    $response = curl_exec($ch);

    // Return the response
    return $response;
}

// Fetch data for NSE
$nseResponse = fetchData($url, $headers, $nseData);

// Fetch data for BSE
$bseResponse = fetchData($url, $headers, $bseData);

// Now you have $nseResponse and $bseResponse to work with
?>




<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from jiade.dexignlab.com/xhtml/trading-market.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2024 08:05:17 GMT -->

<head>
	<!--Title-->
	<title>Jiade : Crypto Trading UI Admin Bootstrap 5 Template | Dexignlabs</title>

	<!-- Meta -->
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

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
	<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<!-- Style css -->
	<link class="main-css" href="css/style.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	{{-- jquery cdn --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	{{-- chart js cdn --}}

	<style>
		.nse {
			cursor: pointer;
		}

		.bse {
			cursor: pointer;
		}

		@media (min-width: 1200px) {
			.nse {
				flex: 0 0 50%;
				width: 50%;
			}
		}

		@media (min-width: 1200px) {
			.bse {
				flex: 0 0 50%;
				width: 50%;
			}
		}

		.item{
			cursor: pointer;
			display: flex;
    justify-content: start;
    align-items: center;
    gap: 10px;
		}
	</style>

</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
			<a href="index-2.html" class="brand-logo">
				<svg class="logo-abbr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
					width="27.5px" height="36.5px">
					<path fill-rule="evenodd" stroke="var(--primary)" stroke-width="1px" stroke-linecap="butt"
						stroke-linejoin="miter" fill="var(--primary)"
						d="M24.253,5.072 L24.253,16.207 C24.253,17.311 24.210,17.744 24.253,18.412 L24.253,20.016 L24.253,25.458 C24.253,26.562 24.344,32.102 24.253,33.103 L22.202,33.103 C22.202,32.102 22.202,27.277 22.202,25.459 L22.202,5.076 C21.972,4.819 21.837,4.484 21.837,4.137 C21.837,3.770 21.987,3.414 22.242,3.154 C22.504,2.893 22.865,2.749 23.226,2.749 C23.593,2.749 23.954,2.893 24.210,3.154 C24.711,3.656 24.725,4.543 24.253,5.072 ZM18.243,16.511 C18.243,17.615 18.199,18.047 18.243,18.715 L18.243,20.319 L18.243,25.762 C18.243,26.866 18.334,32.405 18.243,33.407 L16.192,33.407 C16.192,32.405 16.192,27.580 16.192,25.762 L16.192,5.379 C15.962,5.123 15.826,4.787 15.826,4.441 C15.826,4.073 15.977,3.718 16.232,3.457 C16.493,3.197 16.855,3.052 17.215,3.052 C17.583,3.052 17.943,3.196 18.199,3.457 C18.701,3.959 18.714,4.846 18.243,5.375 L18.243,16.511 ZM12.735,25.098 C12.735,26.915 12.134,28.000 10.592,28.964 L7.575,30.848 C7.601,31.001 7.616,31.157 7.616,31.316 C7.616,31.883 7.156,32.342 6.590,32.342 C6.023,32.342 5.564,31.883 5.564,31.316 C5.564,31.189 5.530,31.071 5.471,30.968 C5.469,30.964 5.466,30.961 5.464,30.957 C5.458,30.948 5.453,30.938 5.448,30.929 C5.321,30.736 5.103,30.609 4.855,30.609 C4.465,30.609 4.146,30.926 4.146,31.316 C4.146,31.707 4.465,32.026 4.855,32.026 C5.422,32.026 5.881,32.485 5.881,33.052 C5.881,33.618 5.421,34.077 4.855,34.077 C3.333,34.077 2.095,32.839 2.095,31.316 C2.095,29.795 3.333,28.557 4.855,28.557 C5.470,28.557 6.040,28.760 6.499,29.102 L9.505,27.224 C10.441,26.639 10.683,26.201 10.683,25.098 L10.683,19.655 C10.653,19.674 10.623,19.694 10.592,19.713 L7.575,21.598 C7.601,21.750 7.616,21.906 7.616,22.066 C7.616,22.633 7.156,23.092 6.590,23.092 C6.023,23.092 5.564,22.633 5.564,22.066 C5.564,21.940 5.531,21.822 5.473,21.719 C5.470,21.715 5.466,21.711 5.464,21.707 C5.457,21.697 5.452,21.686 5.446,21.676 C5.319,21.485 5.102,21.358 4.855,21.358 C4.465,21.358 4.146,21.675 4.146,22.066 C4.146,22.456 4.465,22.775 4.855,22.775 C5.422,22.775 5.881,23.234 5.881,23.801 C5.881,24.368 5.421,24.827 4.855,24.827 C3.333,24.827 2.095,23.588 2.095,22.066 C2.095,20.544 3.333,19.306 4.855,19.306 C5.470,19.306 6.040,19.509 6.499,19.851 L9.505,17.973 C10.441,17.388 10.683,16.951 10.683,15.847 L10.683,4.709 C10.451,4.457 10.322,4.118 10.322,3.773 C10.322,3.407 10.466,3.051 10.728,2.790 C10.984,2.534 11.344,2.384 11.711,2.384 C12.072,2.384 12.434,2.534 12.689,2.790 C13.190,3.296 13.204,4.181 12.735,4.706 L12.735,25.098 Z" />
				</svg>

				<div class="brand-title">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="91px"
						height="29px">
						<path fill-rule="evenodd" fill="var(--primary)"
							d="M90.219,18.825 C89.722,19.295 89.031,19.595 88.143,19.726 L78.472,21.174 C78.759,22.035 79.347,22.688 80.234,23.131 C81.121,23.549 82.140,23.757 83.288,23.757 C84.358,23.757 85.363,23.627 86.303,23.366 C87.269,23.079 88.052,22.753 88.652,22.387 C89.070,22.648 89.422,23.014 89.709,23.483 C89.997,23.953 90.140,24.449 90.140,24.971 C90.140,26.145 89.592,27.019 88.496,27.594 C87.661,28.037 86.721,28.337 85.676,28.494 C84.632,28.650 83.654,28.729 82.740,28.729 C81.200,28.729 79.764,28.520 78.433,28.102 C77.128,27.659 75.979,27.006 74.987,26.145 C74.022,25.284 73.251,24.201 72.677,22.896 C72.129,21.591 71.855,20.065 71.855,18.316 C71.855,16.594 72.129,15.120 72.677,13.893 C73.251,12.641 73.995,11.623 74.909,10.840 C75.822,10.031 76.867,9.444 78.041,9.079 C79.216,8.687 80.417,8.491 81.643,8.491 C83.027,8.491 84.280,8.700 85.402,9.118 C86.551,9.535 87.530,10.109 88.339,10.840 C89.174,11.571 89.814,12.445 90.258,13.463 C90.727,14.480 90.963,15.589 90.963,16.790 C90.963,17.677 90.714,18.356 90.219,18.825 ZM83.837,14.128 C83.340,13.606 82.609,13.345 81.643,13.345 C81.017,13.345 80.469,13.450 79.999,13.658 C79.555,13.867 79.190,14.141 78.903,14.480 C78.616,14.793 78.394,15.159 78.237,15.576 C78.107,15.968 78.028,16.372 78.002,16.790 L84.698,15.694 C84.619,15.172 84.332,14.650 83.837,14.128 ZM63.870,28.142 C62.669,28.533 61.285,28.729 59.720,28.729 C58.023,28.729 56.496,28.494 55.139,28.024 C53.807,27.554 52.672,26.876 51.732,25.989 C50.818,25.101 50.114,24.045 49.618,22.818 C49.148,21.565 48.913,20.156 48.913,18.590 C48.913,16.868 49.174,15.381 49.696,14.128 C50.218,12.849 50.936,11.792 51.850,10.957 C52.789,10.122 53.873,9.509 55.099,9.118 C56.352,8.700 57.697,8.491 59.132,8.491 C59.654,8.491 60.163,8.543 60.659,8.648 C61.155,8.726 61.560,8.831 61.873,8.961 L61.873,2.620 C62.134,2.541 62.552,2.463 63.126,2.385 C63.700,2.280 64.288,2.228 64.888,2.228 C65.462,2.228 65.971,2.267 66.415,2.346 C66.885,2.424 67.276,2.581 67.589,2.815 C67.903,3.050 68.138,3.376 68.294,3.794 C68.451,4.185 68.529,4.707 68.529,5.360 L68.529,23.914 C68.529,25.141 67.955,26.119 66.806,26.850 C66.049,27.346 65.071,27.776 63.870,28.142 ZM61.912,14.167 C61.390,13.854 60.764,13.697 60.033,13.697 C58.623,13.697 57.540,14.102 56.783,14.911 C56.026,15.720 55.647,16.946 55.647,18.590 C55.647,20.208 56.000,21.435 56.705,22.270 C57.409,23.079 58.428,23.483 59.759,23.483 C60.228,23.483 60.646,23.418 61.011,23.288 C61.403,23.131 61.703,22.961 61.912,22.779 L61.912,14.167 ZM43.746,27.202 C42.050,28.220 39.661,28.729 36.581,28.729 C35.198,28.729 33.945,28.598 32.822,28.337 C31.726,28.076 30.773,27.685 29.964,27.163 C29.181,26.641 28.568,25.976 28.124,25.167 C27.706,24.358 27.497,23.418 27.497,22.348 C27.497,20.548 28.032,19.164 29.103,18.199 C30.173,17.233 31.831,16.633 34.075,16.398 L39.205,15.850 L39.205,15.576 C39.205,14.820 38.865,14.285 38.186,13.971 C37.534,13.632 36.581,13.463 35.329,13.463 C34.336,13.463 33.371,13.567 32.431,13.776 C31.491,13.985 30.643,14.245 29.886,14.559 C29.547,14.324 29.259,13.971 29.025,13.502 C28.789,13.006 28.672,12.497 28.672,11.975 C28.672,11.297 28.829,10.762 29.142,10.370 C29.481,9.953 29.990,9.600 30.669,9.313 C31.426,9.026 32.314,8.817 33.332,8.687 C34.376,8.556 35.354,8.491 36.268,8.491 C37.678,8.491 38.957,8.635 40.105,8.922 C41.280,9.209 42.272,9.653 43.081,10.253 C43.916,10.827 44.556,11.571 45.000,12.484 C45.443,13.371 45.665,14.428 45.665,15.655 L45.665,24.423 C45.665,25.101 45.469,25.662 45.078,26.106 C44.712,26.524 44.269,26.889 43.746,27.202 ZM39.244,20.234 L36.425,20.469 C35.694,20.522 35.093,20.678 34.623,20.939 C34.153,21.200 33.919,21.591 33.919,22.113 C33.919,22.635 34.115,23.066 34.506,23.405 C34.924,23.718 35.616,23.875 36.581,23.875 C37.025,23.875 37.508,23.836 38.030,23.757 C38.578,23.653 38.983,23.523 39.244,23.366 L39.244,20.234 ZM20.871,7.317 C19.775,7.317 18.888,6.978 18.209,6.299 C17.556,5.621 17.230,4.786 17.230,3.794 C17.230,2.802 17.556,1.967 18.209,1.289 C18.888,0.610 19.775,0.271 20.871,0.271 C21.968,0.271 22.842,0.610 23.495,1.289 C24.174,1.967 24.513,2.802 24.513,3.794 C24.513,4.786 24.174,5.621 23.495,6.299 C22.842,6.978 21.968,7.317 20.871,7.317 ZM5.049,28.729 C3.691,28.729 2.595,28.520 1.760,28.102 C1.159,27.815 0.716,27.424 0.429,26.928 C0.167,26.432 0.037,25.871 0.037,25.245 C0.037,24.723 0.102,24.266 0.233,23.875 C0.389,23.483 0.572,23.170 0.781,22.935 C1.277,23.040 1.694,23.118 2.034,23.170 C2.399,23.196 2.791,23.209 3.208,23.209 C4.226,23.209 4.957,22.961 5.401,22.466 C5.845,21.944 6.067,21.187 6.067,20.195 L6.067,4.381 C6.354,4.329 6.811,4.264 7.437,4.185 C8.064,4.081 8.664,4.029 9.238,4.029 C9.839,4.029 10.361,4.081 10.804,4.185 C11.274,4.264 11.666,4.420 11.979,4.655 C12.292,4.890 12.527,5.216 12.684,5.634 C12.841,6.051 12.919,6.599 12.919,7.278 L12.919,21.761 C12.919,24.084 12.253,25.832 10.922,27.006 C9.590,28.155 7.633,28.729 5.049,28.729 ZM20.519,9.000 C21.093,9.000 21.602,9.039 22.046,9.118 C22.516,9.196 22.908,9.353 23.221,9.587 C23.534,9.822 23.769,10.148 23.926,10.566 C24.108,10.957 24.200,11.479 24.200,12.132 L24.200,28.063 C23.913,28.115 23.482,28.181 22.908,28.259 C22.359,28.363 21.798,28.416 21.224,28.416 C20.649,28.416 20.127,28.376 19.658,28.298 C19.214,28.220 18.835,28.063 18.522,27.828 C18.209,27.594 17.961,27.280 17.778,26.889 C17.622,26.471 17.543,25.936 17.543,25.284 L17.543,9.353 C17.830,9.300 18.248,9.235 18.796,9.157 C19.370,9.052 19.945,9.000 20.519,9.000 Z" />
					</svg>
				</div>

			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->
		<div class="chatbox">
			<div class="chatbox-close"></div>
			<div class="custom-tab-1">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#alerts">Alerts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#chat">Chat</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="chat" role="tabpanel">
						<div class="card mb-sm-3 mb-md-0 contacts_card dlab-chat-user-box">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
											<rect fill="#000000" opacity="0.3"
												transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
												x="4" y="11" width="16" height="2" rx="1" />
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Chat List</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<circle fill="#000000" cx="5" cy="12" r="2" />
											<circle fill="#000000" cx="12" cy="12" r="2" />
											<circle fill="#000000" cx="19" cy="12" r="2" />
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dlab-scroll  " id="DLAB_W_Contacts_Body">
								<ul class="contacts">
									<li class="name-first-letter">A</li>
									<li class="active dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Archie Parker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Alfie Mason</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">B</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Bashid Samim</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Breddie Ronan</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Ceorge Carson</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">D</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Darry Parker</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Denry Hunter</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">J</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Jack Ronan</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Jacob Tucker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>James Logan</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Joshua Weston</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">O</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oliver Acker</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oscar Weston</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="card chat dlab-chat-history-box d-none">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);" class="dlab-chat-history-back">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
										width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<rect fill="#000000" opacity="0.3"
												transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) "
												x="14" y="7" width="2" height="10" rx="1" />
											<path
												d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
												fill="#000000" fill-rule="nonzero"
												transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) " />
										</g>
									</svg>
								</a>
								<div>
									<h6 class="mb-1">Chat with Khelesh</h6>
									<p class="mb-0 text-success">Online</p>
								</div>
								<div class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"><svg
											xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
											viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<circle fill="#000000" cx="5" cy="12" r="2" />
												<circle fill="#000000" cx="12" cy="12" r="2" />
												<circle fill="#000000" cx="19" cy="12" r="2" />
											</g>
										</svg></a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i>
											View profile</li>
										<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to
											btn-close friends</li>
										<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to
											group</li>
										<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
									</ul>
								</div>
							</div>
							<div class="card-body msg_card_body dlab-scroll" id="DLAB_W_Contacts_Body3">
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
							</div>
							<div class="card-footer type_msg">
								<div class="input-group">
									<textarea class="form-control" placeholder="Type your message..."></textarea>
									<div class="input-group-append">
										<button type="button" class="btn btn-primary"><i
												class="fa fa-location-arrow"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="alerts" role="tabpanel">
						<div class="card mb-sm-3 mb-md-0 contacts_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<circle fill="#000000" cx="5" cy="12" r="2" />
											<circle fill="#000000" cx="12" cy="12" r="2" />
											<circle fill="#000000" cx="19" cy="12" r="2" />
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Notications</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path
												d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
												fill="#000000" fill-rule="nonzero" opacity="0.3" />
											<path
												d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
												fill="#000000" fill-rule="nonzero" />
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dlab-scroll" id="DLAB_W_Contacts_Body1">
								<ul class="contacts">
									<li class="name-first-letter">SEVER STATUS</li>
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">KK</div>
											<div class="user_info">
												<span>David Nester Birthday</span>
												<p class="text-primary">Today</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SOCIAL</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont success">RU</div>
											<div class="user_info">
												<span>Perfection Simplified</span>
												<p>Jame Smith commented on your status</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SEVER STATUS</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">AU</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont info">MO</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="card-footer"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="notes">
						<div class="card mb-sm-3 mb-md-0 note_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
											<rect fill="#000000" opacity="0.3"
												transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
												x="4" y="11" width="16" height="2" rx="1" />
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Notes</h6>
									<p class="mb-0">Add New Nots</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path
												d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
												fill="#000000" fill-rule="nonzero" opacity="0.3" />
											<path
												d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
												fill="#000000" fill-rule="nonzero" />
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dlab-scroll" id="DLAB_W_Contacts_Body2">
								<ul class="contacts">
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>New order placed..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Youtube, a video-sharing website..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>john just buy your product..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">

						</div>
						<ul class="navbar-nav header-right">

							<li class="nav-item dropdown notification_dropdown">
								<a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
									<svg id="icon-light" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32"
										viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path
												d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
												fill="#000000" fill-rule="nonzero" />
											<path
												d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z"
												fill="#000000" fill-rule="nonzero" opacity="0.3" />
										</g>
									</svg>
									<svg id="icon-dark" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32"
										viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path
												d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z"
												fill="#000000" />
										</g>
									</svg>
								</a>
							</li>
							<li class="nav-item dropdown notification_dropdown">
								<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
										width="32px" height="32px" viewBox="0 0 24 24" version="1.1"
										class="svg-main-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<path
												d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z"
												fill="#fff" />
											<rect fill="#fff" opacity="0.3" x="10" y="16" width="4" height="4" rx="2" />
										</g>
									</svg>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div id="DZ_W_Notification3" class="widget-media dlab-scroll p-3"
										style="height:380px;">
										<ul class="timeline">
											<li>
												<div class="timeline-panel">
													<div class="media me-2">
														<img alt="image" width="50" src="images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-info">
														KG
													</div>
													<div class="media-body">
														<h6 class="mb-1">Resport created successfully</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-success">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2">
														<img alt="image" width="50" src="images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-danger">
														KG
													</div>
													<div class="media-body">
														<h6 class="mb-1">Resport created successfully</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-primary">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
										</ul>
									</div>
									<a class="all-notification" href="javascript:void(0);">See all notifications <i
											class="ti-arrow-end"></i></a>
								</div>
							</li>

							<li class="nav-item dropdown notification_dropdown">
								<a class="nav-link " href="javascript:void(0);" data-bs-toggle="dropdown">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
										width="32px" height="32px" viewBox="0 0 24 24" version="1.1"
										class="svg-main-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path
												d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
												fill="#fff" />
										</g>
									</svg>
								</a>

							</li>
							<li>
								<div class="dropdown header-profile2">
									<a class="nav-link" href="javascript:void(0);" role="button"
										data-bs-toggle="dropdown" aria-expanded="false">
										<div class="header-info2 d-flex align-items-center">
											<div class="d-flex align-items-center sidebar-info">
												<div>
													<h4 class="text-white mb-1">{{ $user['name'] }}</h4>
													<span class="d-block text-end">{{ $user['email'] }}</span>
												</div>
											</div>
											<img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="">
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-end header-profile3 " style="">
										<a onclick="window.location.href='{{ route('profile') }}'"
											class="dropdown-item ai-icon ">
											<img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="">
											<span class="ms-2">Profile </span>
										</a>
										<a onclick="window.location.href='{{ route('portfolio') }}'"
											class="dropdown-item ai-icon ">
											<img src="https://cdn-icons-png.flaticon.com/512/943/943026.png" alt="">
											<span class="ms-2">Portfolio </span>
										</a>

										<a onclick="window.location.href='{{ route('profile') }}'"
											class="dropdown-item ai-icon ">
											<img src="https://cdn-icons-png.flaticon.com/512/2698/2698011.png" alt="">
											<span class="ms-2">Settings </span>
										</a>
										<a onclick="window.location.href='{{ route('logout') }}'"
											class="dropdown-item ai-icon">
											<img src="https://cdn-icons-png.flaticon.com/512/15181/15181112.png" alt="">
											<span class="ms-2 text-danger">Logout </span>
										</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="page-titles">
				<div class="d-flex align-items-center">
					<h2 class="text-white">Market</h2>
					<p class="text-warning ms-2">Welcome Back {{ $user['name'] }} !</p>
				</div>

			</div>
		</div>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<x-sidebar />
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="row">

					<div class="col-xl-12">
						<div class="row">

							<?php
							  $nseResponse = json_decode($nseResponse, true);
							?>

							{{-- check $nseResponse is null or not --}}

							@if($nseResponse == null)

							@else
							@foreach ($nseResponse['data'] as $index => $item)

							<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6 col-12">
								<div class="card trad-card overflow-hidden shadow-lg border-0 rounded-lg">
									<div
										class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
										<div>
											<h2 class="text-dark mb-0 font-w600">{{$item['DispSym']}}</h2>
											<!-- Percentage Change with Color Symbol -->
											<p class="mb-0 fs-5 font-w500 d-flex align-items-center">

												@if($item['Pchange']<0) <span class="me-1 text-danger">▼</span>
													<!-- Down arrow icon -->
													<span class="text-danger">
														{{number_format($item['PPerchange'],2)}}%</span>
													<small class="text-muted ms-1">(
														{{number_format($item['Pchange'],2)}} pts )</small>
													@else
													<span class="me-1 text-success">▲</span> <!-- Up arrow icon -->
													<span class="text-success">
														{{number_format($item['PPerchange'],2)}}%</span>
													<small class="text-muted ms-1">(+
														{{number_format($item['Pchange'],2)}} pts )</small>
													@endif


											</p>

										</div>
										<div class="text-end">
											<p class="text-muted mb-1 fs-13" title="National Stock Exchange">IDX</p>
										</div>
									</div>

									<div class="card-body ">
										<div class="d-flex justify-content-between ">
											<p class="mb-0">Last Trade Price:</p>
											<p class="font-w600 text-primary fs-4">{{number_format($item['Ltp'],2)}}</p>
										</div>

									</div>
								</div>
							</div>

							@endforeach
							@endif






							<?php
							  $bseResponse = json_decode($bseResponse, true);
							?>


							{{-- check $bseResponse is null or not --}}

							@if($bseResponse == null)

							@else
							@foreach ($bseResponse['data'] as $index => $item)
							<!-- print item on console -->

							<?php 
							 $data = json_encode($item);
							 ?>


							<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6 col-12">
								<div class="card trad-card overflow-hidden shadow-lg border-0 rounded-lg">
									<div
										class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
										<div>
											<h2 class="text-dark mb-0 font-w600">{{$item['DispSym']}}</h2>
											<p class="mb-0 fs-5 font-w500 d-flex align-items-center">

												@if($item['Pchange']<0) <span class="me-1 text-danger">▼</span>
													<!-- Down arrow icon -->
													<span class="text-danger">
														{{number_format($item['PPerchange'],2)}}%</span>
													<small class="text-muted ms-1">(
														{{number_format($item['Pchange'],2)}} pts )</small>
													@else
													<span class="me-1 text-success">▲</span> <!-- Up arrow icon -->
													<span class="text-success">
														{{number_format($item['PPerchange'],2)}}%</span>
													<small class="text-muted ms-1">(+
														{{number_format($item['Pchange'],2)}} pts )</small>
													@endif


											</p>

										</div>
										<div class="text-end">
											<!-- Percentage Change with Color Symbol -->
											<p class="text-muted mb-1 fs-13" title="National Stock Exchange">IDX</p>
										</div>
									</div>

									<div class="card-body">
										<div class="d-flex justify-content-between ">
											<p class="mb-0">Last Trade Price:</p>
											<p class="font-w600 text-primary fs-4">{{number_format($item['Ltp'],2)}}</p>
										</div>

									</div>
								</div>
							</div>

							@endforeach
							@endif

							





						</div>
					</div>






					<div class="col-xl-12">
						<div class="row">
							<div id="nse-card" onclick="window.location.href='{{ route('nifty') }}'"
								class="col-xl-3 nse col-xxl-6 col-lg-12 col-sm-6 col-12">
								<div class="card trad-card overflow-hidden shadow-lg border-0 rounded-lg">
									<div
										class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
										<div>
											<h2 id="nse-title" class="text-dark mb-0 font-w600">Loading...</h2>
											<p class="mb-0 fs-5 font-w500 d-flex align-items-center">
												<span id="nse-arrow" class="me-1">▼</span>
												<span id="nse-percentage-change" class="text-success">0%</span>
												<small id="nse-point-change" class="text-muted ms-1">(0 pts)</small>
											</p>
										</div>
										<div class="text-end">
											<img src="https://assets.upstox.com/content/assets/images/logos/NSE_INDEX%7CNifty%2050.png"
												style="border-radius:50%" width="40px" height="40px" alt="">

										</div>
									</div>

									<!-- Body Section with Trade Data -->
									<div class="card-body p-3">
										<div class="d-flex justify-content-between align-items-center">
											<p class="mb-0">Last Trade Price:</p>
											<p id="nse-last-trade-price" class="font-w600 text-primary fs-4">Loading...
											</p>
										</div>
										<hr class="my-2">
										<div class="d-flex justify-content-between">
											<div>
												<p class="mb-1 text-muted">1-Year High:</p>
												<p id="nse-high-year" class="mb-0 font-w500 text-success">Loading...</p>
											</div>
											<div>
												<p class="mb-1 text-muted">1-Year Low:</p>
												<p id="nse-low-year" class="mb-0 font-w500 text-danger">Loading...</p>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div id="bse-card" onclick="window.location.href='{{ route('sensex') }}'"
								class="col-xl-3 bse col-xxl-6 col-lg-12 col-sm-6 col-12">
								<div class="card trad-card overflow-hidden shadow-lg border-0 rounded-lg">
									<div
										class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
										<div>
											<h2 id="bse-title" class="text-dark mb-0 font-w600">Loading...</h2>
											<p class="mb-0 fs-5 font-w500 d-flex align-items-center">
												<span id="bse-arrow" class="me-1">▼</span>
												<span id="bse-percentage-change" class="text-success">0%</span>
												<small id="bse-point-change" class="text-muted ms-1">(0 pts)</small>
											</p>
										</div>
										<div class="text-end">
											<img src="https://assets.upstox.com/content/assets/images/logos/BSE_INDEX%7CSENSEX.png"
												style="border-radius:50%" width="40px" height="40px" alt="">

										</div>
									</div>

									<!-- Body Section with Trade Data -->
									<div class="card-body p-3">
										<div class="d-flex justify-content-between align-items-center">
											<p class="mb-0">Last Trade Price:</p>
											<p id="bse-last-trade-price" class="font-w600 text-primary fs-4">Loading...
											</p>
										</div>
										<hr class="my-2">
										<div class="d-flex justify-content-between">
											<div>
												<p class="mb-1 text-muted">1-Year High:</p>
												<p id="bse-high-year" class="mb-0 font-w500 text-success">Loading...</p>
											</div>
											<div>
												<p class="mb-1 text-muted">1-Year Low:</p>
												<p id="bse-low-year" class="mb-0 font-w500 text-danger">Loading...</p>
											</div>
										</div>

									</div>
								</div>
							</div>


						</div>

					</div>


				</div>







				<div class="col-xl-12">
					<div class="card">
						<div class="card-header flex-wrap border-0">
							<h4 class="card-title mb-lg-0 mb-2">Trading Market List</h4>
							<ul class=" nav nav-pills light" id="pills-tab" role="tablist">
								<li class="nav-item my-1" role="presentation">
									<button class="nav-link active" id="pills-crypto-tab" data-bs-toggle="pill"
										data-bs-target="#pills-crypto" type="button" role="tab"
										aria-controls="pills-crypto" aria-selected="true">All Cryptos</button>
								</li>
								<li class="nav-item my-1" role="presentation">
									<button class="nav-link" id="pills-spot-tab" data-bs-toggle="pill"
										data-bs-target="#pills-spot" type="button" role="tab" aria-controls="pills-spot"
										aria-selected="false">Spot Markets</button>
								</li>
								<li class="nav-item my-1" role="presentation">
									<button class="nav-link" id="pills-future-tab" data-bs-toggle="pill"
										data-bs-target="#pills-future" type="button" role="tab"
										aria-controls="pills-future" aria-selected="false">Future Markets</button>
								</li>
								<li class="nav-item my-1" role="presentation">
									<button class="nav-link me-0" id="pills-listing-tab" data-bs-toggle="pill"
										data-bs-target="#pills-listing" type="button" role="tab"
										aria-controls="pills-listing" aria-selected="false">New Listing</button>
								</li>
							</ul>
						</div>
						<div class="card-body pt-0">
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-crypto" role="tabpanel"
									aria-labelledby="pills-crypto-tab">
									<div class="table-responsive dataTabletrade">
										<table id="example-history" class="table shadow-hover display  orderbookTable"
											style="min-width:845px">
											<thead>
												<tr>
													<th>Name</th>
													<th>Price</th>
													<th>Change</th>
													<th>24 High/24 Low</th>
													<th>24 Volume</th>
													<th>Market Cap</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 C 144.621094 458 54 367.378906 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 240.910156 380.550781 L 240.910156 344.929688 C 233.570312 343.921875 226.289062 342.328125 219.058594 340.101562 C 205.851562 336.039062 194 330.28125 183.5 322.828125 L 198.988281 292.609375 C 200.519531 294.128906 203.269531 296.121094 207.25 298.570312 C 211.21875 301.03125 215.921875 303.488281 221.339844 305.941406 C 226.761719 308.398438 232.769531 310.46875 239.378906 312.160156 C 244.800781 313.558594 250.339844 314.371094 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 C 251.648438 270.761719 246.949219 269.410156 241.921875 267.96875 C 233.28125 265.601562 225.789062 263.011719 219.441406 260.21875 C 213.089844 257.429688 207.789062 254.121094 203.558594 250.308594 C 199.328125 246.5 196.148438 242.101562 194.039062 237.109375 C 191.921875 232.109375 190.859375 226.148438 190.859375 219.199219 C 190.859375 210.058594 192.550781 201.929688 195.941406 194.820312 C 199.328125 187.699219 204.03125 181.78125 210.039062 177.039062 C 216.050781 172.300781 223.03125 168.699219 231 166.238281 C 234.199219 165.25 237.511719 164.46875 240.910156 163.878906 L 240.910156 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 C 255.878906 193.289062 255.75 193.289062 255.628906 193.289062 C 245.980469 193.289062 238.78125 195.070312 234.039062 198.628906 C 229.300781 202.179688 226.929688 207.179688 226.929688 213.609375 C 226.929688 217.339844 227.820312 220.429688 229.601562 222.878906 C 231.378906 225.339844 233.960938 227.5 237.351562 229.359375 C 240.730469 231.230469 245 232.921875 250.171875 234.441406 C 252.011719 234.980469 253.949219 235.539062 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 L 256 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 Z M 271.640625 195.320312 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 256 380.550781 L 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 L 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">AUD</h5>
															<span class="text-muted ms-2">Australian Doller</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>31,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>30,585.00/21,250.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,585.00/21,250.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0);"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-success">+40%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 C 144.621094 458 54 367.378906 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 240.910156 380.550781 L 240.910156 344.929688 C 233.570312 343.921875 226.289062 342.328125 219.058594 340.101562 C 205.851562 336.039062 194 330.28125 183.5 322.828125 L 198.988281 292.609375 C 200.519531 294.128906 203.269531 296.121094 207.25 298.570312 C 211.21875 301.03125 215.921875 303.488281 221.339844 305.941406 C 226.761719 308.398438 232.769531 310.46875 239.378906 312.160156 C 244.800781 313.558594 250.339844 314.371094 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 C 251.648438 270.761719 246.949219 269.410156 241.921875 267.96875 C 233.28125 265.601562 225.789062 263.011719 219.441406 260.21875 C 213.089844 257.429688 207.789062 254.121094 203.558594 250.308594 C 199.328125 246.5 196.148438 242.101562 194.039062 237.109375 C 191.921875 232.109375 190.859375 226.148438 190.859375 219.199219 C 190.859375 210.058594 192.550781 201.929688 195.941406 194.820312 C 199.328125 187.699219 204.03125 181.78125 210.039062 177.039062 C 216.050781 172.300781 223.03125 168.699219 231 166.238281 C 234.199219 165.25 237.511719 164.46875 240.910156 163.878906 L 240.910156 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 C 255.878906 193.289062 255.75 193.289062 255.628906 193.289062 C 245.980469 193.289062 238.78125 195.070312 234.039062 198.628906 C 229.300781 202.179688 226.929688 207.179688 226.929688 213.609375 C 226.929688 217.339844 227.820312 220.429688 229.601562 222.878906 C 231.378906 225.339844 233.960938 227.5 237.351562 229.359375 C 240.730469 231.230469 245 232.921875 250.171875 234.441406 C 252.011719 234.980469 253.949219 235.539062 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 L 256 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 Z M 271.640625 195.320312 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 256 380.550781 L 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 L 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">AUD</h5>
															<span class="text-muted ms-2">Australian Doller</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>31,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>30,585.00/21,250.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,585.00/21,250.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0);"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-success">+40%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-spot" role="tabpanel"
									aria-labelledby="pills-spot-tab">
									<div class="table-responsive dataTabletrade">
										<table id="example-history-1" class="table shadow-hover display  orderbookTable"
											style="min-width:845px">
											<thead>
												<tr>
													<th>Name</th>
													<th>Price</th>
													<th>Change</th>
													<th>24 High/24 Low</th>
													<th>24 Volume</th>
													<th>Market Cap</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>30,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>40,585.00/15,150.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>55,432.00/25,150.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,962.00/10,152.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.9652</td>
													<td class="text-success">+40%</td>
													<td>96,425.00/60,435.00</td>
													<td>15,752.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 C 144.621094 458 54 367.378906 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 240.910156 380.550781 L 240.910156 344.929688 C 233.570312 343.921875 226.289062 342.328125 219.058594 340.101562 C 205.851562 336.039062 194 330.28125 183.5 322.828125 L 198.988281 292.609375 C 200.519531 294.128906 203.269531 296.121094 207.25 298.570312 C 211.21875 301.03125 215.921875 303.488281 221.339844 305.941406 C 226.761719 308.398438 232.769531 310.46875 239.378906 312.160156 C 244.800781 313.558594 250.339844 314.371094 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 C 251.648438 270.761719 246.949219 269.410156 241.921875 267.96875 C 233.28125 265.601562 225.789062 263.011719 219.441406 260.21875 C 213.089844 257.429688 207.789062 254.121094 203.558594 250.308594 C 199.328125 246.5 196.148438 242.101562 194.039062 237.109375 C 191.921875 232.109375 190.859375 226.148438 190.859375 219.199219 C 190.859375 210.058594 192.550781 201.929688 195.941406 194.820312 C 199.328125 187.699219 204.03125 181.78125 210.039062 177.039062 C 216.050781 172.300781 223.03125 168.699219 231 166.238281 C 234.199219 165.25 237.511719 164.46875 240.910156 163.878906 L 240.910156 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 C 255.878906 193.289062 255.75 193.289062 255.628906 193.289062 C 245.980469 193.289062 238.78125 195.070312 234.039062 198.628906 C 229.300781 202.179688 226.929688 207.179688 226.929688 213.609375 C 226.929688 217.339844 227.820312 220.429688 229.601562 222.878906 C 231.378906 225.339844 233.960938 227.5 237.351562 229.359375 C 240.730469 231.230469 245 232.921875 250.171875 234.441406 C 252.011719 234.980469 253.949219 235.539062 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 L 256 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 Z M 271.640625 195.320312 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 256 380.550781 L 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 L 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">AUD</h5>
															<span class="text-muted ms-2">Australian Doller</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>31,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>30,585.00/21,250.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,585.00/21,250.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0);"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-success">+40%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-future" role="tabpanel"
									aria-labelledby="pills-future-tab">
									<div class="table-responsive dataTabletrade">
										<table id="example-history-2" class="table shadow-hover display  orderbookTable"
											style="min-width:845px">
											<thead>
												<tr>
													<th>Name</th>
													<th>Price</th>
													<th>Change</th>
													<th>24 High/24 Low</th>
													<th>24 Volume</th>
													<th>Market Cap</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>30,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>40,585.00/15,150.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>55,432.00/25,150.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,962.00/10,152.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-danger">Loss</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>

													</td>

													<td>$0.9652</td>
													<td class="text-success">+40%</td>
													<td>96,425.00/60,435.00</td>
													<td>15,752.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 C 144.621094 458 54 367.378906 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 240.910156 380.550781 L 240.910156 344.929688 C 233.570312 343.921875 226.289062 342.328125 219.058594 340.101562 C 205.851562 336.039062 194 330.28125 183.5 322.828125 L 198.988281 292.609375 C 200.519531 294.128906 203.269531 296.121094 207.25 298.570312 C 211.21875 301.03125 215.921875 303.488281 221.339844 305.941406 C 226.761719 308.398438 232.769531 310.46875 239.378906 312.160156 C 244.800781 313.558594 250.339844 314.371094 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 C 251.648438 270.761719 246.949219 269.410156 241.921875 267.96875 C 233.28125 265.601562 225.789062 263.011719 219.441406 260.21875 C 213.089844 257.429688 207.789062 254.121094 203.558594 250.308594 C 199.328125 246.5 196.148438 242.101562 194.039062 237.109375 C 191.921875 232.109375 190.859375 226.148438 190.859375 219.199219 C 190.859375 210.058594 192.550781 201.929688 195.941406 194.820312 C 199.328125 187.699219 204.03125 181.78125 210.039062 177.039062 C 216.050781 172.300781 223.03125 168.699219 231 166.238281 C 234.199219 165.25 237.511719 164.46875 240.910156 163.878906 L 240.910156 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 C 255.878906 193.289062 255.75 193.289062 255.628906 193.289062 C 245.980469 193.289062 238.78125 195.070312 234.039062 198.628906 C 229.300781 202.179688 226.929688 207.179688 226.929688 213.609375 C 226.929688 217.339844 227.820312 220.429688 229.601562 222.878906 C 231.378906 225.339844 233.960938 227.5 237.351562 229.359375 C 240.730469 231.230469 245 232.921875 250.171875 234.441406 C 252.011719 234.980469 253.949219 235.539062 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 L 256 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 Z M 271.640625 195.320312 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 256 380.550781 L 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 L 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">AUD</h5>
															<span class="text-muted ms-2">Australian Doller</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>31,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>30,585.00/21,250.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,585.00/21,250.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0);"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-success">+40%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-listing" role="tabpanel"
									aria-labelledby="pills-listing-tab">
									<div class="table-responsive dataTabletrade">
										<table id="example-history-3"
											class="table shadow-hover centered display  orderbookTable"
											style="min-width:845px">
											<thead>
												<tr>
													<th>Name</th>
													<th>Price</th>
													<th>Change</th>
													<th>24 High/24 Low</th>
													<th>24 Volume</th>
													<th>Market Cap</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>

													</td>

													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>30,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>40,585.00/15,150.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>55,432.00/25,150.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,962.00/10,152.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.9652</td>
													<td class="text-success">+40%</td>
													<td>96,425.00/60,435.00</td>
													<td>15,752.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 C 144.621094 458 54 367.378906 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 240.910156 380.550781 L 240.910156 344.929688 C 233.570312 343.921875 226.289062 342.328125 219.058594 340.101562 C 205.851562 336.039062 194 330.28125 183.5 322.828125 L 198.988281 292.609375 C 200.519531 294.128906 203.269531 296.121094 207.25 298.570312 C 211.21875 301.03125 215.921875 303.488281 221.339844 305.941406 C 226.761719 308.398438 232.769531 310.46875 239.378906 312.160156 C 244.800781 313.558594 250.339844 314.371094 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 C 251.648438 270.761719 246.949219 269.410156 241.921875 267.96875 C 233.28125 265.601562 225.789062 263.011719 219.441406 260.21875 C 213.089844 257.429688 207.789062 254.121094 203.558594 250.308594 C 199.328125 246.5 196.148438 242.101562 194.039062 237.109375 C 191.921875 232.109375 190.859375 226.148438 190.859375 219.199219 C 190.859375 210.058594 192.550781 201.929688 195.941406 194.820312 C 199.328125 187.699219 204.03125 181.78125 210.039062 177.039062 C 216.050781 172.300781 223.03125 168.699219 231 166.238281 C 234.199219 165.25 237.511719 164.46875 240.910156 163.878906 L 240.910156 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 C 255.878906 193.289062 255.75 193.289062 255.628906 193.289062 C 245.980469 193.289062 238.78125 195.070312 234.039062 198.628906 C 229.300781 202.179688 226.929688 207.179688 226.929688 213.609375 C 226.929688 217.339844 227.820312 220.429688 229.601562 222.878906 C 231.378906 225.339844 233.960938 227.5 237.351562 229.359375 C 240.730469 231.230469 245 232.921875 250.171875 234.441406 C 252.011719 234.980469 253.949219 235.539062 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 271.640625 195.320312 C 266.5 194 261.289062 193.320312 256 193.300781 L 256 131.199219 L 270.910156 131.199219 L 270.910156 163.460938 C 278.21875 164.398438 285.148438 166.089844 291.699219 168.53125 C 302.371094 172.511719 311.679688 177.210938 319.640625 182.621094 L 304.148438 211.070312 C 302.960938 209.890625 300.800781 208.28125 297.671875 206.25 C 294.539062 204.210938 290.71875 202.230469 286.238281 200.28125 C 281.75 198.328125 276.878906 196.679688 271.640625 195.320312 Z M 271.640625 195.320312 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 325.988281 292.609375 C 325.988281 302.261719 324.171875 310.511719 320.53125 317.371094 C 316.890625 324.230469 311.980469 329.78125 305.800781 334.011719 C 299.621094 338.238281 292.5 341.328125 284.460938 343.28125 C 280.058594 344.339844 275.539062 345.109375 270.910156 345.589844 L 270.910156 380.550781 L 256 380.550781 L 256 314.609375 C 257.230469 314.671875 258.460938 314.699219 259.699219 314.699219 C 279 314.699219 288.648438 308.519531 288.648438 296.160156 C 288.648438 292.269531 287.550781 288.96875 285.351562 286.261719 C 283.148438 283.550781 280.019531 281.179688 275.949219 279.140625 C 271.890625 277.109375 266.980469 275.25 261.21875 273.558594 C 259.539062 273.058594 257.800781 272.550781 256 272.03125 L 256 236.101562 C 259.691406 237.121094 263.710938 238.179688 268.078125 239.269531 C 276.878906 241.640625 284.878906 244.179688 292.078125 246.890625 C 299.28125 249.601562 305.371094 252.980469 310.371094 257.050781 C 315.359375 261.109375 319.21875 265.980469 321.929688 271.648438 C 324.628906 277.328125 325.988281 284.308594 325.988281 292.609375 Z M 325.988281 292.609375 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">AUD</h5>
															<span class="text-muted ms-2">Australian Doller</span>
														</a>
													</td>
													<td>$0.6932</td>
													<td class="text-success">+22%</td>
													<td>30,585.00/21,250.00</td>
													<td>30,585.00</td>
													<td>$96M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon">
																<svg xmlns="http://www.w3.org/2000/svg" height="512pt"
																	version="1.1" viewBox="0 0 512 512" width="512pt">
																	<g>
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 C 187.621094 512 123.328125 485.371094 74.980469 437.019531 C 26.628906 388.671875 0 324.378906 0 256 C 0 187.621094 26.628906 123.328125 74.980469 74.980469 C 123.328125 26.628906 187.621094 0 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.666667%,12.54902%);fill-opacity:1;" />
																		<path
																			d="M 512 256 C 512 324.378906 485.371094 388.671875 437.019531 437.019531 C 388.671875 485.371094 324.378906 512 256 512 L 256 0 C 324.378906 0 388.671875 26.628906 437.019531 74.980469 C 485.371094 123.328125 512 187.621094 512 256 Z M 512 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,53.72549%,0%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 278.53125 454.289062 300.210938 447.449219 320.46875 C 443.941406 330.871094 439.601562 340.898438 434.511719 350.46875 C 400.558594 414.378906 333.269531 458 256 458 C 178.730469 458 111.441406 414.378906 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 C 57.710938 300.210938 54 278.53125 54 256 C 54 144.621094 144.621094 54 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,92.54902%,59.215686%);fill-opacity:1;" />
																		<path
																			d="M 458 256 C 458 367.378906 367.378906 458 256 458 L 256 54 C 367.378906 54 458 144.621094 458 256 Z M 458 256 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,85.882353%,17.647059%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 255.988281 321.46875 L 182.761719 235.171875 L 182.761719 350.46875 L 77.488281 350.46875 C 72.398438 340.898438 68.058594 330.871094 64.550781 320.46875 L 152.761719 320.46875 L 152.761719 153.449219 L 255.988281 275.109375 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,75.686275%);fill-opacity:1;" />
																		<path
																			d="M 447.449219 320.46875 C 447.070312 321.601562 446.679688 322.730469 446.269531 323.851562 C 446.148438 324.210938 446.011719 324.578125 445.878906 324.941406 C 445.828125 325.089844 445.769531 325.238281 445.71875 325.378906 C 445.378906 326.320312 445.019531 327.261719 444.660156 328.199219 C 444.359375 329 444.050781 329.789062 443.71875 330.578125 C 443.5 331.148438 443.28125 331.71875 443.039062 332.28125 C 442.941406 332.550781 442.828125 332.808594 442.710938 333.078125 C 442.339844 333.988281 441.960938 334.890625 441.570312 335.78125 C 441.101562 336.878906 440.621094 337.96875 440.128906 339.050781 C 439.988281 339.351562 439.859375 339.648438 439.71875 339.941406 C 439.300781 340.859375 438.871094 341.78125 438.441406 342.691406 C 438.308594 342.960938 438.179688 343.230469 438.050781 343.5 C 437.5 344.628906 436.949219 345.75 436.378906 346.859375 C 435.769531 348.070312 435.148438 349.269531 434.511719 350.46875 L 329.21875 350.46875 L 329.21875 235.171875 L 256 321.460938 L 256 275.101562 L 359.21875 153.449219 L 359.21875 320.46875 Z M 447.449219 320.46875 "
																			style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,67.058824%,58.039216%);fill-opacity:1;" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XMR</h5>
															<span class="text-muted ms-2">Monero</span>
														</a>
													</td>
													<td>$0.3685</td>
													<td class="text-danger">-8%</td>
													<td>31,585.00/21,250.00</td>
													<td>75,52.00</td>
													<td>$30M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 48 48" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m28.121 17.793c-2.171 2.254-6.071 2.254-8.242 0 0 0-3.293-3.293-3.293-3.293h-2.172l5.172 5.172c2.325 2.421 6.503 2.421 8.828 0 0 0 5.172-5.172 5.172-5.172h-2.172z" />
																		<path
																			d="m24 2c-12.131 0-22 9.869-22 22 1.208 29.186 42.796 29.178 44 0 0-12.131-9.869-22-22-22zm12.924 32.883c-.154.373-.52.617-.924.617h-5c-.266 0-.52-.105-.707-.293l-3.586-3.586c-1.427-1.48-3.988-1.48-5.414 0 0 0-3.586 3.586-3.586 3.586-.187.188-.441.293-.707.293h-5c-.861.028-1.341-1.116-.707-1.707 0 0 6.879-6.879 6.879-6.879 3.07-3.197 8.587-3.198 11.656 0 0 0 6.879 6.879 6.879 6.879.286.286.372.716.217 1.09zm-.217-20.676-6.879 6.879c-3.07 3.197-8.587 3.198-11.656 0 0 0-6.879-6.879-6.879-6.879-.629-.59-.16-1.736.707-1.707h5c.266 0 .52.105.707.293l3.586 3.586c.713.712 1.699 1.121 2.707 1.121s1.994-.409 2.707-1.121l3.586-3.586c.187-.188.441-.293.707-.293h5c.861-.028 1.341 1.116.707 1.707z" />
																		<path
																			d="m24 26.5c-1.667 0-3.234.649-4.414 1.828l-5.172 5.172h2.172l3.293-3.293c1.085-1.085 2.587-1.707 4.121-1.707s3.036.622 4.121 1.707l3.293 3.293h2.172l-5.172-5.172c-1.18-1.179-2.747-1.828-4.414-1.828z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">XRP</h5>
															<span class="text-muted ms-2">Ripplecoin</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-danger">-11%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-warning">
																<svg height="512" viewBox="0 0 70 70" width="512"
																	xmlns="http://www.w3.org/2000/svg"
																	data-name="Layer 2">
																	<path
																		d="m42.8 44.76h-13.64l14.45-19.93a1 1 0 0 0 -.81-1.59h-6.8v-3a1 1 0 0 0 -2 0v3h-6.8a1 1 0 0 0 0 2h13.64l-14.45 19.93a1 1 0 0 0 .81 1.59h6.8v3a1 1 0 0 0 2 0v-3h6.8a1 1 0 0 0 0-2z" />
																	<path
																		d="m35 .5a34.5 34.5 0 1 0 34.5 34.5 34.54 34.54 0 0 0 -34.5-34.5zm0 67a32.5 32.5 0 1 1 32.5-32.5 32.54 32.54 0 0 1 -32.5 32.5z" />
																	<path
																		d="m35 8.5a26.5 26.5 0 1 0 26.5 26.5 26.53 26.53 0 0 0 -26.5-26.5zm0 51a24.5 24.5 0 1 1 24.5-24.5 24.53 24.53 0 0 1 -24.5 24.5z" />
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ZEC</h5>
															<span class="text-muted ms-2">ZCash</span>
														</a>
													</td>
													<td>$0.9632</td>
													<td class="text-success">+9%</td>
													<td>30,585.00/21,250.00</td>
													<td>96,525.00</td>
													<td>$18M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0)">
															<div class="market-icon bg-success">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<path
																			d="m437.019 74.98c-48.352-48.352-112.639-74.98-181.019-74.98s-132.667 26.628-181.019 74.98c-48.352 48.354-74.981 112.641-74.981 181.02s26.629 132.666 74.981 181.02c48.352 48.352 112.64 74.98 181.019 74.98 22.775 0 45.34-2.97 67.067-8.83 3.97-1.07 6.321-5.157 5.25-9.127-1.071-3.969-5.158-6.324-9.127-5.25-20.464 5.518-41.724 8.316-63.19 8.316-64.402 0-124.95-25.08-170.49-70.619-45.54-45.54-70.619-106.089-70.619-170.49s25.079-124.95 70.619-170.49 106.087-70.619 170.49-70.619 124.951 25.08 170.49 70.619 70.619 106.089 70.619 170.49-25.079 124.95-70.619 170.49c-22.021 22.02-47.5 39.301-75.73 51.364-3.781 1.615-5.537 5.99-3.921 9.772 1.616 3.78 5.99 5.538 9.772 3.921 29.985-12.812 57.038-31.158 80.409-54.526 48.351-48.355 74.98-112.642 74.98-181.021s-26.629-132.666-74.981-181.02z" />
																		<path
																			d="m93.173 125.146c-3.293-2.466-7.958-1.793-10.422 1.499-28.158 37.62-43.042 82.35-43.042 129.355 0 119.263 97.028 216.291 216.291 216.291s216.291-97.028 216.291-216.291-97.028-216.291-216.291-216.291c-55.922 0-109.014 21.349-149.496 60.115-2.969 2.844-3.072 7.557-.228 10.527 2.844 2.968 7.556 3.072 10.527.228 37.697-36.098 87.131-55.979 139.197-55.979 111.052 0 201.4 90.348 201.4 201.4s-90.348 201.4-201.4 201.4-201.4-90.348-201.4-201.4c0-43.763 13.857-85.408 40.072-120.432 2.464-3.293 1.793-7.959-1.499-10.422z" />
																		<path
																			d="m141.186 346.889c3.883 4.853 9.675 7.636 15.89 7.636h139.271c18.446 0 36.538-6.347 50.941-17.872s24.563-27.784 28.609-45.781l12.858-57.2c4.965-22.086-.3-44.893-14.444-62.57s-35.24-27.815-57.879-27.815h-121.021c-9.588 0-17.752 6.533-19.855 15.888l-13.861 61.664h-32.581c-7.529 0-14.064 5.101-15.89 12.404l-7.025 28.081c-1.035 4.139-.123 8.44 2.502 11.802 2.624 3.362 6.576 5.29 10.841 5.29h29.21l-11.531 51.294c-1.364 6.065.081 12.326 3.965 17.179zm-13.517-110.032c.166-.664.76-1.127 1.445-1.127h136.733l-6.672 26.669c-.166.664-.76 1.128-1.444 1.128h-136.734zm80.097 41.56h49.964c7.528 0 14.063-5.1 15.89-12.404l7.025-28.081c1.035-4.139.123-8.44-2.502-11.802-2.624-3.362-6.576-5.29-10.841-5.29h-46.594l4.49-19.973h90.692c5.298 0 10.144 2.188 13.295 6.004 3.286 3.98 4.523 9.146 3.392 14.175l-12.858 57.199c-2.476 11.012-12.087 18.703-23.374 18.703h-92.746zm-15.262 0-4.929 21.923c-.631 2.81.039 5.711 1.839 7.959 1.8 2.249 4.484 3.539 7.364 3.539h99.57c18.302 0 33.888-12.471 37.902-30.328l12.858-57.199c2.148-9.554-.199-19.367-6.438-26.923-5.99-7.254-15.021-11.413-24.778-11.413h-95.062c-4.444 0-8.228 3.029-9.201 7.363l-6.182 27.501h-28.491l13.128-58.398c.564-2.509 2.755-4.262 5.327-4.262h121.021c18.091 0 34.95 8.102 46.253 22.227 11.303 14.127 15.51 32.352 11.542 50.002l-12.858 57.2c-3.307 14.71-11.611 27.999-23.384 37.419s-26.56 14.608-41.638 14.608h-139.271c-2.283 0-3.651-1.284-4.263-2.048-.613-.766-1.565-2.382-1.064-4.61l12.265-54.559h28.49z" />
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">Dash</h5>
															<span class="text-muted ms-2">Dash</span>
														</a>
													</td>
													<td>$0.1478</td>
													<td class="text-success">+11%</td>
													<td>30,585.00/21,250.00</td>
													<td>14,752.00</td>
													<td>$9M</td>
													<td class="text-end"><a href="javascript:void(0);"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
												<tr>
													<td>
														<a class="market-title d-flex align-items-center"
															href="javascript:void(0);">
															<div class="market-icon">
																<svg enable-background="new 0 0 512 512" height="512"
																	viewBox="0 0 512 512" width="512"
																	xmlns="http://www.w3.org/2000/svg">
																	<g>
																		<circle cx="256" cy="256" fill="#4793ff"
																			r="256" />
																		<path
																			d="m256 0c141.159 0 256 114.841 256 256s-114.841 256-256 256z"
																			fill="#5e69e2" />
																		<circle cx="256" cy="256" fill="#2ebeef"
																			r="191.733" />
																		<path
																			d="m256 64.267c105.722 0 191.733 86.011 191.733 191.733s-86.011 191.733-191.733 191.733z"
																			fill="#4793ff" />
																		<g>
																			<path
																				d="m243.519 127.179-80.333 120.5c-3.359 5.038-3.359 11.603 0 16.641l80.333 120.5c5.937 8.906 19.024 8.906 24.962 0l80.333-120.5c3.359-5.038 3.359-11.603 0-16.641l-80.333-120.5c-5.938-8.906-19.024-8.906-24.962 0z"
																				fill="#76e5f6" />
																			<path
																				d="m256 275.375v116.125c4.756 0 9.512-2.226 12.481-6.679l80.333-120.5c1.562-2.343 2.388-5.015 2.497-7.711l-92.37 18.474c-.97.194-1.956.291-2.941.291z"
																				fill="#2ebeef" />
																			<path
																				d="m256 120.5c-4.756 0-9.512 2.226-12.481 6.679l-80.333 120.5c-1.797 2.696-2.623 5.828-2.497 8.931l92.369 18.474c.971.194 1.957.291 2.942.291z"
																				fill="#c2f4fb" />
																		</g>
																	</g>
																</svg>
															</div>
															<h5 class="mb-0 ms-2">ETH</h5>
															<span class="text-muted ms-2">Etherium Classic</span>
														</a>
													</td>
													<td>$0.6258</td>
													<td class="text-success">+40%</td>
													<td>30,585.00/21,250.00</td>
													<td>80,752.00</td>
													<td>$22M</td>
													<td class="text-end"><a href="javascript:void(0)"
															class="badge badge-sm badge-success">Trade</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!--**********************************
            Content body end
        ***********************************-->



	<!--**********************************
            Footer start
        ***********************************-->
	<div class="footer">
		<div class="copyright">
			<p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a>
				<span class="current-year">2024</span>
			</p>
		</div>
	</div>
	<!--**********************************
            Footer end
        ***********************************-->

	<!--**********************************
           Support ticket button start
        ***********************************-->

	<!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end

    ***********************************-->

	<script>
		$(document).ready(function () {
			// Fetch NSE data
			$.ajax({
				url: '/api/fetchstockinfo/nse',
				type: 'GET',
				success: function (response) {
					const nsestockData = response.stock;
					
					// Populate NSE data in HTML
					$('#nse-title').text(nsestockData['DispSym']);
					$('#nse-last-trade-price').text(parseFloat(nsestockData['Ltp'].toFixed(2)));
					$('#nse-high-year').text(nsestockData['High1Yr']);
					$('#nse-low-year').text(nsestockData['Low1Yr']);
					$('#nse-exchange').text(nsestockData['Exch']);
					
					// Handle arrow and color based on percentage change
					const nseArrow = nsestockData['PPerchange'] > 0 ? '▲' : '▼';
					const nseColor = nsestockData['PPerchange'] > 0 ? 'text-success' : 'text-danger';
					
					$('#nse-arrow').text(nseArrow).attr('class', `me-1 ${nseColor}`);
					$('#nse-percentage-change').text(parseFloat(nsestockData['PPerchange'].toFixed(2)) + "%").attr('class', nseColor);
					$('#nse-point-change').text("(" + parseFloat(nsestockData['Pchange'].toFixed(2)) + " pts)");
				},
				error: function (error) {
					console.log(error);
				}
			});
	
			// Fetch BSE data
			$.ajax({
				url: '/api/fetchstockinfo/bse',
				type: 'GET',
				success: function (response) {
					const bsestockData = response.stock;
	
					// Populate BSE data in HTML
					$('#bse-title').text(bsestockData['DispSym']);
					$('#bse-last-trade-price').text(parseFloat(bsestockData['Ltp']).toFixed(2));
					$('#bse-high-year').text(bsestockData['High1Yr']);
					$('#bse-low-year').text(bsestockData['Low1Yr']);
					$('#bse-exchange').text(bsestockData['Exch']);
					
					// Handle arrow and color based on percentage change
					const bseArrow = bsestockData['PPerchange'] > 0 ? '▲' : '▼';
					const bseColor = bsestockData['PPerchange'] > 0 ? 'text-success' : 'text-danger';
					
					$('#bse-arrow').text(bseArrow).attr('class', `me-1 ${bseColor}`);
					$('#bse-percentage-change').text(parseFloat(bsestockData['PPerchange'].toFixed(2)) + "%").attr('class', bseColor);
					$('#bse-point-change').text("(" + parseFloat(bsestockData['Pchange'].toFixed(2)) + " pts)");
				},
				error: function (error) {
					console.log(error);
				}
			});
		});
	</script>


	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="js/plugins-init/datatables.init.js"></script>
	<script src="vendor/chart-js/chart.bundle.min.js"></script>
	<!-- Chart piety plugin files -->
	<script src="vendor/peity/jquery.peity.min.js"></script>
	<script src="js/dashboard/trading-market.js"></script>
	<!-- Dashboard 1 -->
	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script>
        Echo.channel('watchlists')
    .listen('Watchlist', (event) => {
        console.log(event);
    });

    </script>




</body>

</html>