<?php echo form_open($submit_url, 'id="form-to-validate"'); ?>
<p class="heading-title">FORGOT PASSWORD</p>

<div class="field-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" title="Must be a correct email format" required="required" >
</div>

<div class="action-buttons-wrapper" style="float: left;margin-left: 208px;margin-top: 20px;">
    <?php echo form_submit('submit', 'Change', 'class="large-btn red-bg"'); ?>
</div>
<?php echo form_close(); ?>