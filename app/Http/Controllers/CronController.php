<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equity;


class CronController extends Controller
{
    public function fetequities(){
        // take cookies from browser and set it here



        // fetch stocks from equities table 
        $stocks = Equity::all();
        $cookie = '_ga=GA1.1.1463179861.1733387592; bm_mi=96A1CEA74EBAEEDD6EAAA2D4383C2F39~YAAQX/hWuPIb8quTAQAAlwrcvBq6Ltvhmf2jvUa0ko5kUbsKBUwZMdheuOCaqiG0WSMZ4hze0TWCpexdb8bIg2J3cjTwYTykggS74EOnkj9XQMq7ysf5BILE14Ua1hfcz7a4FP+4i245qbQqNu05NuFfD3ZjyKU5Bol8yS5DBTk25Bj9DczX2XwiQOOF7SRoNDUQqrOt6ifNCyjq3SHssTRR7rj+g1FKAIrqt/Mr72G2YkhtILVql2hf+wMHQP2JzA5TisNZ3tRHnRSBWM8ZXbPmUxqq3TRUYiVFgg0mB8+EdO164NwsiCNX42oLL5reiVfBEUZGQwjzqKX+jUJCOg==~1; defaultLang=en; ak_bmsc=8EF11847FAC13F05DF000C2561490760~000000000000000000000000000000~YAAQX/hWuE8e8quTAQAAHe/dvBoG6jDOropf4l1TZxQk0FucD8emP6C454uxxi0ipQi8PynJ+hE/y5TNmlpYzeAbqDKnLnSw4NqgwBMjmhizYIntiy4wJGdX3/Zi/GHy7qAYFn3UPz4/+a/xkiMDKdsGyfvT6qDPLELIZbxADz1TeAoAmpTXQdYZ6WpBv9TdNSR7gHZm73ecmTH8Pbm84ojxVl825Tf8nUL4HVW6r0O/5CJqWcowo8f9efEfpFbwy9uBlWVMbfy3wE5ZNl/X9oO1dKI/ZJygFGWofi8sL0FL6Xy6nnM1YGTmUBjyfGSYq9CYbPyyePezajNYFgfNNTn2fZY1cEsqIGH8rpI/dsJuFssG/wxaFa/OOdpmxBEmjnns/bckZ96ak7QaBF093eSXVjRWUbg1LssMRN7tMLGJb21bOWhbPmzbFq2wbgKVJzGBjIrr1F+/kcU5aAZRfr0CwuIt2r9MHNUPzKSmOBCx0GvhIsDwdniaDzUhTjwVrq/iUsSOUeRzny/7vek+eukzVg==; nseQuoteSymbols=[{"symbol":"AXISBANK","identifier":"","type":"equity"},{"symbol":"HDFCBANK","identifier":"","type":"equity"},{"symbol":"HDFCLIFE","identifier":"","type":"equity"}]; _ga_87M7PJ3R97=GS1.1.1734042999.13.1.1734043000.59.0.0; _ga_WM2NSQKJEK=GS1.1.1734042999.13.1.1734043000.0.0.0; RT="z=1&dm=nseindia.com&si=da828c54-14e2-4a9c-81a1-a2a3184f29f4&ss=m4lv1xxy&sl=1&se=8c&tt=1r0&bcn=%2F%2F684d0d44.akstat.io%2F&ld=1dlrk"; bm_sz=CAE115E2FC24F9D0A39AC8E3B9A600B0~YAAQNK3OF62juLSTAQAAamgGvRoRt92J7EpjX+F6iHmNBuXjHcATadH010W86lDa1SJxP5RVXwvnFcm52G2DEjEs3gjPXQUAxiEQOixlSbcW4yDvQl9q+iLW60n2U0mdu3VChtcduDqNtf49zLT53rvkspHagraI+bMFjlUHg5vWPhbZ2zBy2ouOCrXtBuvYmJYifV8PFyRyqsUpnqZam1tXeORFpazBLGDX10hwKDlvqwItN9pMD5a0yMSdbRBJ17V4udpD6wq3WBuOr8YgRX8bDZ358nThe/N63EpXaNqBvDYKMab5daUrbTeokTsWqxKFr3fUfR659pKe8n5tlxq4kRQ6dw0pHyMO9mQV2TxG8wpq253tIGBLsaN9VOtgyvJ1GDa1V7KfHJq9uLgs5iElmE7dg7hVTm2Osx5v07q4GAl4L1+y7UoquadXHMCvN/pXNfWVyec=~3556164~3617349; _abck=E65FDA2290AD6615EB1C42885DC2D002~0~YAAQNK3OF8OjuLSTAQAA4nwGvQ39ch0u0wnitjccxB4x31IP9V1V7gE8V9blzULhUGWXiqV3lQQBM78JlshHPoSwlk0GPD/Uwos+lQ+h4Hr6hvAFCevFtDeUIx+3ObND542NZR2g9aqgMUYy08H7S8st6bD2RXNDmiKOMZ0Cemq5mxUsmWRRze7NabsAmv6Nu9Q0cQnJ9tb/MjWzSxG+JKFP7s1Gbd6ghlqga1AoKzDYSGG06wKVoeQWUOWK5ZMpD2fTOyXH74RyMY9NZlg5Ak96TEo63yH7R4H/EBF6zgaKJRs6mP7jiQ8KaRx8MWiNb8DCjizAXiqlg7K0+UZqT81Ixou1W/osMlMpLEoLTM2+j9X3VtdmJYSKxg5GJCcJZJIPrX9Q9OiJw+Inoo7Gt9Axi9l9jy62nIZItv34cjZEM+uk5biJ/MAoMS5P0gm0pHtoFv/dVME=~-1~-1~-1; bm_sv=3798D0D3B50D78B9C68FC2C45BA429A5~YAAQNK3OF8SjuLSTAQAA4nwGvRqdiQSF/CoO3ZFyl7eploVGqSii6O440IT3HzM6Mgb+clM6h/uxcvJFGpU4coUrbKvItW/EhIFWMkwecScxK90UkMMqGbg+QoJheA3L0OgOclvN+U/1qmrL96hinzy2hnm3iaoQUuBgmqj4Fw+bKur0ChS2RZYmbZ6tspMSg2YPmWTDG+5iNwujAckVwN50aOG8RXJK0su0Pza8FyUfooAYLj4S1s+xRvOmF1bY5jEVng==~1';
        
        foreach($stocks as $stock){
            $symbol = $stock->symbol;
            // api_url = https://www.nseindia.com/api/quote-equity?symbol=HDFCLIFE
            $api_url = "https://www.nseindia.com/api/quote-equity?symbol=".$symbol;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
                "Accept: application/json, text/plain, */*",
                "Referer: https://www.nseindia.com",
            ]);
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);





            $result = curl_exec($ch);

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch) || $httpCode !== 200) {
            echo "Error: " . curl_error($ch) . " | HTTP Code: " . $httpCode;
            curl_close($ch);
            exit;
        }else{
            $data = json_decode($result,true);
            echo "<pre>";
            print_r($data['priceInfo']);
            exit;
        }
            curl_close($ch);
            

        }
    }
}
