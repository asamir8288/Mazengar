<?php

function static_url() {
    $CI = & get_instance();
    return $CI->config->item('static_url');
}

function static_path() {
    $CI = & get_instance();
    return $CI->config->item('static_path');
}

function session_data() {
    $CI = & get_instance();
    return $CI->session->userdata('user_info');
}

function pre_print($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit;
}

function setGuestMenuItemActive($active_menu) {
    $html = '<li class="menu-header-separator"></li>';
    if ($active_menu == 'about_us') {
        $html .= '<li class="menu-header-item active-menu-item"><a class="red-menu-item" href="'. site_url('about-us') .'">ABOUT US</a></li>';
    } else {
        $html .= '<li class="menu-header-item"><a href="'. site_url('about-us') .'">ABOUT US</a></li>';
    }

    if ($active_menu == 'how_it_works') {
        $html .= '<li class="menu-header-item active-menu-item"><a class="red-menu-item" href="#">HOW IT WORKS</a></li>';
    } else {
        $html .= '<li class="menu-header-item"><a href="#">HOW IT WORKS</a></li>';
    }

    if ($active_menu == 'contact_us') {
        $html .= '<li class="menu-header-item active-menu-item"><a class="red-menu-item" href="'. site_url('contact-us') .'">CONTACT US</a></li>';
    } else {
        $html .= '<li class="menu-header-item"><a href="'. site_url('contact-us') .'">CONTACT US</a></li>';
    }

    $html .= '<li class="menu-header-separator"></li>';
    $html .= '<div style="float:right">';
    $html .= '<li class="menu-header-separator"></li>';

    if ($active_menu == 'login') {
        $html .= '<li class="menu-header-item active-menu-item"><a class="red-menu-item" href="' . site_url() . 'login">SIGN IN</a></li>';
    } else {
        $html .= '<li class="menu-header-item"><a href="' . site_url() . 'login">SIGN IN</a></li>';
    }

    $html .= '<li class="menu-header-separator"></li>';
    if ($active_menu == 'signup') {
        $html .= '<li class="menu-header-item active-menu-item"><a class="red-menu-item" href="' . site_url() . 'signup">SIGNUP</a></li>';
    } else {
        $html .= '<li class="menu-header-item"><a href="' . site_url() . 'signup">SIGNUP</a></li>';
    }

    $html .= '<li class="menu-header-separator"></li>';
    $html .= '</div>';

    return $html;
}

function loggedinMenu($activeItem) {
    $CI = & get_instance();
    $user_info = $CI->session->userdata('user_info');

    $html = '<li class="menu-header-separator"></li>';
    if ($activeItem == 'dashboard') {
        $html .= '<li class="menu-header-item active-menu-item"><a class="red-menu-item" href="' . site_url() . 'shop/dashboard">DASHBOARD</a></li>';
    } else {
        $html .= '<li class="menu-header-item"><a href="' . site_url() . 'shop/dashboard">DASHBOARD</a></li>';
    }

    $html .= '<li class="menu-header-separator"></li>';

    if ($activeItem == 'create_product' || $activeItem == 'manage_products') {
        $html .= '<li class="more-menu menu-header-item active-menu-item"><a class="red-menu-item" href="#">PRODUCTS <span class="more-menu-arrow"></span></a>';
    } else {
        $html .= '<li class="more-menu menu-header-item"><a href="#">PRODUCTS <span class="more-menu-arrow"></span></a>';
    }

    $html .= '<ul class="menu-dropdown-wrapper" style="">                                
                <div class="menu-dropdown-items">									
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="' . site_url('product') . '">Create New Product</a></li>
                    <li class="dropdown-menu-separator"></li>
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="' . site_url('product/manage_products') . '">Manage Products</a></li>
                </div>
            </ul>
          </li>';

    $html .= '<li class="menu-header-separator"></li>';
    if ($activeItem == 'create_offer' || $activeItem == 'manage_offers') {
        $html .= '<li class="more-menu menu-header-item active-menu-item"><a class="red-menu-item" href="#">OFFERS  <span class="more-menu-arrow"></span></a>';
    } else {
        $html .= '<li class="more-menu menu-header-item"><a href="#">OFFERS  <span class="more-menu-arrow"></span></a>';
    }
    $html .= '<ul class="menu-dropdown-wrapper" style="">
                <div class="menu-dropdown-items">									
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="' . site_url('offer') . '">Create New Offer</a></li>
                    <li class="dropdown-menu-separator"></li>
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="' . site_url('offer/manage_offers') . '">Manage Offers</a></li>
                </div>
            </ul>
        </li>';

    $html .= '<li class="menu-header-separator"></li>';
    $html .= '<div style="float:right;"><li class="menu-header-separator"></li>';
    $s = new Shops();
        $logo = $s->getLogo($user_info['shop_id']);
        $logo_img = 'layout/images/user-image.png';
        if(!is_null($logo) && !empty($logo))
            $logo_img = 'uploads/' . $logo;
    if ($activeItem == 'edit_account' || $activeItem == 'help') {        
        $html .= '<li class="more-menu menu-header-item" active-menu-item><img class="user-image-menu" src="' . $CI->config->item('static_url') . $logo_img .'" /><a class="red-menu-item" href="#">ME  <span class="more-menu-arrow"></span></a>';
    } else {
        $html .= '<li class="more-menu menu-header-item"><img class="user-image-menu" src="' . $CI->config->item('static_url') . $logo_img .'" /><a href="#">ME  <span class="more-menu-arrow"></span></a>';
    }

    $html .= '<ul class="menu-dropdown-wrapper" style="">
                <div class="menu-dropdown-items">
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="'. site_url('shop/edit_account') .'">Edit My Account</a></li>
                    <li class="dropdown-menu-separator"></li>
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="#">Help</a></li>									
                    <li class="dropdown-menu-separator"></li>
                    <li class="dropdown-menu-list"><a class="dropdown-menu-anchor" href="' . site_url('login/logout') . '">Log Out</a></li>
                </div>
            </ul>';

    $html .= '</li>';
    $html .= '<li class="menu-header-separator"></li>';
    $html .= '</div>';

    return $html;
}

function product_menu($menu_id, $sub_id) {
    $CI = & get_instance();

    $m = new ShopMenuSubs();
    $menu_items = $m->getSubMenuItems($menu_id);

    $html = '<select class="custom-select shopcategory" required="required" name="shopcategory">
        <option value="" selected="">Select</option>';
    foreach ($menu_items as $menu) {
        if($menu['id'] == $sub_id){
            $html .= '<option value="' . $menu['id'] . '" selected="selected">' . $menu['name'] . '</option>';
        }else{
            $html .= '<option value="' . $menu['id'] . '">' . $menu['name'] . '</option>';
        }
    }
    $html .= '</select>';
    
    return $html;
}