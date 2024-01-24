<?php 
/**
 * Template Name: Careers
 */
get_header(); ?>

<?php seed_banner_title(get_the_ID()); ?>

<div class="s-container main-body">

    <div id="primary" class="content-area">
        <main id="main" class="site-main -hide-title">
            <?php 
                $jobs_types = get_terms(
                    array(
                        'taxonomy'   => 'job-type',
                        'hide_empty' => true,
                    ) 
                );
            ?>
            <!-- Anchor -->
            <div class="jobs-anchors alignfull">
                <div class="s-container">
                    <h3 class="_desktop">
                        <?php _e("VACANCY", "wpml_theme"); ?>
                    </h3>
                    <span class="_desktop">
                        <?php _e("แผนกที่เปิดรับ", "wpml_theme"); ?>
                    </span>

                    <div class="jobs-anchors-wrapper s-grid -d4">
                        <?php 
                            foreach($jobs_types as $job) { 
                                echo '<a class="anchor-item" href="#'. $job->slug .'">';
                                echo $job->name;
                                echo '</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Anchor Section -->
            <?php  
                foreach($jobs_types as $section) { 
                    ?>
                    <div class="anchor-section alignfull" id="<?php echo $section->slug; ?>">
                        <div class="s-container">
                            <div class="anchor-section-header">
                                <h3>
                                    <?php 
                                        $icon = get_field("svg_icon", $section);
                                        echo $icon;
                                        echo $section->name;
                                    ?>
                                </h3>
                                <p>
                                    <?php 
                                        echo $section->description;
                                    ?>
                                </p>
                            </div>
                            <div class="s-grid -d3">
                                <?php 
                                    $args = array(
                                        'post_type' => 'job',
                                        'posts_per_page' => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'job-type',
                                                'field' => 'term_id',
                                                'terms' => $section->term_id,
                                            )
                                        ),
                                    );
                                    $the_query = new WP_Query( $args );
                                    while ( $the_query->have_posts() ) {
                                        $the_query->the_post();
                                        get_template_part( 'template-parts/components/card', 'job' );
                                    }
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </main>
    </div>
</div>

<footer class="entry-footer">
    <?php seed_entry_footer(); ?>
</footer>

<?php get_footer(); ?>