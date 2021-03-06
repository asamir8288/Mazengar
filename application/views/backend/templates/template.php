<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml">


    <!-- BEGIN head -->
    <head>

        <!-- Title -->
        <title><?php echo (isset($page_title)) ?  $page_title : '';?></title>	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="<?php echo $this->config->item('static_url'); ?>layout/images/favicon.ico" type="image/x-icon" />
        <!-- Style -->
        <link rel="stylesheet" href="<?php echo $this->config->item('static_url');?>layout/css/style.css?<?php echo $this->config->item('static_version');?>" type="text/css" media="screen" />        
        <link rel="stylesheet" href="<?php echo $this->config->item('static_url');?>layout/css/buttons.css?<?php echo $this->config->item('static_version');?>" type="text/css" media="screen" />        
        <?php echo $_styles; ?>
        
        <script type="text/javascript" src="<?php echo $this->config->item('static_url');?>layout/js/jquery-1.7.2.min.js?<?php echo $this->config->item('static_version');?>" ></script> 
        <script type="text/javascript" src="<?php echo $this->config->item('static_url');?>layout/js/site_url_global.js?<?php echo $this->config->item('static_version');?>" ></script> 
        <?php echo $_scripts; ?>

        <script>
            $(document).ready(function(){
                $(".menu-dropdown-wrapper").hide();
                
                $('li.more-menu').mouseover(function() {
                    $(this).find(".menu-dropdown-wrapper").show();
                });

                $('li.more-menu').mouseleave(function() {
                    $(this).find(".menu-dropdown-wrapper").hide();
                });					
            });
        </script>
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
                        <?php echo $top_menu;?>
                    </ul>
                    <!-- END menu-header-wrapper -->	
                </div>
                <!-- END header -->
            </div>
            <!-- BEGIN content -->	
            <div id="content">

                <!-- BEGIN breadcrumbs-navigation -->	
                <div id="breadcrumbs-navigation">
                    <ul class="breadcrumbs-list">
                        <?php
                            if(isset($page_nav)){
                                echo $page_nav;
                            }else{
                                echo '<li></li>';
                            }
                        ?>                        
                    </ul>
                    <!-- END breadcrumbs-navigation -->	
                </div>	

                <!-- BEGIN inner-content -->	
                <div id="content-wrapper">
                    <!-- BEGIN inner-page-content -->
                    <div id="inner-page-content">
                        <?php echo $content;?>
                        <!-- END inner-page-content -->	
                    </div>
                    <!-- END content-wrapper -->	
                </div>
                <!-- END content -->	
            </div>	

            <div id="">
<!--                <div id="footer-content">
                    <img src="<?php echo $this->config->item('static_url');?>layout/images/footer.png" />
                </div>-->
                <div id="footer-copyright">
                    <p>&copy; <?php echo date('Y');?> Mazengar, Inc.</p>
                </div>
            </div>
            <!-- END container -->
        </div>	
        <!-- END body -->
    </body>

    <!--END html-->
</html>