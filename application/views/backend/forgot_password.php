<?php echo form_open($submit_url, 'id="register-form"'); ?>
<p class="heading-title">FORGOT PASSWORD</p>
<ul>
    <div class="field-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" title="Must be a correct email format" required="required" >
    </div>
</ul>
<div class="action-buttons-wrapper" style="float: left;margin-left: 208px;margin-top: 10px;">
    <?php echo form_submit('submit', 'Send', 'class="large-btn red-bg"'); ?>
</div>
<?php echo form_close(); ?>