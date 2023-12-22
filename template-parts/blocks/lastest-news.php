<?php 
    $news = get_page_by_title('News &amp; Activities');
    $cats = get_categories( array(
        'hide_empty' => 1,
    ));
?>
<div class="s-container latest-news">
    <div class="tab-container">
        <div class="tab-item-container">
            <div class="tab-item active" data-cat="all">
                <?php _e("ทั้งหมด", "wpml_theme"); ?>
            </div>
            <?php 
                foreach ($cats as $cat) { 
                    echo '<div class="tab-item "data-cat="'. $cat->term_id.'">';
                    echo $cat->name;
                    echo '</div>';
                }
            ?>
        </div>
        <div class="_desktop">
            <a class="btn-link" href="<?php echo get_permalink($news); ?>">
                <?php _e("ดูทั้งหมด", "wpml_theme"); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none">
                    <path d="M18.4186 4.38574H0.38776C0.17328 4.38574 0 4.21246 0 3.99798C0 3.7835 0.17328 3.61022 0.38776 3.61022H17.4819L15.1287 1.25701C14.9772 1.10554 14.9772 0.859553 15.1287 0.708084C15.2802 0.556615 15.5261 0.556615 15.6776 0.708084L18.6937 3.72413C18.8051 3.83561 18.8379 4.00162 18.7773 4.14703C18.7167 4.29123 18.5749 4.38574 18.4186 4.38574Z" fill="#FA744B"/>
                    <path d="M15.3989 7.40548C15.2996 7.40548 15.2002 7.36792 15.1251 7.29158C14.9736 7.14011 14.9736 6.89412 15.1251 6.74266L18.1448 3.72298C18.2962 3.57151 18.5422 3.57151 18.6937 3.72298C18.8451 3.87445 18.8451 4.12043 18.6937 4.2719L15.674 7.29158C15.5977 7.36792 15.4983 7.40548 15.3989 7.40548Z" fill="#FA744B"/>
                </svg>
            </a>
        </div>
    </div>
    <!-- Desktop -->
    <div class="tab-content-container _desktop">
        <div class="s-grid -d3" id="grid-all">
            <?php 
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                );
                $the_query = new WP_Query( $args );
			?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php get_template_part( 'template-parts/components/card', 'default' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php 
            foreach ($cats as $cat) { 
                ?>
                    <div class="s-grid -d3" id="grid-<?php echo $cat->term_id; ?>">
                        <?php 
                            $args = array(
                                'cat' => $cat->term_id,
                                'post_type' => 'post',
                                'posts_per_page' => 3,
                                'post_status' => 'publish'
                            );
                            $the_query = new WP_Query( $args );
                        ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php get_template_part( 'template-parts/components/card', 'default' ); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                <?php
            }
        ?>
    </div>
    <!-- Mobile -->
    <div class="tab-content-container _mobile">
        <div class="s-slider -m1.2" data-slider="slider-all">
            <?php 
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                );
                $the_query = new WP_Query( $args );
			?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="slider">
                <?php get_template_part( 'template-parts/components/card', 'default' ); ?>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php 
            foreach ($cats as $cat) { 
                ?>
                    <div class="s-slider -m1.2" data-slider="slider-<?php echo $cat->term_id; ?>">
                        <?php 
                            $args = array(
                                'cat' => $cat->term_id,
                                'post_type' => 'post',
                                'posts_per_page' => 3,
                                'post_status' => 'publish'
                            );
                            $the_query = new WP_Query( $args );
                        ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="slider">
                            <?php get_template_part( 'template-parts/components/card', 'default' ); ?>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                <?php
            }
        ?>
    </div>
    <div class="_mobile footer-link">
        <a class="btn-link" href="<?php echo get_permalink($news); ?>">
            <?php _e("ดูทั้งหมด", "wpml_theme"); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none">
                <path d="M18.4186 4.38574H0.38776C0.17328 4.38574 0 4.21246 0 3.99798C0 3.7835 0.17328 3.61022 0.38776 3.61022H17.4819L15.1287 1.25701C14.9772 1.10554 14.9772 0.859553 15.1287 0.708084C15.2802 0.556615 15.5261 0.556615 15.6776 0.708084L18.6937 3.72413C18.8051 3.83561 18.8379 4.00162 18.7773 4.14703C18.7167 4.29123 18.5749 4.38574 18.4186 4.38574Z" fill="#FA744B"/>
                <path d="M15.3989 7.40548C15.2996 7.40548 15.2002 7.36792 15.1251 7.29158C14.9736 7.14011 14.9736 6.89412 15.1251 6.74266L18.1448 3.72298C18.2962 3.57151 18.5422 3.57151 18.6937 3.72298C18.8451 3.87445 18.8451 4.12043 18.6937 4.2719L15.674 7.29158C15.5977 7.36792 15.4983 7.40548 15.3989 7.40548Z" fill="#FA744B"/>
            </svg>
        </a>
    </div>
</div>


