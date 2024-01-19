<?php 
    $type = get_field("product_type");
    $link = get_field("product_link");
    $bg = get_field("product_background");
    $lottie = get_field("product_animation");
    $col_1 = get_field("product_subcategory_1col");
    $col_2 = get_field("product_subcategory_2col");
    $unique_id = 'lottie_'.uniqid();
    $link_id = 'link_'.uniqid();
?>
<!-- Col1 -->
<?php if($type['value'] != 'cold_products'): ?> 

    <a href="<?php echo $link; ?>" id="<?php echo $link_id; ?>" class="featured-product-link">
        <?php 
            $is_flat = $type['value'] == "flat_products" ? "-flat" : "";
        ?>
        <div class="featured-product <?php echo $is_flat; ?>">
            <h3 class="featured-product-title">
                <?php echo $type['label']; ?>
            </h3>

            <div class="featured-subproduct">
                <?php 
                    foreach($col_1 as $item) { 
                        echo '<div>' . $item['product_name'] . '</div>';
                    }
                ?>
            </div>

            <div class="animated">
                <div class="lottie-animated" id="<?php echo $unique_id; ?>"></div>
                <div class="animated-bg">
                    <img src="<?php echo $bg; ?>" />
                </div>
            </div>
        </div>
    </a>

<?php else: ?>
    <a href="<?php echo $link; ?>" id="<?php echo $link_id; ?>" class="featured-product-link">
        <div class="featured-product -type2">
            <h3 class="featured-product-title">
                <?php echo $type['label']; ?>
            </h3>

            <div class="featured-subproduct s-grid -d2">
                <?php 
                    foreach($col_2 as $item) { 
                        echo '<div class="sub-item">';
                        echo $item['product_name'];
                        foreach($item['product_sub'] as $sub_item) { 
                            echo '<div class="sub-sub-item">' . $sub_item['product_sub_sub_name'] . '</div>';
                        }
                        echo '</div>';
                    }
                ?>
            </div>

            <div class="animated">
                <div class="lottie-animated" id="<?php echo $unique_id; ?>"></div>
                <div class="animated-bg">
                    <img src="<?php echo $bg; ?>" />
                </div>
            </div>
        </div>
    </a>
<?php endif; ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var id =  "<?php echo $unique_id; ?>";
        var link_id =  "<?php echo $link_id; ?>";
        var json = "<?php echo $lottie; ?>";
        var animation = document.querySelectorAll('.lottie-animated');
            if(animation.length > 0) { 
                createAnimation(json, id, link_id);
            } 
    });
</script>