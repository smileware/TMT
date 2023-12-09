<?php 
    $menu_id = get_field("menu_id");
?>
<div class="block-nav-menu">
    <?php 
        wp_nav_menu( array( 'menu' => $menu_id ) );
    ?>
</div>