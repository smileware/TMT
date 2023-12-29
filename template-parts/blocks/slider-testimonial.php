<?php 
    $sliders = get_field("slider_testimonial");
?>
<?php if($sliders): ?>
    <div class="s-slider -d3 -m1 testimonial-silder">
    <?php 
        foreach($sliders as $slide) { 
            $quote = $slide['quote'];
            $name = $slide['name'];
            $title = $slide['title'];
            $image = $slide['image'];
            echo '<div class="slider">';
            echo '<div class="testimonial-item">';
            echo '<div class="testimonial-body">';
            echo '<div class="quote -open">"</div>';
            echo $quote; 
            echo '<div class="quote -close">&#8221;</div>';
            echo '</div>';
            echo '<div class="testimonial-footer">';
            echo '<img src="'. $image .'" alt="Image of Khun '. $name .'" />';
            echo '<div class="info">';
            echo '<h4>'. $name .'</h4>';
            echo '<span>'. $title .'</span>';
            echo '</div>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
        }    
    ?>
    </div>
<?php endif; ?>