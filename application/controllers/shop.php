<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shop
 *
 * @author Asamir
 */
class Shop extends CI_Controller {

    var $data = array();
    static $user_info = array();

    function __construct() {
        parent::__construct();

        self::$user_info = $this->session->userdata('user_info');
    }

    public function dashboard() {
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Dashboard</a></li>';
        $this->data['page_title'] = 'Dashboard';
        $this->data['top_menu'] = loggedinMenu('dashboard');

        $s = new Shops();
        $this->data['shop_details'] = $s->getOne(self::$user_info['shop_id']);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery-ui.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));


        $this->template->add_css('layout/css/jquery-ui.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/dashboard.css?' . $this->config->item('static_version'));


        //I added this [Magdoub]
        $this->template->add_js('layout/js/jquery.cookie.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/modernizr.mq.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.joyride-2.0.2.js?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/joyride-2.0.2.css?' . $this->config->item('static_version'));

        $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/dashboard', $this->data);
        $this->template->render();
    }

    public function add_logo($logo) {
        $s = new Shops();
        $s->updateLogo(self::$user_info['shop_id'], $logo);

        echo json_encode('success');
    }

    public function edit_account() {
        $s = new Shops();
        
        if($this->input->post('submit')){
            $posted_data = $_POST;
            $posted_data['shop_id'] = self::$user_info['shop_id'];            
            $s->updateShop($posted_data);
            
            $u = new Users();
            $posted_data['user_id'] = self::$user_info['user_id'];
            $u->updateUser($posted_data);
            redirect(site_url('shop/dashboard'));
        }
                
        $this->data['data'] = $s->getShopAndUserAccount(self::$user_info['shop_id']);

        $this->data['submit_url'] = site_url('shop/edit_account');
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Update Account</a></li>';
        $this->data['page_title'] = 'Update Account';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['countries'] = LookupCountriesTable::listCountries(1);
        $this->data['shopCategories'] = LookupShopCategoriesTable::getAllShopCategories(1);

        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'backend/edit_account', $this->data);
        $this->template->render();
    }
    
    public function shopping_data($offset = 0){
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Shopping Data</a></li>';
        $this->data['page_title'] = 'Shopping Data';
        
        $per_page = 20;
        $this->data['shopping_products'] = UserProductsBasketTable::getUserProductsBasket(self::$user_info['shop_id'], $offset, $per_page);        
        $total_rows = UserProductsBasketTable::getCountUserProductsBasket(self::$user_info['shop_id']);
        $this->data['pagination'] = $this->make_pagination($total_rows, $per_page, 'shop/shopping_data');
        
        $this->template->add_css('layout/css/states-table.css');
        $this->template->write_view('content', 'backend/states/shopping_data', $this->data);
        $this->template->render();
    }
    
    public function rating($offset = 0){
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Rating Data</a></li>';
        $this->data['page_title'] = 'Rating Data';
        
        $per_page = 20;
        $this->data['rating_products'] = ProductRatingTable::getProductRating(self::$user_info['shop_id'], $offset, $per_page);
        $total_rows = ProductRatingTable::getCountroductRatings(self::$user_info['shop_id']);
        $this->data['pagination'] = $this->make_pagination($total_rows, $per_page, 'shop/rating');
        
        $this->template->add_css('layout/css/states-table.css');
        $this->template->write_view('content', 'backend/states/rating_data', $this->data);
        $this->template->render();
    }
    
    public function registrations($offset = 0){
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Users Data</a></li>';
        $this->data['page_title'] = 'Users Data';
        
        $per_page = 20;
        $this->data['registrations'] = MobileRegistrationsTable::getRegistrations(self::$user_info['shop_id'], $offset, $per_page);
        $total_rows = MobileRegistrationsTable::getCountRegistrations(self::$user_info['shop_id']);
        $this->data['pagination'] = $this->make_pagination($total_rows, $per_page, 'shop/registrations');
        
        $this->template->add_css('layout/css/states-table.css');
        $this->template->write_view('content', 'backend/states/users_data', $this->data);
        $this->template->render();
    }
    
    public function deliver_order($order_id){
        $b = new UserProductsBasket();
        $b->updateStatus($order_id, 1);
        redirect(site_url('shop/shopping_data'));
    }
    
    public function cancel_order($order_id){
        $b = new UserProductsBasket();
        $b->updateStatus($order_id, 2);
        redirect(site_url('shop/shopping_data'));
    }
    
    private function make_pagination($total_rows, $per_page, $url) {
        if ($total_rows > $per_page) {            

            $config['base_url'] = site_url($url);
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 3;
            $config['num_links'] = 4;            

            $this->pagination->initialize($config);
            return $this->pagination->create_links();
        }
    }

}

?>
