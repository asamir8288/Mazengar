<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of about_us
 *
 * @author Asamir
 */
class About_us extends CI_Controller {

    var $data = array();
    static $user_info = array();

    function __construct() {
        parent::__construct();
        
        self::$user_info = $this->session->userdata('user_info');
    }

    public function index() {
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">About Us</a></li>';
        $this->data['page_title'] = 'About Us';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['submit_url'] = site_url('about_us');

        if ($this->input->post('submit')) {
            $posted_data = $_POST;

            $a = new ShopAboutUs();
            $a->addAboutUs($posted_data);
            
            redirect(site_url('about_us'));
        }
        
        $this->data['editable_items'] = ShopAboutUsTable::getAboutUsItems(self::$user_info['shop_id']);
        
        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'about-us');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/about_us', $this->data);
        $this->template->render();
    }
    
    public function edit($id = ''){
        $isMine = Global_Functions::isMine($id, self::$user_info['shop_id'], 'ShopAboutUs');
        if ($isMine == false) {
            redirect(site_url('about_us'));
        }

        $a = new ShopAboutUs();
        $this->data['data'] = $a->getOne($id);

        $this->data['about_us_menu'] = ShopMenuSubsTable::getProductMenu($this->data['data']['sub_id']);
        
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Edit About Us</a></li>';
        $this->data['page_title'] = 'Edit About Us';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['submit_url'] = site_url('about_us/edit/' . $id);

        if ($this->input->post('submit')) {
            $posted_data = $_POST;
            $posted_data['about_us_id'] = $id;

            $a = new ShopAboutUs();
            $a->updateAboutUs($posted_data);
            
            redirect(site_url('about_us'));
        }
        
        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'about-us');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/about_us', $this->data);
        $this->template->render();
    }

}

?>
