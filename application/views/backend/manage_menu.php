<form action="" id="myForm" method="POST">

    <!-- Image Upload Code -->

    <div id="myModal" class="reveal-modal">
        <h1 style="font-size: 14px;margin-bottom: 9px;font-weight: bold;">Choose Image to Upload:</h1>
        <div class="modal-innercontent">

        </div>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <!-- End Image Upload Code -->

    <div id="submit-area">						
    </div>
    <?php if ((!$menu)) { ?>

        <div class="mainmenu-item-wrapper">
            <img class="mainmenu-image" src="<?php echo base_url() . 'layout' ?>/images/mainmenu-image.png" />
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="text" maxlength="15" title="Edit" class="mainmenu-name" value="About Us"/>
            <input type="hidden" class="menu-type" value="about-us"/>
            <ul class="mainmenu-icons-list">									
                <li class="mainmenu-icon open-image-icon" title="Add Image" ></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon add-submenu-icon" title="Add Sub-Menu" ></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon delete-menu-icon" title="Delete Menu"></li>

            </ul>

        </div>
        <div class="move-menu-wrapper">
            <a class="move-menu-up">Move up</a>
            <a class="move-menu-down">Move Down</a>
        </div>


    </div>

    <div class="mainmenu-item-wrapper">				
        <img class="mainmenu-image" src="<?php echo base_url() . 'layout' ?>/images/mainmenu-image.png" />
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Products"/>
            <input type="hidden" class="menu-type" value="products"/>
            <ul class="mainmenu-icons-list">									
                <li class="mainmenu-icon open-image-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon add-submenu-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon delete-menu-icon"></li>

            </ul>
        </div>

        <div class="move-menu-wrapper">
            <a class="move-menu-up">Move up</a>
            <a class="move-menu-down">Move Down</a>
        </div>
    </div>			

    <div class="mainmenu-item-wrapper">				
        <img class="mainmenu-image" src="<?php echo base_url() . 'layout' ?>/images/mainmenu-image.png" />
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Offers"/>
            <input type="hidden" class="menu-type" value="offers"/>
            <ul class="mainmenu-icons-list">									
                <li class="mainmenu-icon open-image-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon add-submenu-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon delete-menu-icon"></li>

            </ul>
        </div>	
        <div class="move-menu-wrapper">
            <a class="move-menu-up">Move up</a>
            <a class="move-menu-down">Move Down</a>
        </div>
    </div>

    <div class="mainmenu-item-wrapper">				
        <img class="mainmenu-image" src="<?php echo base_url() . 'layout' ?>/images/mainmenu-image.png" />
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Gallery"/>
            <input type="hidden" class="menu-type" value="gallery"/>
            <ul class="mainmenu-icons-list">									
                <li class="mainmenu-icon open-image-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon add-submenu-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon delete-menu-icon"></li>

            </ul>
        </div>	
        <div class="move-menu-wrapper">
            <a class="move-menu-up">Move up</a>
            <a class="move-menu-down">Move Down</a>
        </div>
    </div>	


    <div class="mainmenu-item-wrapper">				
        <img class="mainmenu-image" src="<?php echo base_url() . 'layout' ?>/images/mainmenu-image.png" />
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Branches"/>
            <input type="hidden" class="menu-type" value="branch"/>
            <ul class="mainmenu-icons-list">									
                <li class="mainmenu-icon open-image-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon add-submenu-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon delete-menu-icon"></li>

            </ul>
        </div>	
        <div class="move-menu-wrapper">
            <a class="move-menu-up">Move up</a>
            <a class="move-menu-down">Move Down</a>
        </div>
    </div>	

    <div class="mainmenu-item-wrapper">				
        <img class="mainmenu-image" src="<?php echo base_url() . 'layout' ?>/images/mainmenu-image.png" />
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="text" maxlength="15" title="Edit"  class="mainmenu-name" value="Contact Us"/>
            <input type="hidden" class="menu-type" value="contact-us"/>
            <ul class="mainmenu-icons-list">									
                <li class="mainmenu-icon open-image-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon add-submenu-icon"></li>
                <li class="mainmenu-list-seperator"></li>
                <li class="mainmenu-icon delete-menu-icon"></li>

            </ul>
        </div>	
        <div class="move-menu-wrapper">
            <a class="move-menu-up">Move up</a>
            <a class="move-menu-down">Move Down</a>
        </div>
    </div>		


    <div class="inactive-menu-wrapper"><div class="inactive-menu-item"><input type="hidden" class="inactive-menu-type" value="newmenu1" /><span>New Menu</span></div><a class="activate-menu-anchor">Activate Menu</a></div>
    <div class="inactive-menu-wrapper"><div class="inactive-menu-item"><input type="hidden" class="inactive-menu-type" value="newmenu2" /><span>New Menu</span></div><a class="activate-menu-anchor">Activate Menu</a></div>
	<div class="action-buttons-wrapper">
    <a id="myButton" class="large-btn red-bg" >Create Menu</a>
    <a class="large-btn gray-bg">Cancel</a>
	
</div>
	<?php } else { ?>

    <!-- I added This [Magdoub] -->
	<p class="preview-mainmenu-text-success">Modifiaction Request Sent Succefully. Someone from the Support Team will contact you soon. <a href="<?php echo base_url()?>shop/dashboard">Back to Dashboard</a> </p>
	<p class="preview-mainmenu-text">This is a Preview of your Main Menu, if you want to Edit your Main Menu please <a href="#">Contact Us</a> </p>
    <?php print_preview_menu($menu) ?>

	<!--    <?php print_menu($menu) ?> -->
<?php } ?>



</form>