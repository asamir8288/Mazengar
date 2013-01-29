<script type="text/javascript">
    $(document).ready(function(){
        if($('.sub_id').val() != ''){
            $.get(site_url() + 'product/get_menu_subs/' + $('.sub_id').val(), function(data){
                if(data.length > 3){
                    $('.menu_subs').append(data);
                    $('.shopcategory').attr('name', 'sub_id');
                }else{
                    $('.shopcat').hide();
                }
            
            });
        }else{
            $('.shopcategory').attr('name', 'sub_id_unuse');
            $('.shopcategory').last().attr('name', 'sub_id');
        }
       
        $('.shopcategory').live("change",function(){
            $($(this)).nextAll().remove()
            $.get(site_url() + 'product/get_menu_subs/' + $(this).val(), function(data){
                if(data){
                    $('.menu_subs').append(data);
                    $('.shopcategory').attr('name', 'sub_id_unuse');                    
                }    
                $('.shopcategory').last().attr('name', 'sub_id');
            });            
        });
        
        $(".custom-checkbox").click(function(){	  
            if($(this).hasClass("custom-checkbox-checked")){
                $(this).removeClass("custom-checkbox-checked");
                $('.hidden-availability').val('no');
            }else{
                $(this).addClass("custom-checkbox-checked");
                $('.hidden-availability').val('yes');
            }            
        });                
    });
    
    function gotosite()
    {
        var URL = document.edit_about_us.url_list.options[document.edit_about_us.url_list.selectedIndex].value; 
        
        window.location.href = URL;
    }
</script>



<?php
if (isset($editable_items) && count($editable_items)) {
    echo form_open('', 'name="edit_about_us"')
    ?>
    <noscript>
    <input type="submit" name="submit_button" value="Go" />
    </noscript>

    <div class="field-group">
        <label class="form-label" style="width: 20px;">Edit:</label>
        <div class="select-options-wrapper">
            <select class="custom-select" name="url_list" size="1" onChange="gotosite()">
                <option value="">Select</option>
                <?php foreach ($editable_items as $item) { ?>
                    <option value="<?php echo site_url('about_us/edit/' . $item['id']) ?>"><?php echo $item['ShopMenuSubs']['name']; ?></option>
    <?php } ?>
            </select>
        </div>
    </div>
    <div style="clear: both;width: 93%;height: 10px;border-bottom: 1px dashed #C4C4C4;"></div>
    <?php
    echo form_close();
}
?>

<?php echo form_open_multipart($submit_url, 'id="form-to-validate"'); ?>
<?php
$menu_top_level = $menuTopLevel;
if (isset($about_us_menu) && count($about_us_menu) == 1) {
    $menu_top_level = $about_us_menu[0]['id'];
} else if (isset($about_us_menu)) {
    $menu_top_level = '';
}
?>  
<input type="hidden" name="sub_id" class="sub_id" value="<?php echo $menu_top_level; ?>" />
<div class="field-group shopcat">
    <label class="form-label-short">Category</label>
    <div class="select-options-wrapper menu_subs">
        <?php
        if (isset($about_us_menu) && count($about_us_menu)) {
            for ($i = 0; $i < count($about_us_menu) - 1; $i++) {
                echo product_menu($about_us_menu[$i]['id'], $data['sub_id']);
            }
        }
        ?>
    </div>
</div>  

<div class="field-group">
    <label class="form-label-short">Description</label>
    <textarea name="description" required="required"><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
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
    <div class="custom-checkbox<?php echo $checked; ?>" style="margin-left:177px"></div>            
    <label class="form-label-checkbox"  style="margin-left:14px">Availability</label>
    <input type="hidden" name="published" class="hidden-availability" value="<?php echo $chbox_value; ?>" />
</div>

<div style="clear: both;height:20px;"></div>
<div style="margin-left: 165px;">        
<?php echo form_submit('submit', 'SAVE', 'class="large-btn gray-bg-products"'); ?>
    <input type="submit" class="cancel-text-btn" value="Cancel" />
</div>
<?php echo form_close(); ?>