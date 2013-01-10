<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author Asamir
 */
class Menu extends CI_Controller {

    var $data = array();
    var $user_info = array();

    function __construct() {
        parent::__construct();

        $this->user_info = $this->session->userdata('user_info');
    }

    public function index($shop_id = '') {
        if ($shop_id == '') {
            $shop_id = $this->user_info['shop_id'];
        }
        $this->data['submit_url'] = site_url('menu');
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="' . site_url() . 'shop/dashboard">Dashboard</a></li>
                                    <li>/</li>
                                    <li><a href="#">Manage Main Menu</a></li>';
        $this->data['top_menu'] = loggedinMenu('');

        if ($_POST) {
            ShopMenuSubsTable::saveShopMenu($_POST['menu'], $shop_id);
            $this->data['menu'] = ShopMenuSubsTable::getShopMenu($shop_id); 
            redirect(site_url('shop/dashboard'));
        } else {
            $this->data['menu'] = ShopMenuSubsTable::getShopMenu($shop_id);
        }
        
        $this->template->add_css('layout/css/mainmenu.css');
        $this->template->add_css('layout/css/reveal.css');
        $this->template->add_css('layout/css/uploadify.css');                
        
        $this->template->add_js('layout/js/site_url_global.js');
        $this->template->add_js('layout/js/jquery-ui.js');
        $this->template->add_js('layout/js/jquery.reveal.js');
        $this->template->add_js('layout/js/swfobject.js');
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js');
        $this->template->add_js('layout/js/jquery.livequery.js');
        $this->template->add_js('layout/js/pages/menu.js');
        
        $this->template->write_view('content', 'backend/manage_menu', $this->data);
        $this->template->render();
    }
    
    public function get_shop_products($shop_id){
//        echo '<pre>';
        $data = ShopMenuSubsTable::getShopProducts($shop_id);
//        print_r(ShopMenuSubsTable::getShopProducts($shop_id));
        echo json_encode($data);
    }

}

?>
