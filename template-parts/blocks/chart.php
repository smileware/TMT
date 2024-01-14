<?php 
    $unique_id = 'chart_'.uniqid();
    $chart_name = get_field("chart_name");
    $chart_unit = get_field("chart_unit");
    $chart_legend = get_field("chart_legend");
    $chart_file = get_field("chart_upload_csv_data");

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


<div class="chart-container">
    <div class="chart-header">
        <h4 class="chart-name"><?php echo $chart_name; ?></h4>
        <div class="chart-unit"><?php echo $chart_unit; ?></div>
    </div>
    <div class="chart-wrapper">
        <canvas id="<?php echo $unique_id; ?>" height="400" id="chart-financial"></canvas>
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

        const rawData = <?php echo json_encode($dataArray); ?>;
        const barData = rawData[0].map((_, colIndex) => {
            return {
                value: parseInt(rawData[1][colIndex].replace(/,/g, '')),
                trend: parseInt(rawData[2][colIndex])
            };
        });
        const yearLabel = rawData[0];
        
        createChart('<?php echo $unique_id; ?>', barData, yearLabel);
    });
    
</script>