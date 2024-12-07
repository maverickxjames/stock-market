
<?php
use App\Models\Stockdata;

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradingView Chart with Data</title>
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #chart { width: 100%; height: 400px; }
        #symbol-name { text-align: center; font-size: 24px; margin-top: 10px; }
        .price-info {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .toolbar {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            justify-content: center;
        }
        .button { 
            padding: 5px 10px; 
            border: 1px solid #ccc; 
            cursor: pointer; 
            background-color: #f7f7f7;
            font-size: 14px;
        }
        .button.active {
            background-color: #d1e7ff;
        }
    </style>
</head>
<body>
   
     <?php
        $data = Stockdata::where('isin', $id)->get();
        foreach ($data as $datas) {
           $stockname = $datas->shortName;


        }
        ?>
    

    <h2 id="symbol-name">{{ $stockname }}</h2>
    <div class="toolbar">
        <div class="button" onclick="setTimeFrame('1m')">1 Min</div>
        <div class="button" onclick="setTimeFrame('1h')">1 Hour</div>
        <div class="button" onclick="setTimeFrame('1d')">1 Day</div>
    </div>
    <div id="chart"></div>

    <script>
        // Initialize the chart
        const chartContainer = document.getElementById("chart");
        const chart = LightweightCharts.createChart(chartContainer, {
            layout: {
                backgroundColor: "#ffffff",
                textColor: "#333",
            },
            grid: {
                vertLines: { color: "#e1e1e1" },
                horzLines: { color: "#e1e1e1" },
            },
            priceScale: { borderColor: "#cccccc" },
            timeScale: { borderColor: "#cccccc" },
        });

        // Add a candlestick series to the chart
        const candleSeries = chart.addCandlestickSeries({
            upColor: "#4caf50",
            downColor: "#f44336",
            borderUpColor: "#4caf50",
            borderDownColor: "#f44336",
            wickUpColor: "#4caf50",
            wickDownColor: "#f44336",
        });

        chart.applyOptions({
            layout: {
                title: 'Nifty 50 Index',
                titleColor: '#000',
            },
        });

        // Validate and format the data properly
        function formatData(data) {
            return data.map(([timestamp, open, high, low, close]) => ({
                time: Math.floor(timestamp / 1000), // Convert to seconds since epoch
                open,
                high,
                low,
                close,
            }));
        }

    

        // Fetch data from the PHP backend (proxy.php or similar)
        async function fetchData() {
            try {
                const response = await fetch("/fetch-stock-data/<?=$id?>");

                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }

                const rawData = await response.json();
                console.log(rawData);

                const formattedData = formatData(rawData);
                console.log(formattedData);

                if (formattedData.length === 0) {
                    throw new Error("No valid data available");
                }

                candleSeries.setData(formattedData); // Set data to the chart
            } catch (error) {
                console.error("Error fetching or setting data:", error);

                // Fallback hardcoded data
                const hardCodedData = formatData([
                    [1696155600000, 25788.45, 25907.6, 25788.05, 25861.3], // Example data
                    [1696155660000, 25861.3, 25873, 25822.35, 25824.05],
                    [1696155720000, 25824.6, 25831.8, 25743.45, 25759.35],
                ]);

                candleSeries.setData(hardCodedData); // Fallback data
            }
        }

        // Call the fetchData function
        fetchData();
    </script>
</body>
</html>

