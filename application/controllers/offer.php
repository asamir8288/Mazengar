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
class Offer extends CI_Controller {

    var $data = array();
    static $user_info = array();

    function __construct() {
        parent::__construct();

        self::$user_info = $this->session->userdata('user_info');
    }

    function index() {
        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="' . site_url('offer/manage_offers') . '">Offers</a></li>
                                   <li>/</li>
                                   <li><a href="#">Create New Offer</a></li>';
        $this->data['page_title'] = 'Create New Offer';
        $this->data['top_menu'] = loggedinMenu('create_offer');
        $this->data['submit_url'] = site_url('offer');

        if ($this->input->post('submit')) {
            $offerData = $_POST;
            $o = new ShopOffers();
            $o->addOffer($offerData);

            redirect(site_url('offer/manage_offers'));
        }

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'offers');

        $this->data['menuTopLevel'] = $menuTopLevel;


        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));        
        $this->template->add_js('layout/js/pages/products_offers.js?' . $this->config->item('static_version'));

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

        $this->template->write_view('content', 'backend/offer', $this->data);
        $this->template->render();
    }

    public function manage_offers() {
        if($this->input->post('submit')){
            $order_offers = $_POST;
            Global_Functions::rearrangeItems($order_offers, 'ShopOffers', 'offer_order');
            redirect(site_url('offer/manage_offers'));
        }
        
        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="#">Offers</a></li>
                                   <li>/</li>
                                   <li><a href="#">Manage Offers</a></li>';
        $this->data['page_title'] = 'Manage Offers';
        $this->data['top_menu'] = loggedinMenu('manage_offers');

        $info = session_data();
        $this->data['offers'] = ShopOffersTable::getAllOffers($info['shop_id']);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/manage_offers.js?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
        $this->template->write_view('content', 'backend/manage_offers', $this->data);
        $this->template->render();
    }

    public function activate_deactivate($offer_id) {
        $data = array();
        $so = new ShopOffers();
        $data['status'] = $so->activateDeactivate($offer_id);
        echo json_encode($data);
    }

    public function delete_offer($offer_id) {
        $so = new ShopOffers();
        $so->deleteOffer($offer_id);
        echo json_encode('success');
    }

    function edit($id) {
        $isMine = Global_Functions::isMine($id, self::$user_info['shop_id'], 'ShopOffers');
        if ($isMine == false) {
            redirect(site_url('offer/manage_offers'));
        }

        $o = new ShopOffers();
        $this->data['data'] = $o->getOne($id);

        $this->data['offer_menu'] = ShopMenuSubsTable::getProductMenu($this->data['data']['sub_id']);


        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="' . site_url('offer/manage_offers') . '">Offers</a></li>
                                   <li>/</li>
                                   <li><a href="#">Create New Offer</a></li>';
        $this->data['page_title'] = 'Create New Offer';
        $this->data['top_menu'] = loggedinMenu('create_offer');
        $this->data['submit_url'] = site_url('offer/edit/' . $id);

        if ($this->input->post('submit')) {
            $offerData = $_POST;
            $offerData['offer_id'] = $id;
            $o = new ShopOffers();
            $o->updateOffer($offerData);

            redirect(site_url('offer/manage_offers'));
        }

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'offers');

        $this->data['menuTopLevel'] = $menuTopLevel;


        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));        
        $this->template->add_js('layout/js/pages/products_offers.js?' . $this->config->item('static_version'));

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

        $this->template->write_view('content', 'backend/offer', $this->data);
        $this->template->render();
    }

}

?>
