<?php

function print_menu(array $menu) {
    foreach ($menu as $key => $value) {
        ?>
        <div class="mainmenu-item-wrapper">
            <?php if ($key == 0) { ?>
                <img class="mainmenu-image" src="<?php echo base_url().$value['img'] ?>" /> 
        <?php } else { ?>
            <img class="mainmenu-image" src="<?php echo base_url() . $value['img'] ?>" />
        <?php } ?>
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="hidden" class="menu-type" value="<?php echo $value['type'] ?>"/>
            <input type="text" maxlength="15" title="Edit" class="mainmenu-name" value="<?php echo $value['name'] ?>"/>
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
        <?php if (isset($value['ShopMenuSubs'])) {
            print_sub_menu($value['ShopMenuSubs']);
        } ?>

        </div>
        <?php
    }
}

function print_sub_menu(array $submenu) {
    ?>
    <div class="submenu-item-container">
    <?php foreach ($submenu as $key => $value) { ?>
            <div class="submenu-item-wrapper <?php echo ($key == 0) ? 'first-submenu-item' : '' ?>">
                <img class="mainmenu-image" src="<?php echo base_url() .$value['img'] ?>" />
                <div class="mainmenu-item">
                    <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
                    <input type="text" maxlength="15" title="Edit" class="mainmenu-name" value="<?php echo $value['name'] ?>"/>
                    <ul class="mainmenu-icons-list">									
                        <li class="mainmenu-icon open-image-icon" title="Add Image" ></li>
                        <li class="mainmenu-list-seperator"></li>
                        <li class="mainmenu-icon add-submenu-icon" title="Add Sub-Menu" ></li>
                        <li class="mainmenu-list-seperator"></li>
                        <li class="mainmenu-icon delete-menu-icon" title="Delete Menu"></li>

                    </ul>

                </div>
  
            <?php if (isset($value['ShopMenuSubs']) && $value['ShopMenuSubs']) {
                print_sub_menu($value['ShopMenuSubs']);
            } ?>
            </div>
    <?php } ?>

    </div>
    <?php
}




function print_preview_menu(array $menu) {
    foreach ($menu as $key => $value) {
        ?>
        <div class="mainmenu-item-wrapper">
            <?php if ($key == 0) { ?>
                <img class="mainmenu-image" src="<?php echo base_url().$value['img'] ?>" /> 
        <?php } else { ?>
            <img class="mainmenu-image" src="<?php echo base_url() . $value['img'] ?>" />
        <?php } ?>
        <div class="mainmenu-item">
            <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
            <input type="hidden" class="menu-type" value="<?php echo $value['type'] ?>"/>
            <input type="text" maxlength="15" readonly="readonly"class="mainmenu-name" value="<?php echo $value['name'] ?>"/>

        </div>

        <?php if (isset($value['ShopMenuSubs'])) {
            print_preview_sub_menu($value['ShopMenuSubs']);
        } ?>

        </div>
        <?php
    }
}


function print_preview_sub_menu(array $submenu) {
    ?>
    <div class="submenu-item-container">
    <?php foreach ($submenu as $key => $value) { ?>
            <div class="submenu-item-wrapper <?php echo ($key == 0) ? 'first-submenu-item' : '' ?>">
                <img class="mainmenu-image" src="<?php echo base_url() .$value['img'] ?>" />
                <div class="mainmenu-item">
                    <img src="<?php echo base_url() . 'layout' ?>/images/cleardot.gif" alt="">
                    <input type="text" maxlength="15" readonly="readonly" class="mainmenu-name" value="<?php echo $value['name'] ?>"/>

                </div>
   
            <?php if (isset($value['ShopMenuSubs']) && $value['ShopMenuSubs']) {
                print_preview_sub_menu($value['ShopMenuSubs']);
            } ?>
            </div>
    <?php } ?>

    </div>
    <?php
}

?>



