<?php
/**
 * Loop Name: Content Post Detail
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
    <div class="pic">
        <?php if(has_post_thumbnail()) { the_post_thumbnail('full');} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
    </div>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php seed_posted_tags(); ?>
    </div>

    <div class="entry-meta">
        <?php 
            
            switch(get_post_type()) { 
                case "post":
                    seed_posted_cats(false);
                    break;
                case "award":
                    $terms = get_the_terms(get_the_ID(), 'award-type');
                    $entry_cat = "";
                    if( $terms ) { 
                        foreach( $terms as $term ) {
                            $entry_cat .= '<span class=" _heading">' . $term->name . '</span>';
                        }
                    }   
                    echo $entry_cat;
                    break;
                case "sustainability":
                    $terms = get_the_terms(get_the_ID(), 'sustainability-type');
                    $entry_cat = "";
                    if( $terms ) { 
                        foreach( $terms as $term ) {
                            $entry_cat .= '<span class=" _heading">' . $term->name . '</span>';
                        }
                    }   
                    echo $entry_cat;
                    break;
                default:
                    seed_posted_cats(false);
                    break;
            }
            echo '<span> | </span>';
            seed_posted_on(false); 
        ?>
    </div>
    <footer class="entry-footer">
        <?php seed_entry_footer(); ?>
    </footer>
</article>


<!-- Related -->

<div class="alignfull related-container">
    <div class="s-container">
        <h2 class="relate-title">
            <?php echo $title . __("ที่เกี่ยวข้อง", "wpml_theme"); ?>
        </h2>
        <div class="divider"></div>
        <?php 
            if ( get_post_type() == "post") {
                $categories = wp_get_post_categories( get_the_ID() );
                foreach ($categories as $category) {
                    $term_IDs[] = $category;
                }
                $args = array(
                    'post_type' => "post",
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'post__not_in' => array( get_the_ID() ),
                    'cat' =>  $term_IDs
                );
            }else { 
                if (get_post_type() == 'award') {
                    $taxo = 'award-type';
                }
                elseif (get_post_type() == 'sustainability') {
                    $taxo = 'sustainability-type';
                }
                
                $terms = get_the_terms(get_the_ID(), $taxo);
                foreach ($terms as $term) {
                    $term_IDs[] = $term->term_id;
                }
                $args = array(
                    'post_type' => get_post_type(),
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'post__not_in' => array( get_the_ID() ),
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxo,
                            'terms' =>  $term_IDs
                        )
                    )
                );
            }
           
            $the_query = new WP_Query( $args );
        ?>
        <?php if ($the_query->found_posts): ?>
            <div class="s-grid -d3 -m1 _desktop">
                <?php
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        get_template_part( 'template-parts/components/card', 'default' );
                    }
                    wp_reset_postdata();
                ?>
            </div>

            <div class="s-slider -d3 -m1.2 _mobile">
                <?php
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        echo '<div class="slider">';
                        get_template_part( 'template-parts/components/card', 'default' );
                        echo '</div>';
                    }
                    wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>

    </div>
</div>