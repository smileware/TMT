<?php 
    $links = get_field('menu_links');
    if($links) {
        echo '<div class="footer-menu-links">';
        foreach($links as $link_item) { 
            $link = $link_item['menu_item']; 
            if($link) { 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
    
                echo '<a class="footer-menu-item" href="'. esc_url( $link_url ).'" target="'.  esc_attr( $link_target ) .'">';
                echo esc_html( $link_title );
                echo '</a>';
            }
        }
        echo '</div>';
    }
?>