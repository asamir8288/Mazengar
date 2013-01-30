<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author Asamir
 */
class Product extends CI_Controller {

    var $data = array();
    static $user_info = array();

    function __construct() {
        parent::__construct();

        self::$user_info = $this->session->userdata('user_info');
    }

    function index() {
        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="' . site_url('product/manage_products') . '">Products</a></li>
                                   <li>/</li>
                                   <li><a href="#">Create New Product</a></li>';
        $this->data['page_title'] = 'Create New Product';
        $this->data['top_menu'] = loggedinMenu('create_product');
        $this->data['submit_url'] = site_url('product');

        if ($this->input->post('submit')) {
            $productData = $_POST;           
            $p = new ShopProducts();
            $p->addProduct($productData);

            redirect(site_url('product/manage_products'));
        }

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'products');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $this->data['currencies'] = LookupCurrenciesTable::getCurrencies();
        
        $s = new Shops();
        $category_id = $s->getShopCategoryId(self::$user_info['shop_id']);
        $this->data['filters'] = ShopCategoryFiltersTable::getCategoryFilters($category_id);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));        
        $this->template->add_js('layout/js/pages/products_offers.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/branches.js?' . $this->config->item('static_version'));

        $this->template->add_js('layout/js/jquery-ui.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));
		

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/jquery-ui.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/products_offers.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));
		
        $this->template->write_view('content', 'backend/product', $this->data);
        $this->template->render();
    }

    public function manage_products() {
        if($this->input->post('submit')){
            $order_products = $_POST;
            Global_Functions::rearrangeItems($order_products, 'ShopProducts', 'product_order');
            redirect(site_url('product/manage_products'));
        }
        
        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="#">Products</a></li>
                                   <li>/</li>
                                   <li><a href="#">Manage Products</a></li>';
        $this->data['page_title'] = 'Manage Products';
        $this->data['top_menu'] = loggedinMenu('manage_products');

        $info = session_data();
        $this->data['products'] = ShopProductsTable::getAllProducts($info['shop_id']);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/manage_products.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
        $this->template->write_view('content', 'backend/manage_products', $this->data);
        $this->template->render();
    }

    public function activate_deactivate($product_id) {
        $data = array();
        $sp = new ShopProducts();
        $data['status'] = $sp->activateDeactivate($product_id);
        echo json_encode($data);
    }

    public function delete_product($product_id) {
        $sp = new ShopProducts();
        $sp->deleteProduct($product_id);
        echo json_encode('success');
    }

    public function get_menu_subs($menuTopLevel = '') {
        if ($menuTopLevel) {
            $m = new ShopMenuSubs();
            $this->data['subMenuItems'] = $m->getSubMenuItems($menuTopLevel);
            $this->load->view('backend/lists/menu_list', $this->data);
        }
    }

    public function edit($id) {
        $isMine = Global_Functions::isMine($id, self::$user_info['shop_id'], 'ShopProducts');
        if ($isMine == false) {
            redirect(site_url('product/manage_products'));
        }

        $p = new ShopProducts();
        $this->data['data'] = $p->getOne($id);

        $this->data['product_menu'] = ShopMenuSubsTable::getProductMenu($this->data['data']['sub_id']);


        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="' . site_url('product/manage_products') . '">Products</a></li>
                                   <li>/</li>
                                   <li><a href="#">Create New Product</a></li>';
        $this->data['page_title'] = 'Create New Product';
        $this->data['top_menu'] = loggedinMenu('create_product');
        $this->data['submit_url'] = site_url('product/edit/' . $id);

        if ($this->input->post('submit')) {
            $productData = $_POST;
            $productData['prod_id'] = $id;
            $p = new ShopProducts();
            $p->updateProduct($productData);

            redirect(site_url('product/manage_products'));
        }

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'products');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $this->data['currencies'] = LookupCurrenciesTable::getCurrencies();
        
        $s = new Shops();
        $category_id = $s->getShopCategoryId(self::$user_info['shop_id']);
        $this->data['filters'] = ShopCategoryFiltersTable::getCategoryFilters($category_id);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));       
        

        $this->template->add_js('layout/js/jquery-ui.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/pages/products_offers.js?' . $this->config->item('static_version'));

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/jquery-ui.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/products_offers.css?' . $this->config->item('static_version'));
		$this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));
		

        $this->template->write_view('content', 'backend/product', $this->data);
        $this->template->render();
    }

}

?>
