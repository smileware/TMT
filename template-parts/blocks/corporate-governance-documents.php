<?php 
    $term_id = get_field("governance_term");
    $hide_filter = get_field("hide_filter");
    $post_per_page = get_field("post_per_page") ? get_field("post_per_page"): -1 ;
?>
<div class="document-header">
    <h3><?php echo $term_id->name; ?></h3>
    <?php if(!$hide_filter): ?>
    <div class="filter-container -multiple">
        <div>
            <label><?php _e("เลือกปี: ","wpml_theme"); ?></label>
            <?php echo facetwp_display('facet','year') ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="document-container">

    <div class="s-grid -d1 -m1 facetwp-template">
        <div class="document-table-header">
            <div class="dth dth-date">
                <label><?php _e("วันที่", "wpml_theme"); ?></label>
            </div>
            <div class="dth dth-title">
                <label><?php _e("หัวข้อ", "wpml_theme"); ?></label>
            </div>
            <div class="dth dth-action"></div>
        </div>
        <?php 
            $args = array(
                'post_type' => 'governance',
                'posts_per_page' => $post_per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'governance-type',
                        'field' => 'term_id',
                        'terms' => $term_id,
                    )
                ),
                'facetwp' => true,
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                get_template_part( 'template-parts/components/card', 'document' );
            }
            wp_reset_postdata();
        ?>
    </div>
    <?php if($post_per_page != -1): ?>
    <?php echo facetwp_display( 'facet', 'pagination' ); ?>
    <?php endif; ?>
</div>