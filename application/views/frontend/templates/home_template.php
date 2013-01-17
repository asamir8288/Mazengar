<!DOCTYPE html>
<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <!-- BEGIN head -->
    <head>
        <!-- Title -->
        <title><?php echo isset($page_title) ? $page_title : ''; ?> | Mazengar</title>	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Style -->
        <link rel="stylesheet" href="<?php echo static_url(); ?>layout/css/frontend/style.css" type="text/css" media="screen" />
        <?php echo $_styles; ?>
        <script type="text/javascript" src="<?php echo static_url(); ?>layout/js/jquery-1.7.2.min.js" ></script> 
        <?php echo $_scripts; ?>
        <!-- END head -->
    </head>

    <!-- BEGIN body -->
    <body>

        <!-- BEGIN container -->	
        <div id="container">


            <!-- BEGIN header -->	
            <div id="header">

                <!-- BEGIN menu-header-wrapper -->	
                <div id="menu-header-wrapper">

                    <a class="site-logo"></a>
                    <ul class="header-menu-list">							
                        <li class="menu-header-item <?php echo ($menu[0]) ? 'home-active' : 'home'; ?>"><a href="<?php echo site_url(); ?>">HOME</a></li>		

                        <li class="menu-header-item <?php echo ($menu[1]) ? 'about-active' : 'about'; ?>"><a href="<?php echo site_url(); ?>about-us">ABOUT</a></li>		

                        <li class="menu-header-item demo"><a href="<?php echo site_url(); ?>login">DEMO</a></li>		
                        <li class="menu-header-item <?php echo ($menu[3]) ? 'merchant-active' : 'merchant'; ?>"><a href="<?php echo site_url(); ?>merchant">MERCHANT..?</a></li>		
                        <li class="menu-header-item <?php echo ($menu[4]) ? 'contact-active' : 'contact'; ?>"><a href="<?php echo site_url(); ?>contact-us">CONTACT</a></li>		


                    </ul>

                    <!-- END menu-header-wrapper -->	
                </div>

                <!-- END header -->
            </div>	

            <!-- BEGIN content -->	
            <div id="content">

                <!-- BEGIN inner-content -->	
                <div id="content-wrapper">

                    <!-- BEGIN inner-page-content -->
                    <div id="inner-page-content">
                        <?php echo $content; ?>

                        <div class="horizontal-seperator"></div>
                        <!-- END inner-page-content -->	
                    </div>
                    <!-- END content-wrapper -->	
                </div>
                <!-- END content -->	
            </div>	

            <div id="footer">
                <div id="footer-copyright">
                    <br/>
                    <p style="margin-bottom:10px;"><a href="<?php echo site_url(); ?>">Home</a> <a href="<?php echo site_url(); ?>about-us">About</a> <a href="<?php echo site_url(); ?>merchant">Merchants</a> <a href="<?php echo site_url(); ?>terms-conditions">Legal</a> <a href="<?php echo site_url(); ?>privacy-policy">Privacy Policy</a> <a href="<?php echo site_url(); ?>contact-us">Contact</a></p>
                    <p>© 2012 Mazengar, Inc.
                    </p>				
                </div>		
            </div>		
            <!-- END container -->
        </div>
        <!-- END body -->
    </body>

    <!--END html-->
</html>