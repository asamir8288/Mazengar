<style type="text/css">
    .shopcategory{
        margin-bottom: 20px;
    }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=en"></script>
<script type="text/javascript" src="<?php echo base_url() . 'layout/js/jquery.googlemap.js' ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#map').gMap({
            latitude: $('#latitude'),
            longitude: $('#longitude'),
            country_id: '*',
            city: $('#city_id'),
            area: $('#area_id'),
            street: $('#street')
        });
        
        $(".custom-checkbox").click(function(){	  
            if($(this).hasClass("custom-checkbox-checked")){
                $('.hidden-availability').val('no');
                $(this).removeClass("custom-checkbox-checked");            
            } else{
                $(this).find($('.hidden-availability')).val('yes');
                $(this).addClass("custom-checkbox-checked");            
            }            
            //Main Code  
	  	
        });
        
        $('.country_id').change(function(){
            $.get(site_url()+"branch/get_collection/"+$(this).val(), function(data){                
                $('#collection_id').html(data);
            });
        });
        
        if($('.country_id option:selected').val() != ''){
            $.get(site_url()+"branch/get_collection/"+$('.country_id option:selected').val(), function(data){                
                $('#collection_id').html(data);
                $('#collection_id').val($('#col_id').val());
            });
        }
        
        
        if($('.menu_id').val() != ''){
            $.get(site_url() + 'product/get_menu_subs/' + $('.branch_id').val(), function(data){
                if(data){
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
            });
            $('.shopcategory').last().attr('name', 'sub_id');
        });
    });	    
</script>

<?php echo form_open($submit_url, 'id="form-to-validate"'); ?>

<div style="float: left;">
    <?php
    $menu_top_level = $menuTopLevel;
    if (isset($branch_menu) && count($branch_menu) == 1) {
        $menu_top_level = $branch_menu[0]['id'];
    } else if (isset($branch_menu)) {
        $menu_top_level = '';
    }
    ?>  
    <input type="hidden" name="menu_id" class="menu_id" value="<?php echo $menu_top_level; ?>" />      

    <p class="heading-title">BRANCH INFO.</p>
    <div class="field-group shopcat">
        <label class="form-label">Category</label>
        <div class="select-options-wrapper menu_subs">
            <?php
            if (isset($branch_menu) && count($branch_menu)) {
                for ($i = 0; $i < count($branch_menu) - 1; $i++) {
                    echo product_menu($branch_menu[$i]['id'], $data['menu_id']);
                }
            }
            ?>
        </div>
    </div>   

    <div class="field-group" style="margin-top: 0px;">
        <label class="form-label">Branch Name</label>
        <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" pattern="[a-zA-Z ]{2,}" required="required"  title="Must be 2 or more characters" >
    </div>

    <div class="field-group">
        <label class="form-label">Governorate</label>
        <div class="select-options-wrapper">
            <select class="custom-select country_id" required="required" name="country_id">
                <option value="">Select</option>
                <?php
                foreach ($governates as $governate) {
                    if (isset($data['menu_id']) && $data['LookupCollections']['LookupGovernorates']['id'] == $governate['id']) {
                        echo '<option selected="selected" value="' . $governate['id'] . '">' . $governate['name'] . '</option>';
                    } else {
                        echo '<option value="' . $governate['id'] . '">' . $governate['name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>

		<div id="myModal" class="reveal-modal">
				 <h1 style="font-size: 14px;margin-bottom: 9px;font-weight: bold;">Choose Image to Upload:</h1>
				 <div class="modal-innercontent">
				 
				 </div>
				 <a class="close-reveal-modal">&#215;</a>
				</div>
				
    <div class="field-group">
        <label class="form-label">Collection</label>
        <div class="select-options-wrapper">
            <?php
            if (isset($data['collection_id'])) {
                ?>
                <input type="hidden" name="col_id" id="col_id" value="<?php echo $data['collection_id']; ?>" />
                <?php
            }
            ?>
            <select class="custom-select" id="collection_id" required="required" name="collection_id">
                <option value="">Select</option>

            </select>
        </div>
    </div>    

    <?php foreach ($filters as $filter) { ?>
        <div class="field-group">          
            <label style="margin-left:215px">
                <input type="checkbox" name="filter_id[]" value="<?php echo $filter['id'];?>" />
                <?php echo $filter['name'];?></label>            
        </div>
    <?php } ?>
</div>

<div class="right-container">
    <input type="hidden" name="main_pic" class="main_img" value="" />
    <img class="main-image"src="<?php echo static_url(); ?>layout/images/offer-default-image.jpg" />
    <a class="upload-image-anchor" href="#">Upload Branch Cover Image</a>

</div>
<div class="clear"></div>

<div class="field-group">
    <label for="" style="float: left;" class="form-label">Address</label>
    <div style="float: left;width: 400px;margin-left: 20px;" id="map"></div>
    <div class="map_fields">
        <ul>
            <li class="field-group">
                <input type="text" name="longitude" value="<?php echo isset($data['longitude']) ? $data['longitude'] : ''; ?>" id="longitude">                
            </li>
            <li class="field-group">
                <input type="text" name="latitude" value="<?php echo isset($data['latitude']) ? $data['latitude'] : ''; ?>" id="latitude">
            </li>
            <li class="field-group">
                <input type="text" name="city" value="<?php echo isset($data['city']) ? $data['city'] : ''; ?>" id="city_id">
            </li>
            <li class="field-group">                
                <input type="text" name="area" value="<?php echo isset($data['area']) ? $data['area'] : ''; ?>" id="area_id">
            </li>
            <li class="field-group">
                <input type="text" name="street_address" value="<?php echo isset($data['street_address']) ? $data['street_address'] : ''; ?>" id="street">
            </li>
        </ul> 
    </div>
</div>

<div class="clear"></div>

<div class="field-group">
    <label class="form-label">Tel. 1</label>
    <input type="text"  pattern="[0-9]{1,}" name="tel1" value="<?php echo isset($data['tel1']) ? $data['tel1'] : ''; ?>" required="required" title="Must be a number">
</div>

<div class="field-group">
    <label class="form-label">Tel. 2</label>
    <input type="text" pattern="[0-9]{1,}" name="tel2" value="<?php echo isset($data['tel2']) ? $data['tel2'] : ''; ?>" title="Must be a number">
</div>

<div class="field-group">
    <label class="form-label">Fax</label>
    <input type="text" pattern="[0-9]{1,}" name="fax" value="<?php echo isset($data['fax']) ? $data['fax'] : ''; ?>" title="Must be a number">
</div>

<div class="field-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" required="required" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" title="Must be a correct email format" >
</div>

<div class="field-group">
    <label class="form-label">Website</label>
    <input type="url" name="website" value="<?php echo isset($data['website']) ? $data['website'] : ''; ?>" required="required" >
</div>

<div class="action-buttons-wrapper">
    <?php echo form_submit('submit', 'Done', 'class="large-btn red-bg"'); ?>
</div>


<!-- END inner-page-content -->	

<?php echo form_close(); ?>