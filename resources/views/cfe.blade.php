<?php
// Initialize cURL session
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, "https://www.nseindia.com/api/quote-equity?symbol=HDFCLIFE");



// Attach headers to the cURL session
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"
));

// Disable Content Encoding
curl_setopt($ch, CURLOPT_ENCODING, "");

// Set options to return the response instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "cURL error: " . curl_error($ch);
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Output the data
    echo "<pre>";
    print_r($data['data ']);
    echo "</pre>";

}



// Close the cURL session
curl_close($ch);
?>
