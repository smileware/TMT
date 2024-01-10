<?php 
    $term_id = get_field("ir_cover_term");
?>

<div class="document-container-cover">
    <div class="s-grid -d3 -m1">
        <?php 
            $args = array(
                'post_type' => 'ir',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ir-type',
                        'field' => 'term_id',
                        'terms' => $term_id,
                    )
                ),
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                get_template_part( 'template-parts/components/card', 'document-cover' );
            }
            wp_reset_postdata();
        ?>
    </div>
</div>