<?php 
    $ir_terms = get_field("ir_news");
?>

<div class="ir-news-container">

    <div class="s-grid -d2 -m1">
        <?php 
            $args = array(
                'post_type' => 'ir',
                'posts_per_page' => 2,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ir-type',
                        'field' => 'term_id',
                        'terms' => $ir_terms,
                    )
                ),
                'post_status' => 'publish'
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $file = get_field('file', get_the_ID());

                echo '<a class="ir-news-card" href="'. $file['url'] .'" target="_blank">';
                echo '<div class="entry-header">';
                echo get_the_date();
                echo '<span class="separator"> | </span>';
                $terms = get_the_terms(get_the_ID(), 'ir-type');
                $entry_cat = "";
                if( $terms ) { 
                    foreach( $terms as $term ) {
                        $entry_cat .= '<span class=" _heading">' . $term->name . '</span>';
                    }
                }   
                echo $entry_cat;
                echo '<h2 class="entry-title">';
                echo get_the_title();
                echo '</h2>';
                echo '</div>';
                if($file) { 
                    echo '<div class="entry-link">';
                    echo __("อ่านเพิ่มเติม", "wpml_theme");
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none"><path d="M18.4186 4.38574H0.38776C0.17328 4.38574 0 4.21246 0 3.99798C0 3.7835 0.17328 3.61022 0.38776 3.61022H17.4819L15.1287 1.25701C14.9772 1.10554 14.9772 0.859553 15.1287 0.708084C15.2802 0.556615 15.5261 0.556615 15.6776 0.708084L18.6937 3.72413C18.8051 3.83561 18.8379 4.00162 18.7773 4.14703C18.7167 4.29123 18.5749 4.38574 18.4186 4.38574Z" fill="currentColor"/><path d="M15.3992 7.40548C15.2998 7.40548 15.2004 7.36792 15.1253 7.29158C14.9739 7.14011 14.9739 6.89412 15.1253 6.74266L18.145 3.72298C18.2965 3.57151 18.5425 3.57151 18.6939 3.72298C18.8454 3.87445 18.8454 4.12043 18.6939 4.2719L15.6742 7.29158C15.5979 7.36792 15.4985 7.40548 15.3992 7.40548Z" fill="currentColor"/></svg>';
                    echo '</div>';
                }
               
                echo '</a>';
            }
            wp_reset_postdata();
        ?>
    </div>
</div>