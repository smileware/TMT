<?php 
    $term_id = get_field("sustainability_document_term");
?>
<div class="document-header">
    <h3><?php echo $term_id->name; ?></h3>
    <div class="filter-container">
        <label><?php _e("เลือกปี: ","wpml_theme"); ?></label>
        <?php echo facetwp_display('facet','year') ?>
    </div>
</div>

<div class="document-container">
    <div class="document-table-header">
        <div class="dth dth-date">
            <label><?php _e("วันที่", "wpml_theme"); ?></label>
        </div>
        <div class="dth dth-title">
            <label><?php _e("หัวข้อ", "wpml_theme"); ?></label>
        </div>
        <div class="dth dth-action"></div>
    </div>
    <?php echo facetwp_display( 'template', 'document_template' ) ?>
    <?php echo facetwp_display( 'facet', 'pagination' ); ?>
</div>