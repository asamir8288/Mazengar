<?php echo form_open($submit_url, 'id="form-to-validate"'); ?>
<input type="hidden" name="email" value="<?php echo $email?>" >
<p class="heading-title">NEW PASSWORD</p>

<div class="field-group">
    <label class="form-label">New Password</label>
    <input type="password" name="new_password" minlength="4" >
</div>

<div class="field-group">
    <label class="form-label">Confirm New Password</label>
    <input type="password" name="confirm_password" data-equals="new_password" >
</div>

<div class="action-buttons-wrapper" style="float: left;margin-left: 208px;margin-top: 20px;">
    <?php echo form_submit('submit', 'Change', 'class="large-btn red-bg"'); ?>
</div>
<?php echo form_close(); ?>