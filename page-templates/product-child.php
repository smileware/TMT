<?php 
/**
 * Template Name: Product Child
 */
get_header(); ?>
<?php 
    $file = get_field("product_banner");
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => get_the_ID(),
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );
    $child_pages = new WP_Query($args);
?>

<div class="template-product-banner">
    <div class="banner-overlay"></div>
    <div class="banner-image">
        <?php if($file['type'] == 'video'): ?>
        <video muted="muted" playsinline="playsinline" autoplay loop id="myVideo">
            <source src="<?php echo $file['url']; ?>" type="video/mp4">
        </video>
        <?php else: ?>
            <img src="<?php echo $file['url']; ?>" alt="<?php echo get_the_title(). 'Banner'; ?>" />
        <?php endif; ?>
    </div>
    <div class="s-container">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        <h1 class="banner-title">
            <?php echo the_title(); ?>
        </h1>
    </div>
</div>

<div class="s-container main-body">

    <div id="primary" class="content-area">
        <main id="main" class="site-main -hide-title">
            <!-- Desktop -->
            <div class="_desktop main-product-desktop">
                <div class="child-title-container left">
                    <div>
                        <div class="page-template-label">
                            <?php _e("Products Categories", "wpml_theme"); ?>
                        </div>
                        <?php 
                            if ($child_pages->have_posts()) : 
                                while ($child_pages->have_posts()) : $child_pages->the_post();
                                    echo '<h3 class="child-title">' . get_the_title() . '</h3>';
                                endwhile;
                            endif;
                        ?>
                    </div>

                    <!-- Back to Parent -->
                    <?php 
                        $parent_id = wp_get_post_parent_id( get_the_ID() );
                        if($parent_id) { 
                            $grandparent_id = wp_get_post_parent_id( $parent_id );
                            $grandparent_permalink = get_permalink( $grandparent_id );
                            ?>
                                <a class="link-back" href="<?php echo $grandparent_permalink; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.95353 3.66112C9.1545 3.87012 9.14798 4.20247 8.93898 4.40344L6.18255 7L8.93898 9.59656C9.14799 9.79753 9.1545 10.1299 8.95354 10.3389C8.75257 10.5479 8.42022 10.5544 8.21122 10.3534L5.06122 7.37844C4.95827 7.27946 4.9001 7.14281 4.9001 7C4.9001 6.85719 4.95827 6.72055 5.06122 6.62156L8.21122 3.64656C8.42022 3.4456 8.75257 3.45211 8.95353 3.66112Z" fill="currentColor"/>
                                    </svg>
                                    <?php echo __("ย้อนกลับหน้าหลัก","wpml_theme"); ?>
                                </a>
                            <?php
                        }
                    ?>

                </div>
                <div class="child-content-container right">
                    <?php
                        if ($child_pages->have_posts()) : 
                            while ($child_pages->have_posts()) : $child_pages->the_post();
                                echo '<div class="child-content">';
                                the_content();
                                echo '</div>';
                            endwhile;
                        endif;
                    ?>
                </div>
            </div>
            <!-- Mobile -->

            <div class="_mobile main-product-mobile alignfull">
                <div class="page-template-label">
                    <?php _e("Products Categories", "wpml_theme"); ?>
                </div>
                <div class="accordion-container">
                    <?php 
                        if ($child_pages->have_posts()) : 
                            while ($child_pages->have_posts()) : $child_pages->the_post();
                                echo '<div class="accordion-trigger">';
                                echo '<h3 class="accordion-title">' . get_the_title() . '</h3>';
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>';
                                echo '</div>';

                                echo '<div class="accordion-content">';
                                the_content();
                                echo '</div>';
                            endwhile;
                        endif;
                    ?>
                </div>
                <!-- Back to Parent -->
                <?php 
                    $parent_id = wp_get_post_parent_id( get_the_ID() );
                    if($parent_id) { 
                        $grandparent_id = wp_get_post_parent_id( $parent_id );
                        $grandparent_permalink = get_permalink( $grandparent_id );
                        ?>
                            <a class="link-back" href="<?php echo $grandparent_permalink; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.95353 3.66112C9.1545 3.87012 9.14798 4.20247 8.93898 4.40344L6.18255 7L8.93898 9.59656C9.14799 9.79753 9.1545 10.1299 8.95354 10.3389C8.75257 10.5479 8.42022 10.5544 8.21122 10.3534L5.06122 7.37844C4.95827 7.27946 4.9001 7.14281 4.9001 7C4.9001 6.85719 4.95827 6.72055 5.06122 6.62156L8.21122 3.64656C8.42022 3.4456 8.75257 3.45211 8.95353 3.66112Z" fill="currentColor"/>
                                </svg>
                                <?php echo __("ย้อนกลับหน้าหลัก","wpml_theme"); ?>
                            </a>
                        <?php
                    }
                ?>
            </div>
        </main>
    </div>
</div>

<!-- TODO: Add related product with animation -->
<footer class="entry-footer">
    <?php seed_entry_footer(); ?>
</footer>

<script>
    const titles = document.querySelectorAll('.main-product-desktop .child-title');
    const containers = document.querySelectorAll('.main-product-desktop .child-content');
    let activeIndex = -1; 

    titles.forEach((item, index) => {
        item.addEventListener('mouseenter', function() {
            titles.forEach(it => it.classList.remove('active'));
            containers.forEach(img => img.classList.remove('active'));

            item.classList.add('active');
            if(containers[index]) {
                containers[index].classList.add('active');
            }
            activeIndex = index;
        });
    });
    if (titles.length > 0 && containers.length > 0) {
        titles[0].classList.add('active');
        containers[0].classList.add('active');
        activeIndex = 0;
    }



    // Accordion
    const acc = document.querySelectorAll('.main-product-mobile .accordion-trigger');
    acc.forEach((item) => {
        item.addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            panel.classList.toggle("active");
            panel.style.maxHeight = panel.style.maxHeight ? null : panel.scrollHeight + "px";
        });
    });
</script>

<?php get_footer(); ?>