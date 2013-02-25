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
    <input type="text" name="first_name" pattern="[a-zA-Z ]{3,}" required="required" title="Must be 3 or more characters"  >
</div>

<div class="field-group">
    <label class="form-label">Last Name</label>
    <input type="text" name="last_name" pattern="[a-zA-Z ]{3,}" required="required" title="Must be 3 or more characters"  >
</div>

<div class="field-group">
    <label class="form-label">Job Title</label>
    <input type="text" name="job_title" pattern="[a-zA-Z ]{3,}" required="required" title="Must be 3 or more characters"  >
</div>

<div class="field-group">
    <label class="form-label">Phone no.</label>
    <input type="text" pattern="[0-9]{1,}" name="phone" required="required" title="Must be a number" >
</div>

<div class="field-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" title="Must be a correct email format" required="required" >
</div>

<div class="field-group">
    <label class="form-label">Password</label>
    <input type="password" name="password" minlength="4" >
</div>

<div class="field-group">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="confirm_password" data-equals="password" >
</div>


<p class="heading-title">SHOP INFO.</p>
<div class="field-group">
    <label class="form-label">Shop Name</label>
    <input type="text" name="shop_name" pattern="[a-zA-Z ]{2,}" required="required"  title="Must be 2 or more characters" >
</div>

<div class="field-group">
    <label class="form-label">Category</label>
    <div class="select-options-wrapper">
        <select class="custom-select" required="required" name="category_id">
            <option value="">Select</option>
            <?php foreach ($shopCategories as $cat) { ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="field-group">
    <label for="" style="float: left;" class="form-label">Address</label>
    <div style="float: left;width: 400px;margin-left: 20px;" id="map"></div>
    <div class="map_fields">
        <ul>
            <li class="field-group">
                <div class="select-options-wrapper">
                    <select class="custom-select" required="required" name="country_id">
                        <option value="">Select</option>
                        <?php
                        foreach ($countries as $country) {
                            echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <input type="text" name="longitude" id="longitude">                
            </li>
            <li class="field-group">
                <input type="text" name="latitude" id="latitude">
            </li>
            <li class="field-group">
                <input type="text" name="city" id="city_id">
            </li>
            <li class="field-group">                
                <input type="text" name="area" id="area_id">
            </li>
            <li class="field-group">
                <input type="text" name="street" id="street">
            </li>
        </ul> 
    </div>
</div>

<div class="clear"></div>

<div class="field-group">
    <label class="form-label">Tel. 1</label>
    <input type="text"  pattern="[0-9]{1,}" name="tel1" required="required" title="Must be a number">
</div>

<div class="field-group">
    <label class="form-label">Tel. 2</label>
    <input type="text" pattern="[0-9]{1,}" name="tel2" title="Must be a number">
</div>

<div class="field-group">
    <label class="form-label">Fax</label>
    <input type="text" pattern="[0-9]{1,}" name="fax" title="Must be a number">
</div>


<div class="field-group">
    <label class="form-label">Email</label>
    <input type="email" name="companyemail" required="required" title="Must be a correct email format" >
</div>

<div class="field-group">
    <label class="form-label">Website</label>
    <input type="url" name="website" required="required" >
</div>

<div class="field-group">
    <label class="form-label">Your website link</label>
    <input type="text" name="sub_domain" id="sub_domain" style="width: 134px;text-align: right;padding-right:7px;" required="required" >
    <label class="form-label-website-link">.mazengar.com</label>
    <div class="error sub_domian_error_msg" style="display: none;clear: both;margin-left: 222px;">Sub Domain is exist</div>
</div>


<p class="heading-title">SHARING INFO.</p>
<div class="field-group">
    <label class="form-label"><img src="layout/images/social_01.png"/></label>
    <input type="text" name="online_presence[]" >
</div>

<div class="field-group">
    <label class="form-label"><img src="layout/images/social_02.png"/></label>
    <input type="text" name="online_presence[]" >
</div>

<div class="field-group">
    <label class="form-label"><img src="layout/images/social_03.png"/></label>
    <input type="text" name="online_presence[]" >
</div>

<div class="field-group">
    <label class="form-label"><img src="layout/images/social_04.png"/></label>
    <input type="text" name="online_presence[]" >
</div>

<div class="field-group">
    <label class="form-label">3+9=</label>
    <input type="text" style="width: 89px;" name="number-validation" pattern="[1]{1}[2]{1}"class="number-validation" required="required" >
</div>

<div class="field-group">
    <input class="custom-checkbox" type="checkbox" required="required" name="custom-checkbox"/>
    <label class="form-label-checkbox">I accept terms of agreement</label>
</div>

<div class="action-buttons-wrapper">
    <?php echo form_submit('submit', 'Done', 'class="large-btn red-bg"'); ?>
</div>

<!-- END inner-page-content -->	

<?php echo form_close(); ?>
