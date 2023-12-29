<?php 
    $term_id = get_field("post_news");
    $tabs = get_field("post_news_navigation");
?>

<div class="news-wrap">
    <div class="news-navigation">
        <?php foreach($tabs as $tab) { 
            $name = $tab['page_name'];
            $link = $tab['page_link'];
            $is_active = $tab['is_active'] ? "active" : "";
            echo '<a class="navigation-link '. $is_active .'" href="'. $link .'">';
            echo $name;
            echo '</a>';
        }?>
    </div>
</div>
<div class="news-container">
 <?php 
    echo '<div class="s-grid -d3 -m1">';
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => $paged,
        'post_status' => 'publish',
        'category__in' => $term_id
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
</div>