<?php
    $menus = get_field("quick_menu");
?>
<div class="s-grid -d2 -m2 quick-menu">
    <?php 
        foreach($menus as $menu) { 
            $url = $menu['menu_link'];
            $name = $menu['menu_name'];
            $icon = $menu['menu_icon'];

            echo '<a href="'. $url .'" class="quick-menu-item">';
            echo $icon;
            echo '<span class="quick-menu-title">'. $name .'</span>';
            echo '</a>';
        }
    ?>
</div>