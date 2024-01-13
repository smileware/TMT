
<?php 
/**
 * Template Name: Webcast and Activities
 */
get_header(); ?>

<?php seed_banner_title(get_the_ID()); ?>

<div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout']; ?>">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php if ( have_posts() ) : ?>
                <div class="document-header">
                    <h3>
                        <?php _e("เว็บแคสต์และกิจกรรมสำหรับนักลงทุน", "wpml_theme");?>
                    </h3>
                    <div class="filter-container">
                        <label><?php _e("เลือกปี: ","wpml_theme"); ?></label>
                        <?php echo facetwp_display('facet','year') ?>
                    </div>
                </div>

                <div class="webcast-container">
                    <div class="s-grid -d3 -m1 -t2 facetwp-template">
                        <?php 
                            $args = array(
                                'post_type' => 'webcast-and-activity',
                                'posts_per_page' => 9,
                                'facetwp' => true,
                            );
                            $the_query = new WP_Query( $args );
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                get_template_part( 'template-parts/components/card', 'webcast' );
                            }
                            wp_reset_postdata();
                        ?>
                    </div>
                    <?php echo facetwp_display( 'facet', 'pagination' ); ?>
                </div>

            <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>

        </main>
    </div>
</div>
<footer class="entry-footer">
    <?php seed_entry_footer(); ?>
</footer>
<?php get_footer(); ?>