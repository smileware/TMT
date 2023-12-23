
<?php 
    $history = get_field('history');
?>
<div class="s-container history">
    <div class="timeline-line">
        <div class="progress"></div>
    </div>
    <?php 
        $count = 1; 
        foreach($history as $item) { 
    ?>
        <div class="s-grid -d2 section" >
            <div class="dot">
                <div class="inner-dot"></div>
            </div>
            <?php 
                $milestone = $item['milestone'];
                $image = $item['milestone_image'];
                $details = $item['milestone_details'];
            ?>
            <?php if($count % 2 == 0): ?>
                <div class="history-detail">
                    <img src="<?php echo $image; ?>" width="100%" />
                    <div class="history-pinpoint">
                        <?php 
                            foreach($details as $detail) { 
                                $year = $detail['milestone_year'];
                                $description = $detail['milestone_description'];
                                echo '<div>';
                                if($year) { 
                                    echo '<div class="year">'. $year .'</div>';
                                }
                                if($description) { 
                                    echo '<div class="description">'. $description .'</div>';
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="history-milestone">
                    <h3><?php echo $milestone; ?></h3>
                </div>
            <?php else: ?>
                <div class="history-milestone">
                    <h3><?php echo $milestone; ?></h3>
                </div>
                <div class="history-detail">
                    <img src="<?php echo $image; ?>" width="100%" />
                    <div class="history-pinpoint">
                        <?php 
                            foreach($details as $detail) { 
                                $year = $detail['milestone_year'];
                                $description = $detail['milestone_description'];

                                echo '<div>';
                                if($year) { 
                                    echo '<div class="year">'. $year .'</div>';
                                }
                                if($description) { 
                                    echo '<div class="description">'. $description .'</div>';
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php $count += 1; } ?>
</div>