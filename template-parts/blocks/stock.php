<?php
	$stock_date = get_field("stock_date", "option");
	$stock_date_en = get_field("stock_date_en", "option");
	$stock_price = get_field("stock_price", "option");
	$stock_change = get_field("stock_change", "option");
	$stock_open = get_field("stock_open", "option");
	$stock_prior = get_field("stock_prior", "option");
?>

<div class="stock-homepage">
    <div class="s-grid -d2 section-1">
        <div>
            <h3 class="title"><?php  _e("ราคาหลักทรัพย์", "wpml_theme"); ?> </h3>
            <?php 
                if(ICL_LANGUAGE_CODE == 'th') { 
                    echo '<span class="date"><strong>' . __("อัพเดตวันที่ ", "wpml_theme") . '</strong>' . $stock_date . '</span>';
                }else {
                    echo '<span class="date"><strong>' . __("Last Updated ", "wpml_theme") . '</strong>' . $stock_date_en . '</span>';
                }
            ?>
        </div>
        <div class="logo _desktop">
            <img src="<?php echo esc_url(get_template_directory_uri()). '/img/TMT-Logo.svg' ?>" alt="TMT STEEL" />
        </div>
    </div>

    <div class="s-grid -d2 section-2">
        <div>
            <div class="divider-sm"></div>
            <h4 class="main-stock">TMT</h4>
        </div>
        <div>
        <h4 class="main-stock price"><?php echo $stock_price . __(" บาท", "wpml_theme");  ?></h4>
        </div>
    </div>
    <div class="s-grid -d2 section-detail">
        <div>
            <label>
                <?php echo __("เปลี่ยนแปลง", "wpml_theme");  ?>
            </label>
        </div>
        <div class="value">
            <?php echo $stock_change;  ?>
        </div>
    </div>
    <div class="s-grid -d2 section-detail">
        <div>
            <label>
                <?php echo __("ราคาเปิด", "wpml_theme");  ?>
            </label>
        </div>
        <div class="value">
            <?php echo $stock_open;  ?>
        </div>
    </div>
    <div class="s-grid -d2 section-detail">
        <div>
            <label>
                <?php echo __("ราคาปิดก่อนหน้า", "wpml_theme");  ?>
            </label>
        </div>
        <div class="value">
            <?php echo $stock_prior;  ?>
        </div>
    </div>

</div>

