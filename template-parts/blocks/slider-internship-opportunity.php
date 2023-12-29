<?php 
    $sliders = get_field("slider_internship_opportunity");
?>
<?php if($sliders): ?>
    <div class="s-slider -d4 -m1.3 internship-silder slider-custom-nav">
    <?php 
        foreach($sliders as $slide) { 
            $icon = $slide['opportunity_icon'];
            $text = $slide['opportunity'];

            echo '<div class="slider">';
            echo '<div class="internship-item">';
            echo  $icon;
            echo '<h4>'. $text .'</h4>';
            echo '</div>';
            echo '</div>';
        }    
    ?>
    </div>
<?php endif; ?>