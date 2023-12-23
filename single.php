<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package seed
 */

get_header(); ?>

<?php 
	$singleclass ='';
	if ($GLOBALS['s_blog_layout_single'] == 'full-width') {
		$singleclass = 'single-area';
	} 
?>
<?php while ( have_posts() ) : the_post(); ?>

<div class="site-single <?php echo($singleclass);?>">

   <div class="s-container breadcrumb-container">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>

    <div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout_single']; ?>">
        <div id="primary" class="content-area">
            <main id="main" class="site-main ">
                <?php 
					get_template_part( 'template-parts/content-single', get_post_type() ); 
				?>
                <?php wp_reset_postdata(); ?>
            </main>
        </div>

        <?php 
		switch ($GLOBALS['s_blog_layout_single']) {
			case 'rightbar':
				get_sidebar('right'); 
				break;
			case 'leftbar':
				get_sidebar('left'); 
				break;
			case 'full-width':
				break;
			default:
				break;
		}
		?>
    </div>

</div>

<?php endwhile; ?>
<?php get_footer(); ?>