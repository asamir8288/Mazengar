<script type="text/javascript">
    $(document).ready(function(){     
        $('.upload-logo-anchor').livequery('click',function(){
					
					
            $('#myModal').reveal();
            $(".modal-innercontent").remove();	
					
            $('#myModal').append('<div class="modal-innercontent"><a class="select-files-anchor" id="select-files-anchor"></a></div> ');
		
														  
            var myID = $(".modal-innercontent").find("a").attr('id'); 
					
            var parentAppend = $(".modal-innercontent");
					
            $(".select-files-anchor").uploadify ({
                'uploader'  : site_url() + 'layout/js/uploadify.swf',
                'script'    : site_url() +'upload.php',	
                'onComplete' : function(event,queueID,fileObj,response,data) {
                    var img = response.substring(response.lastIndexOf('/') + 1);  
                    
                    if(fileObj.type.toLowerCase() == '.jpg' || fileObj.type.toLowerCase() == '.jpeg' || fileObj.type.toLowerCase() == '.png' || fileObj.type.toLowerCase() == '.gif')
                    {								  
                        parentAppend.find('object').eq(0).remove();
                        $(".dashboard-logo").remove();
                        $(".upload-image-anchor").remove();
                        $(".dashboard-logo-wrapper").append('<img class="dashboard-logo" src="'+site_url() +'uploads/' + img + '" />');                    													
                        $('.user-image-menu').attr('src', site_url() +'uploads/' + img);
                        $('.upload-logo').html('<a class="upload-logo-anchor" id="offer-img" href="#">Change Logo</a> (585 px X 162 px)');
                        $.get(site_url() + 'shop/add_logo/' + img, function(data){});
                        $(".reveal-modal-bg, .reveal-modal").hide();     
                        $('#myModal').css({'top': '150px'}) ;
                    }else{
                        alert('Upload Failure: Only images with the following extenstions jpg, jpeg, png, gif are allowed.');
                    }
                },
                'cancelImg' : 'js/cancel.png',
                'sizeLimit' : '1000000', //Max Size 1 MB
                'folder'    : 'uploads',
                'fileDesc': 'Only images allowed',
                'fileExt' : '*.jpg;*.png;*.jpeg;*.gif',
                'multi' : false,
                'auto'      : true
            });
        });   
    });
	
    $(window).load(function() {
        $('#joyRideTipContent').joyride();
    });
</script>

<style>
    .dashboard-logo{
        height: 68px;}

</style>

<!-- Walkthrough Content -->
<ol id="joyRideTipContent">
    <li  data-text="Next">
        <h2>Welcome to Mazengar</h2>
        <p>This is a simple Walkthrough for the site.</p>
    </li>

    <li data-id="step1_menu" data-text="Next" class="custom">
        <h2>Main Menu</h2>
        <p>Create Your Main Menu</p>
    </li>
    <li data-id="step2_menu"  data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
        <h2>Products</h2>
        <p>Create Your Product Details!</p>
    </li>
    <li data-id="step3_menu"  data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
        <h2>Step #3</h2>
        <p>test 123.</p>
    </li>
    <li data-button="Close">
        <h2>Done</h2>
        <p>You are now ready :)</p>
    </li>
</ol>

<div class="dashboard-header">


    <div id="myModal" class="reveal-modal">
        <h1 style="font-size: 14px;margin-bottom: 9px;font-weight: bold;">Choose Image to Upload:</h1>
        <div class="modal-innercontent">

        </div>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <span class="dashboard-logo-wrapper">
        <?php
        $txt = 'Upload Logo';
        $logo = static_url() . 'layout/images/logo-image.jpg';
        if (isset($shop_details['logo']) && !is_null($shop_details['logo'])) {
            $logo = static_url() . 'uploads/' . $shop_details['logo'];
            $txt = 'Change Logo';
        }
        ?>
        <img class="dashboard-logo" src="<?php echo $logo; ?>" />
    </span>
    <p class="product-title"><?php echo $shop_details['name']; ?></p>
</div>

<p class="upload-logo">
    <a class="upload-logo-anchor" id="offer-img" href="#"><?php echo $txt; ?></a>
    (400 px X 300 px)</p>


<ul class="dashboard-list">
    <!--    <li><a class="large-btn-dashboard gray-bg-dashboard">CUSTOMIZE PAGE THEME</a></li>-->
    <li><a href="<?php echo site_url(); ?>menu" class="large-btn-dashboard gray-bg-dashboard" id="step1_menu">MANAGE MAIN MENU</a></li>
    <li><a href="<?php echo site_url(); ?>product" class="large-btn-dashboard gray-bg-dashboard" id="step2_menu">CREATE NEW PRODUCT</a></li>
    <li><a href="<?php echo site_url('product/manage_products'); ?>" class="large-btn-dashboard gray-bg-dashboard" id="step3_menu">MANAGE PRODUCTS</a></li>
    <li><a href="<?php echo site_url(); ?>offer" class="large-btn-dashboard gray-bg-dashboard">CREATE NEW OFFER</a></li>
    <li><a href="<?php echo site_url('offer/manage_offers'); ?>" class="large-btn-dashboard gray-bg-dashboard">MANAGE OFFERS</a></li>
    <li><a href="<?php echo site_url('branch'); ?>" class="large-btn-dashboard gray-bg-dashboard">CREATE BRANCHES</a></li>    
    <li><a href="<?php echo site_url('branch/manage_branches'); ?>" class="large-btn-dashboard gray-bg-dashboard">MANAGE BRANCHES</a></li>    
    <li><a href="<?php echo site_url('gallery/manage_albums'); ?>" class="large-btn-dashboard gray-bg-dashboard">MANAGE GALLERY</a></li>    
    <li><a href="<?php echo site_url('about_us'); ?>" class="large-btn-dashboard gray-bg-dashboard">MANAGE ABOUT US</a></li>  
    <!--    <li><a class="large-btn-dashboard gray-bg-dashboard">CONTACT US</a></li>    -->

    <?php
    if ($shop_details['users_list_flag'] == 1) {
        ?>
        <li><a href="<?php echo site_url('shop/registrations'); ?>" class="large-btn-dashboard gray-bg-dashboard">Users Data</a></li>  
        <?php
    } 
    if ($shop_details['shopping_list_flag'] == 1) {
        ?>
        <li><a href="<?php echo site_url('shop/shopping_data'); ?>" class="large-btn-dashboard gray-bg-dashboard">Shopping Orders</a></li>  
        <?php
    } 
    if ($shop_details['rating_list_flag'] == 1) {
        ?>
        <li><a href="<?php echo site_url('shop/rating'); ?>" class="large-btn-dashboard gray-bg-dashboard">Rating Data</a></li>  
        <?php
    }
    ?>


</ul>