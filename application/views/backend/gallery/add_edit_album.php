<style type="text/css">
    .gallery-image{
        margin-top:11px;
        margin-left: 25px;
        width: 222px;
        max-height: 230px;
        border: 1px solid #E9E9E9;
        -webkit-box-shadow: 0 0 3px 1px rgba(0, 0, 0, 0.05),0 1px 3px rgba(0, 0, 0, 0.11);
        -moz-box-shadow: 0 0 3px 1px rgba(0,0,0,0.05),0 1px 3px rgba(0,0,0,0.11);
        box-shadow: 0 0 3px 1px rgba(0, 0, 0, 0.05),0 1px 3px rgba(0, 0, 0, 0.11);
        border: 1px solid #EBEBEB;
        border: 3px solid rgba(255, 255, 255, 0.99);
    }

    .upload-gallery-image-anchor{        
        font-size: 13px;
        font-family: calibri,Arial, sans-serif;
        cursor: pointer;
        color: #007AFF;
        clear: both;
        position: relative;
        top: -84px;
        left: 6px;
    }
</style>

<?php echo form_open($submit_url); ?>

<?php
$menu_top_level = $menuTopLevel;
if (isset($product_menu) && count($product_menu) == 1) {
    $menu_top_level = $product_menu[0]['id'];
} else if (isset($product_menu)) {
    $menu_top_level = '';
}
?>        
<input type="hidden" name="sub_id" class="sub_id" value="<?php echo $menu_top_level; ?>" />

<div class="field-group shopcat">
    <label class="form-label-short">Category</label>
    <div class="select-options-wrapper menu_subs">
        <?php
        if (isset($gallery_menu) && count($gallery_menu)) {
            for ($i = 0; $i < count($gallery_menu) - 1; $i++) {
                echo product_menu($gallery_menu[$i]['id'], $data['sub_id']);
            }
        }
        ?>
    </div>
</div>

		<div id="myModal" class="reveal-modal">
				 <h1 style="font-size: 14px;margin-bottom: 9px;font-weight: bold;">Choose Image to Upload:</h1>
				 <div class="modal-innercontent">
				 
				 </div>
				 <a class="close-reveal-modal">&#215;</a>
				</div>

<div class="field-group" style="margin-top: 0px;">
    <label class="form-label">Album Name: </label>
    <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>">
</div>

<div style="clear: both;"></div>
<div>
    <input type="hidden" name="main_img" class="main_img" value="<?php echo isset($data['img']) ? $data['img'] : '' ?>" />
    <label class="form-label">Album Image: </label>
    <img class="gallery-image" src="<?php echo static_url(); ?><?php echo isset($data['img']) && $data['img'] != '' ? 'uploads/' . $data['img'] : 'layout/images/offer-image.jpg' ?>" />

    <a class="upload-gallery-image-anchor" id="gallery-img" href="#">Upload Album Cover Image</a>

</div>

<div class="field-group">
    <?php
    $checked = '';
    $chbox_value = 'no';
    if (isset($data['published']) && $data['published']) {
        $checked = ' custom-checkbox-checked';
        $chbox_value = 'yes';
    }
    ?>
    <div class="custom-checkbox<?php echo $checked; ?>" style="margin-left:220px"></div>            
    <label class="form-label-checkbox"  style="margin-left:7px">Availability</label>
    <input type="hidden" name="published" class="hidden-availability" value="<?php echo $chbox_value; ?>" />
</div>

<div class="action-buttons-wrapper">
    <?php echo form_submit('submit', 'Done', 'class="large-btn red-bg"'); ?>
</div>
<?php echo form_close(); ?>
