<?php 
    $carousel = get_field("career_carousel");
?>
<div class="s-slider -d3 -m1 career-carousel">
    <?php 
        foreach( $carousel as $item ) { 
            $name = $item['name'];
            $description = $item['description'];
            $img_url = $item['image'];
            echo '<div class="slider">';
            echo '<div class="career-item">';
            echo '<div class="header">';
            echo '<h3>'. $name .'</h3>';
            echo '<div class="description">'. $description .'</div>';
            echo '</div>';
            echo '<img src="'. $img_url .'" alt="'. $name .'" />';
            echo '</div>';
            echo '</div>';
        }
    ?>
</div>