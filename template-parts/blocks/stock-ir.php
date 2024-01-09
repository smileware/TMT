<?php
	$stock_date = get_field("stock_date", "option");
	$stock_date_en = get_field("stock_date_en", "option");
	$stock_price = get_field("stock_price", "option");
	$stock_change = get_field("stock_change", "option");
	$stock_volumn = get_field("stock_volumn", "option");
?>

<div class="stock-ir">
    <div class="col col-1">
        <span class="title-label"><?php _e("ราคาหลักทรัพย์", "wpml_theme"); ?></span>
        <h3>TMT</h3>
        <div>www.set.or.th</div>
    </div>
    <div class="col col-2">
        <h3><?php echo $stock_price; ?> <span class="_mobile"><?php _e("บาท", "wpml_theme"); ?></span></h3>
        <?php 
            if(ICL_LANGUAGE_CODE == 'th') { 
                echo '<label class="date"><strong>' . __("อัพเดตวันที่ ", "wpml_theme") . '</strong>' . $stock_date . '</label>';
            }else {
                echo '<label class="date"><strong>' . __("Last Updated ", "wpml_theme") . '</strong>' . $stock_date_en . '</label>';
            }
        ?>
    </div>
    <div class="col col-3">
        <h4><?php echo $stock_change; ?></h4>
        <label>
            <?php _e("เปลี่ยนแปลง", "wpml_theme"); ?>
        </label>
    </div>
    <div class="col col-4">
        <h4><?php echo $stock_volumn; ?></h4>
        <label>
            <?php _e("ปริมาณซื้อขาย (หุ้น)", "wpml_theme"); ?>
        </label>
    </div>
</div>