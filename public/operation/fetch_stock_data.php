<?php
$url = "https://ow-scanx-analytics.dhan.co/customscan/fetchdt";

$headers = [
    'Content-Type: application/json; charset=UTF-8',
    'Accept: */*',
    'User-Agent: Mozilla/5.0'
];

$data = [
    "data" => [
        "sort" => "Mcap",
        "sorder" => "desc",
        "count" => 10,  // Reduced for testing
        "params" => [
            [
                "field" => "idxlist.Indexid",
                "op" => "",
                "val" => "13"
            ],
            [
                "field" => "Exch",
                "op" => "",
                "val" => "NSE"
            ],
            [
                "field" => "OgInst",
                "op" => "",
                "val" => "ES"
            ]
        ],
        "fields" => [
            "Isin", "DispSym", "Mcap", "Pe", "DivYeild", "Revenue", "Year1RevenueGrowth", 
            "NetProfitMargin", "YoYLastQtlyProfitGrowth", "EBIDTAMargin", "volume",
            "PricePerchng1year", "PricePerchng3year", "PricePerchng5year", "Ind_Pe",
            "Pb", "DivYeild", "Eps", "DaySMA50CurrentCandle", "DaySMA200CurrentCandle",
            "DayRSI14CurrentCandle", "ROCE", "Roe", "Sym", "PricePerchng1mon", "PricePerchng3mon"
        ],
        "pgno" => 1  // Reduced page number for testing
    ]
];

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute the request
$response = curl_exec($ch);

// Check for errors and HTTP status code
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} elseif (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
    echo "HTTP Error: " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
} else {
    // Decode and display the response
    $result = json_decode($response, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        echo "JSON Decode Error: " . json_last_error_msg();
    }
}

// Close the cURL session
curl_close($ch);
?>
