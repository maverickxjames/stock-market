<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchStockData($id)
    {
        $today = Carbon::now();
        $time = $today->format('H:i:s');



        // Check if today is Saturday (6) or Sunday (0)
        if ($today->isSaturday()) {
            // If today is Saturday, get the previous Friday
            $today = $today->subDay(1);
        } elseif ($today->isSunday()) {
            // If today is Sunday, get the previous Friday
            $today = $today->subDays(2);
        }

        $today = $today->subDay(1);

        if ($time >= '09:15:00' && $time <= '15:30:00') {
            $stocktype = 'intraday';
        } else {
            $stocktype = 'historical';
        }

        // Format the date as needed, e.g., 'Y-m-d'
        $cu = $today->format('Y-m-d');

        // Set the URL with the given $id
        $url = "https://service.upstox.com/charts/v2/open/" . $stocktype . "/IN/NSE_EQ%7C" . $id . "/1minute/" . $cu . "/";

        // Make the HTTP GET request to fetch data
        $response = Http::get($url);

        // Check if the request was successful
        if ($response->successful()) {
            // Decode JSON response and access the specific data structure
            $data = $response->json()['data']['candles'] ?? [];

            // Reverse the data
            $data = array_reverse($data);

            // Return a JSON response with the data
            return response()->json($data);
        } else {
            // Return an error response if the request failed
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
    }

    public function fetchstockinfo($stocktype)
    {
        $url = "https://ow-scanx-analytics.dhan.co/customscan/fetchdt";

        // Common headers
        $headers = [
            'Content-Type: application/json; charset=UTF-8',
            'Accept: */*',
            'User-Agent: Mozilla/5.0'
        ];

        // Data for NSE (National Stock Exchange)
        if($stocktype == 'nse'){
            $stockdata = [
                "data" => [
                    'sort' => 'PPerchange',
                    'sorder' => 'desc',
                    'count' => 5,
                    'params' => [
                        ['field' => 'Sid', 'op' => '', 'val' => '13,25,27,38,17'],
                        ['field' => 'Exch', 'op' => '', 'val' => 'IDX'],
                    ],
                    "fields" => [
                        'DispSym',
                        'Exch',
                        'High1Yr',
                        'Inst',
                        'Low1Yr',
                        'Ltp',
                        'PPerchange',
                        'Pchange',
                        'Seg',
                        'Seosym',
                        'Sid',
                        'TickSize',
                        'Volume',
                        'Sym',
                    ],
                    "pgno" => 1  // Page number for testing
                ]
            ];
        }elseif($stocktype = 'bse'){
            $stockdata = [
                "data" => [
                    'count' => 5,
                    'params' => [
                        ['field' => 'Sid', 'op' => '', 'val' => '51,82,64,69,65'],
                        ['field' => 'Exch', 'op' => '', 'val' => 'IDX'],
                    ],
                    "fields" => [
                        'DispSym',
                        'Exch',
                        'High1Yr',
                        'Inst',
                        'Low1Yr',
                        'Ltp',
                        'PPerchange',
                        'Pchange',
                        'Seg',
                        'Seosym',
                        'Sid',
                        'TickSize',
                        'Volume',
                        'Sym',
                    ],
                    "pgno" => 1  // Page number for testing
                ]
            ];
        }

        // Data for BSE (Bombay Stock Exchange)
        

        // Function to send the request and fetch data
        function fetchData($url, $headers, $data)
        {
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
        $nseResponse = fetchData($url, $headers, $stockdata);
        $nseResponse = json_decode($nseResponse, true);
        $nseStocks = [];
        foreach($nseResponse['data'] as $stock){
            if($stock['DispSym'] == 'Nifty 50'){
                $nseStocks['stock'] = $stock;
            }elseif($stock['DispSym'] == 'Sensex'){
                $nseStocks['stock'] = $stock;
            }
        }

        return response()->json($nseStocks);
    }
}
