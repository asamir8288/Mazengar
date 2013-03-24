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
        
        $('#sub_domain').blur(function(){
            $.get(site_url() + 'signup/check_sub_domain/' + $(this).val(), function(data){
                if(data){
                    $('.sub_domian_error_msg').css('display', 'block');
                }else{
                    $('.sub_domian_error_msg').css('display', 'none');
                }                
            },
            'json');
        });
    });
</script>

<?php echo form_open($submit_url, 'id="form-to-validate"'); ?>
<p class="heading-title">ACCOUNT INFO.</p>
<div class="field-group">
    <label class="form-label">First Name</label>
    <?php
    $val = '';
        if(isset($data['Users'][0]['first_name'])){
            $val = $data['Users'][0]['first_name'];
        }
    ?>
    <input type="text" value="<?php echo $val;?>" name="first_name" required="required" title="Must be 3 or more characters"  >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['Users'][0]['last_name'])){
            $val = $data['Users'][0]['last_name'];
        }
    ?>
    <label class="form-label">Last Name</label>
    <input type="text" name="last_name" value="<?php echo $val;?>" required="required" title="Must be 3 or more characters"  >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['Users'][0]['job_title'])){
            $val = $data['Users'][0]['job_title'];
        }
    ?>
    <label class="form-label">Job Title</label>
    <input type="text" name="job_title" value="<?php echo $val;?>" required="required" title="Must be 3 or more characters"  >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['Users'][0]['phone'])){
            $val = $data['Users'][0]['phone'];
        }
    ?>
    <label class="form-label">Phone no.</label>
    <input type="text" pattern="[0-9]{1,}" value="<?php echo $val;?>" name="phone" required="required" title="Must be a number" >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['Users'][0]['email'])){
            $val = $data['Users'][0]['email'];
        }
    ?>
    <label class="form-label">Email</label>
    <input type="email" name="email" value="<?php echo $val;?>" title="Must be a correct email format" required="required" >
</div>


<p class="heading-title">SHOP INFO.</p>
<div class="field-group">
    <?php
    $val = '';
        if(isset($data['name'])){
            $val = $data['name'];
        }
    ?>
    <label class="form-label">Shop Name</label>
    <input type="text" name="shop_name" value="<?php echo $val;?>" required="required"  title="Must be 2 or more characters" >
</div>

<div class="field-group">
    <label for="" style="float: left;" class="form-label">Address</label>
    <div style="float: left;width: 400px;margin-left: 20px;" id="map"></div>
    <div class="map_fields">
        <ul>            
            <li class="field-group">
                <input type="text" name="longitude" id="longitude" value="<?php echo (isset($data['longitude']))? $data['longitude']: ''; ?>" >                
            </li>
            <li class="field-group">
                <input type="text" name="latitude" id="latitude" value="<?php echo (isset($data['latitude']))? $data['latitude']: ''; ?>" >
            </li>
            <li class="field-group">
                <input type="text" name="city" id="city_id" value="<?php echo (isset($data['city']))? $data['city']: ''; ?>" >
            </li>
            <li class="field-group">                
                <input type="text" name="area" id="area_id" value="<?php echo (isset($data['area']))? $data['area']: ''; ?>" >
            </li>
            <li class="field-group">
                <input type="text" name="street" id="street" value="<?php echo (isset($data['street']))? $data['street']: ''; ?>" >
            </li>
        </ul> 
    </div>
</div>

<div class="clear"></div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['tel1'])){
            $val = $data['tel1'];
        }
    ?>
    <label class="form-label">Tel. 1</label>
    <input type="text"  pattern="[0-9]{1,}" value="<?php echo $val;?>" name="tel1" required="required" title="Must be a number">
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['tel2'])){
            $val = $data['tel2'];
        }
    ?>
    <label class="form-label">Tel. 2</label>
    <input type="text" pattern="[0-9]{1,}" value="<?php echo $val;?>" name="tel2" title="Must be a number">
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['fax'])){
            $val = $data['fax'];
        }
    ?>
    <label class="form-label">Fax</label>
    <input type="text" pattern="[0-9]{1,}" value="<?php echo $val;?>" name="fax" title="Must be a number">
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['website'])){
            $val = $data['website'];
        }
    ?>
    <label class="form-label">Website</label>
    <input type="url" name="website" value="<?php echo $val;?>" required="required" >
</div>


<!--<p class="heading-title">SHARING INFO.</p>
<div class="field-group">
    <?php
    $val = '';
        if(isset($data['ShopOnlinePresence'][0]['url'])){
            $val = $data['ShopOnlinePresence'][0]['url'];
        }
    ?>
    <label class="form-label"><img src="<?php echo base_url();?>layout/images/social_01.png"/></label>
    <input type="text" name="online_presence[]" value="<?php echo $val;?>" >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['ShopOnlinePresence'][1]['url'])){
            $val = $data['ShopOnlinePresence'][1]['url'];
        }
    ?>
    <label class="form-label"><img src="<?php echo base_url();?>layout/images/social_02.png"/></label>
    <input type="text" name="online_presence[]" value="<?php echo $val;?>" >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['ShopOnlinePresence'][2]['url'])){
            $val = $data['ShopOnlinePresence'][2]['url'];
        }
    ?>
    <label class="form-label"><img src="<?php echo base_url();?>layout/images/social_03.png"/></label>
    <input type="text" name="online_presence[]" value="<?php echo $val;?>" >
</div>

<div class="field-group">
    <?php
    $val = '';
        if(isset($data['ShopOnlinePresence'][3]['url'])){
            $val = $data['ShopOnlinePresence'][3]['url'];
        }
    ?>
    <label class="form-label"><img src="<?php echo base_url();?>layout/images/social_04.png"/></label>
    <input type="text" name="online_presence[]" value="<?php echo $val;?>" >
</div>-->


<div class="action-buttons-wrapper">
    <?php echo form_submit('submit', 'Done', 'class="large-btn red-bg"'); ?>
</div>

<!-- END inner-page-content -->	

<?php echo form_close(); ?>
