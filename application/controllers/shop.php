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
    
    public function add_logo($logo){
        $s = new Shops();
        $s->updateLogo(self::$user_info['shop_id'], $logo);
        
        echo json_encode('success');
    }

}

?>
