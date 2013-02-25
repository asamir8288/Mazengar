<div class="login_left">
    <?php echo form_open($submit_url, 'id="register-form"');?>
    <p class="heading-title">SIGN IN TO YOUR ACCOUNT</p>
    <ul>
        <li class="field-group">
            <label class="form-label" for="">Email</label>
            <input type="email" name="email" title="Must be a correct email format" required="required" >
        </li>
        <li class="field-group">
            <label class="form-label" for="">Password</label>
            <input type="password" name="password" minlength="4" >
        </li>
        <li class="field-group" style="width: 295px;margin-left: 144px;">
            <a href="<?php echo site_url('forgot-password');?>" class="forget_pass">Forgot Password</a>
            <?php echo form_submit('submit', '', 'class="signin_btn"');?>
        </li>
    </ul>
    <?php echo form_close();?>
</div>

<div class="login_or_signup"></div>

<div class="login_right">
    <p class="heading-title">SIGN UP</p>
    <div style="clear: left;"></div>
    <div class="txt">
        if not a member, Sign up now, it only takes a minute to have your own account
        
        <a href="<?php echo site_url('signup');?>">Sign up Now</a>
    </div>
</div>