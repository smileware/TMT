
<div class="webcast-highlight s-slider -d1 -m1">
    <?php 
        $args = array(
            'post_type' => 'webcast-and-activity',
            'posts_per_page' => 6,
            'post_status' => 'publish'
        );
        $the_query = new WP_Query( $args );
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            echo '<div class="slider">';
            echo '<a href="'. get_the_permalink() .'" class="webcast-highlight-card">';
            echo '<h3>'. get_the_title() .'</h3>';
            echo '<div class="entry-link">';
            echo __("รายละเอียด", "wpml_theme");
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none"><path d="M18.4186 4.38577H0.38776C0.17328 4.38577 0 4.21249 0 3.99801C0 3.78353 0.17328 3.61025 0.38776 3.61025H17.4819L15.1287 1.25704C14.9772 1.10557 14.9772 0.859583 15.1287 0.708114C15.2802 0.556646 15.5261 0.556646 15.6776 0.708114L18.6937 3.72416C18.8051 3.83564 18.8379 4.00165 18.7773 4.14706C18.7167 4.29126 18.5749 4.38577 18.4186 4.38577Z" fill="currentColor"/><path d="M15.3992 7.40551C15.2998 7.40551 15.2004 7.36795 15.1253 7.29161C14.9739 7.14014 14.9739 6.89415 15.1253 6.74269L18.145 3.72301C18.2965 3.57154 18.5425 3.57154 18.6939 3.72301C18.8454 3.87448 18.8454 4.12046 18.6939 4.27193L15.6742 7.29161C15.5979 7.36795 15.4985 7.40551 15.3992 7.40551Z" fill="currentColor"/></svg>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        wp_reset_postdata();
    ?>
</div>