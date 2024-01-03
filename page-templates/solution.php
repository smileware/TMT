<?php 
/**
 * Template Name: Solution
 */
get_header(); ?>
<?php 
    $file = get_field("solution_banner");
    $tabs = get_field("solution_nav_tabs");
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => get_the_ID(),
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );
    $child_pages = new WP_Query($args);
?>

<div class="template-solution-banner">
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
            <div class="_desktop main-solution-desktop">
                <div class="child-title-container left">
                    <div class="tabs-link">
                        <?php 
                            if($tabs){ 
                                foreach ($tabs as $tab) {
                                    $link_url = $tab['tab_link']['url'];
                                    $link_title = $tab['tab_link']['title'];
                                    $active = $tab['is_active'] ? 'active' : '';
                                    echo '<a class="tab-link-item '. $active .'" href="'. $link_url .'">';
                                    echo $link_title;
                                    echo '</a>';
                                }
                            }
                        ?>
                    </div>
                    <div class="page-template-title">
                        <h2>
                            <?php the_title(); ?>
                        </h2>
                    </div>
                    <?php 
                        if ($child_pages->have_posts()) : 
                            while ($child_pages->have_posts()) : $child_pages->the_post();
                                echo '<h3 class="child-title">' . get_the_title() . '</h3>';
                            endwhile;
                        endif;
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

            <div class="tabs-link _mobile">
                <?php 
                    if($tabs){ 
                        foreach ($tabs as $tab) {
                            $link_url = $tab['tab_link']['url'];
                            $link_title = $tab['tab_link']['title'];
                            $active = $tab['is_active'] ? 'active' : '';
                            echo '<a class="tab-link-item '. $active .'" href="'. $link_url .'">';
                            echo $link_title;
                            echo '</a>';
                        }
                    }
                ?>
            </div>
            <div class="_mobile main-solution-mobile alignfull">
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
            </div>
        </main>
    </div>
</div>


<script>
    const titles = document.querySelectorAll('.main-solution-desktop .child-title');
    const containers = document.querySelectorAll('.main-solution-desktop .child-content');
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
    const acc = document.querySelectorAll('.main-solution-mobile .accordion-trigger');
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