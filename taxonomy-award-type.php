<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package seed
 */
get_header(); ?>

<?php $bg = get_field('taxonomy_banner_image',  get_term(get_queried_object_id()));?>
<div class="taxonomy-banner">
    <div class="bg" style="background-image: url('<?php echo $bg; ?>');"></div>
    <div class="s-container">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        <h1 class="taxonomy-title">
            <?php _e("รางวัลและความภาคภูมิใจ", "wpml_theme"); ?>
        </h1>
    </div>
</div>

<div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout']; ?>">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php if ( have_posts() ) : ?>
                <?php 
                    echo '<div class="s-grid -d3 -m1">';
                    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'award',
                        'posts_per_page' => 10,
                        'paged' => $paged,
                        'post_status' => 'publish'
                    );
                    $the_query = new WP_Query( $args );
                    $count = 1;
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        if($count == 1) { 
                            get_template_part( 'template-parts/components/card', 'default-lg' );
                        }else { 
                            get_template_part( 'template-parts/components/card', 'default' );
                        }
                        $count+=1;
                    endwhile; 

                    echo '</div>';
                    echo seed_posts_navigation( $the_query ); 
                    wp_reset_postdata();
                ?>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>