<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
// db facades 
use Illuminate\Support\Facades\DB;
// import model wathclist
use App\Models\Watchlist;

class WatchlistController extends Controller
{
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

    public function addWatchlist(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'segment' => 'required|integer',                     // Segment is required and must be an integer
            'script' => 'required|string',                      // Script name is required and must be a string
            'expiry' => 'required|date_format:Y-m-d',           // Expiry must be in YYYY-MM-DD format
            'callPut' => 'nullable|string|in:CE,PE',            // Call/Put is optional but must be CE or PE
            'strike' => 'nullable|numeric',                     // Strike is optional but must be a number
        ]);

        $isExists = Watchlist::where('userid', auth()->id())
            ->where('script_id', $request->segment)
            ->where('script_name', $request->script)
            ->where('script_expiry', $request->expiry)
            ->where('call_put', $request->callPut)
            ->where('strike_price', $request->strike)
            ->exists();
        
        if ($isExists) {
            return response()->json([
                'success' => false,
                'message' => 'Watchlist entry already exists.',
            ], 409);
        }


        // Return validation errors, if any
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            
            $watchlist = new Watchlist();

            $watchlist->userid = auth()->id();
            $watchlist->script_id = $request->segment;
            $watchlist->script_name = $request->script;
            $watchlist->script_expiry = $request->expiry;

           
            if ($request->segment == 2) {
                $watchlist->call_put = $request->callPut;
                $watchlist->strike_price = $request->strike;
            } else {
                $watchlist->call_put = null; 
                $watchlist->strike_price = null;
            }

            // Save the watchlist entry to the database
            $watchlist->save();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Watchlist entry added successfully.',
                'data' => $watchlist,
            ], 201);

        } catch (\Exception $e) {
            // Handle any errors that occur during saving
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the watchlist.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeWatchlist(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer', // ID is required and must be an integer
        ]);

        // Return validation errors, if any
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the watchlist entry by ID
            $watchlist = Watchlist::find($request->id);

            // Check if the watchlist entry exists
            if ($watchlist) {
                // Delete the watchlist entry
                $watchlist->delete();

                // Return a success response
                return response()->json([
                    'success' => true,
                    'message' => 'Watchlist entry removed successfully.',
                ], 200);
            } else {
                // Return an error response if the watchlist entry does not exist
                return response()->json([
                    'success' => false,
                    'message' => 'Watchlist entry not found.',
                ], 404);
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during deletion
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing the watchlist entry.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
