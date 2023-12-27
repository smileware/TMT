<?php 
    $term_id = get_field("sustainability_document_cover_term");
?>
<div class="document-header">
    <h3><?php echo $term_id->name; ?></h3>
    <div class="filter-container">
        <label><?php _e("เลือกปี: ","wpml_theme"); ?></label>
        <?php echo facetwp_display('facet','year') ?>
    </div>
</div>

<div class="document-container-cover">
    <div class="s-grid -d3 -m1 facetwp-template">
        <?php 
            $args = array(
                'post_type' => 'sustainability',
                'posts_per_page' => 6,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'sustainability-type',
                        'field' => 'term_id',
                        'terms' => $term_id,
                    )
                ),
                'facetwp' => true,
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                get_template_part( 'template-parts/components/card', 'document-cover' );
            }
            wp_reset_postdata();
        ?>
    </div>
    <?php echo facetwp_display( 'facet', 'pagination' ); ?>
</div>