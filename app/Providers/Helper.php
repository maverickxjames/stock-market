<?php

namespace App\Providers;

use App\Models\Script;
use App\Models\Equity;
use App\Models\watchlist;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class   Helper
{

    public static function allCompanyData($userid)
    {

        $data = watchlist::where('userid', $userid)->get();
        for ($i = 0; $i < count($data); $i++) {
            $newdata = Equity::where('id', $data[$i]['script_name'])->get(['symbol', 'Isin']);
            // merge two array in one array
            $combile[] = array_merge($data[$i]->toArray(), $newdata[0]->toArray());
        }


        $curl = curl_init();

        $cookie = '_ga=GA1.1.1463179861.1733387592; nseQuoteSymbols=[{"symbol":"AXISBANK","identifier":null,"type":"equity"}]; defaultLang=en; nsit=MpwdGs1XB6gnEswby6amc1wP; AKA_A2=A; _abck=E65FDA2290AD6615EB1C42885DC2D002~0~YAAQZ/hWuOFWyTGTAQAAku6tnQ1M/Av7HjbPBsboAalCjLCkh6W9hqqHP3L4QAaXdZ3YUFKw5jHvbZ6Yrk6pHcaWWi2k49cjFn2nxWjkkwpjeOfP+kqXnlStRtGrn/Uz+h9HgLXoHDjjfcOuGrES1Th08448SKgi/GyE1r1l8lUsP7A90wBjCO8Ij8er3uj2jJZVkaNd3oFI0bzoOOsamo3tHyYX9O/L+h9VX/OJyVtdowNGSvbCry97TW94WPXVS5JqV8hD5A13UhPnim0EY6qYbb1yZiDlo1HRI8xIhRnahSjeh6CRHiA09QwckK5shZXqJe0zl3TsNY5QE5vGevrajWXqUhB0N2c4FH6WXD6YhA249UdAXcflcsJxU42foIsNfMQpqeF4XgIN/R/hLC+N2vvpYqFHoCrqW+7GKyGnOTZ7Az69uhGAtpxc0uDGENIb6iUyfF03a412y1XlUtHpcKOC9peox8GRYPfvRKa0GQ==~-1~-1~-1; nseappid=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJhcGkubnNlIiwiYXVkIjoiYXBpLm5zZSIsImlhdCI6MTczMzUxNzI2NSwiZXhwIjoxNzMzNTI0NDY1fQ.zFuziInbv07KI3kgU5sDtAwRvjM276QGW8ug9XQ5kZ8; bm_mi=70617EDAA92DF8BF1AB6718F130C158C~YAAQZ/hWuMhXyTGTAQAA20qunRqfpBgIoVaIvLS7t9aHz7B9aak+6Sl6BjU2PHmGRVZW5kFUy4fkvb/5UXoYVrKYUWacI+JRxE/T2GQbB2tOojmg27UY2C8t+jeG4n5tkIAYYB2QWaxtPfnxO3Fvre0CftXCti2w6tQAKgw2/mKjlxvUUVbIVI8MEu4tfpAZHs7oYE69KqLma2WpdpErud7EgE7DIMl0nZ3Ld2nMPDILUKviW1EYlVo5NkKxxS3I7UbhMw+t7Vcxx8MrqjFUlrzu35/yF2LmvEDopiA+78h4YfiRnzBrWXpnoYnKyIKmwNGu/HSoMZySb9O6WIyZLxKdQrxP9rA6/ikeDd5Fm8dL4aBtWHY9c/Xn4puSHg==~1; ak_bmsc=D22A08A12C90480D37092A03032029D7~000000000000000000000000000000~YAAQZ/hWuPdXyTGTAQAAok6unRqsznqRYsKmqTdDOb3oFL7UT7AciLDPpyndLt6bwi9vycCS4D3FJJHLD6tZplgi/3MBb7SKcnwt7Jivo+OrULGPvI896bv3NZzCPiLJgSDBxdJfV6DspP5F88Fsbx/y2QaegIz8nQGK5KPaDUpJOqDZH1SjEkuSg6ITqibJsTShtlfBQ/XrbqALou5uJcahGrIkLpz+E0o9pSVYdyEi3gjTESJSR/SDa7h9Bz5MzxHjLEylTrC2Jz0WNeA1kR6dxWmoW7ObgKjavcN49sVV0f9U5ZwMNrnqQzmMW4PDhZ0CjWDTfHlT4jqVsCJZIaUCh17QmltdvgCjLKYyjfKdGge1MNgcwqXLT9Mnp/GeACEqCxWblTXokld2h4nvchu11U4XbPFYMRKFAuRjKocPJ0gE9JKE9JXf+W23+MMBJzz7pL4S4HK/Fn++wNmNSBQAsRERWa7Pbiz8Sjiqd5Jpd7J3ON4enI3Z07fGOJUjWEU0FEA4UzMKnfdKju0U7knZCxwsuFC2TNjCRQsB7h0=; _ga_87M7PJ3R97=GS1.1.1733517242.7.1.1733517268.34.0.0; _ga_WM2NSQKJEK=GS1.1.1733517242.7.1.1733517268.0.0.0; RT="z=1&dm=nseindia.com&si=da828c54-14e2-4a9c-81a1-a2a3184f29f4&ss=m4clhguo&sl=0&se=8c&tt=0&bcn=%2F%2F684d0d45.akstat.io%2F"; bm_sz=59BCC9C21DC5496A6D1C98A1662C011F~YAAQZ/hWuHZnyTGTAQAAw8W7nRqIzkVY0XdrD6Ey/SfrDiW6vZLnxGBajjAMODKExBUEOrj2B//TQJw2uzcGfZ1tt/X+rkS3q0wOo9qxKHcXX0X8zW3TCt5WktCMCvCElSbXc5pggmkpTuBn2ZApIqoX5AqgJYd6zPd3dB/EoYnMqCKjFR+AVk9ZjrpOqMp5if+q14yWBNk72eE5QivSW2riL4DY4ZRri1x2qc18a5orYGP+ABHoekIRMzimxLipytke/elap6q1zo8DAY60IrAwwPFj5Gjb5PRj6wf3QSpSdjyE1qz87699xacHCGcn0Hx75FhJiprrFqay3KcD/5+7OnKfjsZfJOpMysKBsANA7tDoMuVlpVPFgUbSY+dArCnkgXLz4ngJ4r2L9qcyE/VcByAELMqrFGIOy2S2~4469572~3684656; bm_sv=94350EAC7A4EC4FD3D1F5148AFB9CB90~YAAQZ/hWuChoyTGTAQAAKey8nRqMOE9qZcQ0r6NPb+wI4xF/+uYfbu6fOH30nV6B4WGv/6pR1FLFwLYZinI7n66ymeVSdf3Q0rJ99TRERb4ndjadOsNSv3AL0m9aQptN9WKiNS+AgPZVvepPUdhAk6l2e58fyFjCg+ZLcIz8Byv1C3Z3HfKbZHB9Y9NtCbLVxokmmNNKF4VXXw+frlpBFrYkEUZgzQF27Ow+E2LMdihs95nsrnIJjgtvGSEpm93UF1vJ~1';

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://www.nseindia.com/api/market-data-pre-open?key=ALL", // Target URL
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Bypass SSL verification (not recommended in production)
            CURLOPT_FOLLOWLOCATION => true,  // Follow redirects
            CURLOPT_HTTPHEADER => [
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
                "Accept: application/json, text/plain, */*",
                "Referer: https://www.nseindia.com", // Set Referer header
            ],
            CURLOPT_COOKIE => $cookie, // Optional: If NSE requires cookies for authentication
        ]);

        // Execute the request and get the response
        $response = curl_exec($curl);

        // Check for HTTP response code and errors
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl) || $httpCode !== 200) {
            echo "Error: " . curl_error($curl) . " | HTTP Code: " . $httpCode;
            curl_close($curl);
            exit;
        }

        // Close cURL session
        curl_close($curl);

        // Decode JSON response
        $data = json_decode($response, true);

        $finaldata[] = $data['data'];

        // filter the data from the response match with the symbol and isin from the database

        for ($i = 0; $i < count($combile); $i++) {
            for ($j = 0; $j < count($finaldata[0]); $j++) {
                // return $finaldata[0][$j]['metadata']['symbol'];
                if ($combile[$i]['symbol'] == $finaldata[0][$j]['metadata']['symbol']) {
                    $combile[$i]['trade'] = $finaldata[0][$j];
                }
            }
        }

        return $combile;
    }

    public static function fluctuateNumber($number, $percentage = 0.05) {
        // Generate a random number between -$range and $range
        // Calculate the fluctuation range as a percentage of the number
        $range = $number * ($percentage / 100);

        // Generate a random fluctuation within the calculated range
        $fluctuation = rand(-$range * 100, $range * 100) / 100; // Supports decimals

        return $number + $fluctuation;
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
