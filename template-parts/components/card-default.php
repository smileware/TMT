<?php
/**
 * Loop Name: Content Card
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-item -card'); ?>>
    <div class="pic">
        <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
            <?php if(has_post_thumbnail()) { the_post_thumbnail('full');} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
        </a>
    </div>
    <div class="info">
        <header class="entry-header">
            <div class="entry-meta">
                <?php 
                    seed_posted_on(false); 
                    echo '<span> | </span>';
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
                   
                ?>
            </div>
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header>

        <div class="entry-link">
            <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
                <?php _e("อ่านเพิ่มเติม", "wpml_theme"); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none">
                    <path d="M18.4186 4.38574H0.38776C0.17328 4.38574 0 4.21246 0 3.99798C0 3.7835 0.17328 3.61022 0.38776 3.61022H17.4819L15.1287 1.25701C14.9772 1.10554 14.9772 0.859553 15.1287 0.708084C15.2802 0.556615 15.5261 0.556615 15.6776 0.708084L18.6937 3.72413C18.8051 3.83561 18.8379 4.00162 18.7773 4.14703C18.7167 4.29123 18.5749 4.38574 18.4186 4.38574Z" fill="#FA744B"/>
                    <path d="M15.3989 7.40548C15.2996 7.40548 15.2002 7.36792 15.1251 7.29158C14.9736 7.14011 14.9736 6.89412 15.1251 6.74266L18.1448 3.72298C18.2962 3.57151 18.5422 3.57151 18.6937 3.72298C18.8451 3.87445 18.8451 4.12043 18.6937 4.2719L15.674 7.29158C15.5977 7.36792 15.4983 7.40548 15.3989 7.40548Z" fill="#FA744B"/>
                </svg>
            </a>
        </div>
    </div>
</article>