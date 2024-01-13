</div>
<!--#content-->
<aside id="footbar" class="site-footbar">
    <div class="s-container">
        <?php dynamic_sidebar( 'footbar' ); ?>
        <div class="btn-scroll-to-top" onclick="window.scrollTo(0, 0)">
             <?php echo seed_icon('arrow-up'); ?>
        </div>
    </div>
</aside>
<footer id="colophon" class="site-footer">
    <?php 
        $copyright = get_field("copyright", "option");
        $menus = get_field("site_bottom_menus", "option");
    ?>
    <div class="s-container">
        <div class="site-info">
            <?php echo $copyright; ?> <?php echo date("Y"); ?>
        </div>
        <div class="site-info-menu">
            <?php 
                foreach($menus as $menu) { 
                    $link = $menu['site_bottom_item'];
                    if( $link ) { 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        
                        echo '<a class="site-bottom-item" href="'. esc_url( $link_url ).'" target="'.  esc_attr( $link_target ) .'">';
                        echo esc_html( $link_title );
                        echo '</a>';
                    }
                }
            ?>
        </div>
    </div>
</footer>

</div>
<!--#page-->
<div class="s-modal -full modal-board" data-s-modal="site-board" id="board_modal">
    <div class="board-container">
        <span class="s-modal-close"><?php seed_icon('x'); ?></span>
        <div class="pic">
            <img src="" id="board_image" />
        </div>
        <div class="info">
            <h2 id="board_name">นายชัย จรุงธนาภิบาล</h2>
            <div class="position" id="board_position">dfasfasdfmalskdmfasdf</div>
            <div class="background" id="board_background">aksdfsfkop</div>
        </div>
    </div>
</div>
<div class="s-modal-bg"></div>

<?php wp_footer(); ?>
</body>

</html>