<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
// db facades 
use Illuminate\Support\Facades\DB;



class StockController extends Controller
{
    public function nifty()
    {
        return view('nifty');
    }
    public function sensex()
    {
        return view('sensex');
    }

    public function niftyInner($slug, $id)
    {
        return view('stockview', ['id' => $id]);
    }

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
    public function fetchNifty50StockData()
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
        $url = "https://service.upstox.com/charts/v2/open/" . $stocktype . "/IN/NSE_INDEX%7CNifty%2050/1minute/" . $cu . "/";

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
    public function fetchSensexStockData()
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
        $url = "https://service.upstox.com/charts/v2/open/" . $stocktype . "/IN/BSE_INDEX%7CSENSEX/1minute/" . $cu . "/";

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

    public function orderHistory(Request $request)
    {
        return view('order');
    }

    public function watchlist(Request $request)
    {
        return view('watchlist');
    }

    public function fetchWatchlist(Request $request)
    {

        $token = DB::select("SELECT * FROM upstocks WHERE isExpired = 0 ORDER BY id DESC LIMIT 1");
        // $accessToken = "";
        if ($token) {
            $accessToken = $token[0]->token;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No token found',
            ], 500);
        }

        $instrumentKeys = "";

        $watchlist = DB::table('equities')
            ->whereIn('id', function ($query) {
                $query->select('script_name') // Replace 'equity_id' with the correct column name from watchlists
                    ->distinct()
                    ->from('watchlists');
            })
            ->get(['Isin']);

        foreach ($watchlist as $key => $value) {
            $instrumentKeys .= 'NSE_EQ|' . $value->Isin . ',';
        }

        $instrumentKeys = rtrim($instrumentKeys, ',');





        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get('https://api.upstox.com/v2/market-quote/quotes', [
                'instrument_key' => $instrumentKeys,
            ]);

            if ($response->successful()) {
                // websocket 
                $data = $response->json();
                
                event(new \App\Events\Watchlist($data));
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch data from API',
                    'error' => $response->json(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
