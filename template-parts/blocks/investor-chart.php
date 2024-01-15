<?php 
    $unique_id = 'chart_'.uniqid();
    $chart_legend = get_field("investor_chart_legend");
    $chart_file = get_field("investor_chart_upload_csv_data");

    if($chart_file) { 
        $filename = $chart_file; // Update the path to your CSV file
        $dataArray = array();

        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($data != ''){
                    $dataArray[] = $data;
                }
            }
            fclose($handle);
        }
    }
?>


<div class="chart-container -investor">
    <div class="chart-wrapper">
        <canvas id="investor_chart" height="400"></canvas>
    </div>
    <div class="chart-legend">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="10" viewBox="0 0 17 10" fill="none">
            <line y1="4.3335" x2="16.6667" y2="4.3335" stroke="#828282" stroke-width="2" stroke-dasharray="4 4"/>
            <circle cx="8.33203" cy="5" r="5" fill="#FA744B"/>
        </svg>
        <span><?php echo $chart_legend; ?></span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        var barWidth;
        if (window.innerWidth < 600) { 
            barWidth = 35;
        }else { 
            barWidth = 65;
        }

        const rawData = <?php echo json_encode($dataArray); ?>;
        const barData = rawData[0].map((_, colIndex) => {
            return {
                value: parseInt(rawData[1][colIndex].replace(/,/g, '')),
                trend: parseInt(rawData[2][colIndex])
            };
        });
        const yearLabel = rawData[0];
        
        const ctx = document.getElementById('investor_chart').getContext('2d');
        const maxValue = Math.max(...barData.map(d => d.value));
        const pixelToValueRatio = maxValue / ctx.canvas.height;
        const offsetInPixels = 130;
        const offsetValue = pixelToValueRatio * offsetInPixels;

        const trendDataset = {
            type: 'line',
            label: 'Trend',
            data: barData.map(d => ({ x: barData.indexOf(d), y: d.value + offsetValue })),
            borderColor: '#BDBDBD',
            borderDash: [2, 1],
            borderWidth: 1,
            pointBorderColor: '#FF5722',
            pointBackgroundColor: '#FF5722',
            pointRadius: 5,
            backgroundColor: 'transparent',
            fill: false,
            tension: 0,
            datalabels: {
                display: true,
                color: '#FF5722',
                formatter: function(value, context) {
                    return barData[context.dataIndex].trend + '%';
                },
                align: 'top',
                offset: 10
            }
        };

        const barDataset = {
            type: 'bar',
            label: 'Values',
            data: barData.map(d => d.value),
            backgroundColor: function(context) {
                const index = context.dataIndex;
                const count = context.dataset.data.length;
                return index === count - 1 ? '#003955' : '#E0E0E0';
            },
            barThickness: barWidth,
            datalabels: {
                display: true,
                color: '#000',
                anchor: 'end',
                align: 'top',
                font: {
                    size: 12,
                    weight: 500
                },
                offset: 10,
                formatter: function(value, context) {
                    return value.toLocaleString(); // Display numeric value
                }
            }
        };

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'category',
                    grid: {
                        display: false
                    }
                },
                y: {
                    display: false
                },
            },
            plugins: {
                tooltip: {
                    enabled: false
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top'
                },
                legend: {
                    display: false
                },
            },
            layout: {
                padding: {
                    top: 50,  
                }
            }
        };

        const chartData = {
            labels: yearLabel,
            datasets: [barDataset, trendDataset]
        };

        Chart.register(ChartDataLabels);
        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });
    });
    
</script>