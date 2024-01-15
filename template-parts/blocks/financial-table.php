<?php 
    $file = get_field("financial_table_file");

    if($file) { 
        $filename = $file; // Update the path to your CSV file
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

<div class="financial-table-container">
    <table class="financial-table">
        <?php 
            $idx = 0; 
            foreach($dataArray as $data) {
                // Count non-empty cells in the row
                $nonEmptyCells = count(array_filter($data, function($value) { return $value !== ''; }));

                // A row is considered merged if it has 1 or 0 non-empty cells
                $isMergedRow = $nonEmptyCells <= 1;

                if($idx == 0){
                    echo '<thead>';
                    echo '<tr>';
                    foreach($data as $row) { 
                        echo '<td>';
                        echo $row;
                        echo '</td>';
                    }
                    echo '</tr>';
                    echo '</thead>';
                }else { 
                    if( $idx == 1 ) {
                        echo '<tbody>';
                    }

                    // Add the 'merged' class if it's a merged row
                    echo $isMergedRow ? '<tr class="merged">' : '<tr>';
                    foreach($data as $row) { 
                        echo '<td>';
                        echo $row;
                        echo '</td>';
                    }
                    echo '</tr>';

                    if ($idx == count($dataArray) - 1){ 
                        echo '</tbody>';
                    }
                }
                $idx += 1;
            }
        ?>
    </table>
</div>
