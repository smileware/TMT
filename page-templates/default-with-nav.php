<?php 
/**
 * Template Name: Default with Navigation Bar
 */
get_header(); ?>

<?php seed_banner_title(get_the_ID()); ?>

<div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout']; ?>">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php 
                $navs = get_field("navs", get_the_id());
                if($navs) { 
                    // Desktop
                    echo '<div class="template-navigation-desktop _desktop">';
                    foreach($navs as $nav)  {
                        $link = $nav['nav_item'];
                        $title = $nav['nav_title'];
                        $is_active = $nav['is_active'] ? "active" : "";
                        echo '<a href="'. $link .'" class="nav-item '. $is_active .'">';
                        echo $title;
                        echo '</a>';
                    }
                    echo '</div>';
                    // Mobile
                    echo '<div class="template-navigation-mobile _mobile">';
                    foreach($navs as $nav)  {
                        $link = $nav['nav_item'];
                        $title = $nav['nav_title'];
                        $is_active = $nav['is_active'] ? "active" : "";
                        if($is_active) {
                            echo '<button class="dropbtn '. $is_active .'">';
                            echo $title;
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                          </svg>';
                            echo '</button>';
                        }
                    }
                    echo '<div class="dropdown-content">';
                    foreach($navs as $nav)  {
                        $link = $nav['nav_item'];
                        $title = $nav['nav_title'];
                        echo '<a href="'. $link .'" class="nav-item">';
                        echo $title;
                        echo '</a>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            ?>            
            <?php if ( have_posts() ) : ?>
            
            <?php the_content(); ?>
            
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