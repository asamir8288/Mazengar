<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of site
 *
 * @author Asamir
 */
class Site extends CI_Controller {

    var $data = array();

    function __construct() {
        parent::__construct();

        $this->template->set_template('mazengar');
    }
    
    public function index(){
        $this->data['page_title'] = 'Home page';
        $this->data['menu'] = array(1, 0, 0, 0, 0);
        
        $this->template->add_css('layout/css/colorbox.css');
        
        $this->template->add_js('layout/js/carousel/jquery.carouFredSel-6.1.0-packed.js');
        $this->template->add_js('layout/js/carousel/jquery.mousewheel.min.js');
        $this->template->add_js('layout/js/carousel/jquery.ba-throttle-debounce.min.js');        
        $this->template->add_js('layout/js/jquery.colorbox.js');
        $this->template->write_view('content', 'frontend/home', $this->data);
        $this->template->render();
    }
    
    public function about_us() {        
        $this->data['page_title'] = 'About Us';
        $this->data['menu'] = array(0, 1, 0, 0, 0);
        $this->template->write_view('content', 'frontend/about_us', $this->data);
        $this->template->render();
    }
    
    public function merchant() {        
        $this->data['page_title'] = 'Merchant';
        $this->data['menu'] = array(0, 0, 0, 1, 0);
        $this->template->write_view('content', 'frontend/merchant', $this->data);
        $this->template->render();
    }
    
    public function contact_us(){
        $this->data['page_title'] = 'Contact us';
        $this->data['menu'] = array(0, 0, 0, 0, 1);
        $this->template->write_view('content', 'frontend/contact_us', $this->data);
        $this->template->render();
    }
    
    public function partners(){
        $this->data['page_title'] = 'Partners';
        $this->data['menu'] = array(0, 0, 1, 0, 0);
        $this->template->write_view('content', 'frontend/partners', $this->data);
        $this->template->render();
    }

    public function privacy_policy(){
        $this->data['page_title'] = 'Privacy Policy';
        $this->data['menu'] = array(0, 0, 0, 0, 0);
        $this->template->write_view('content', 'frontend/privacy_policy', $this->data);
        $this->template->render();
    }

    public function terms_conditions(){
        $this->data['page_title'] = 'Terms Conditions';
        $this->data['menu'] = array(0, 0, 0, 0, 0);
        $this->template->write_view('content', 'frontend/terms_conditions', $this->data);
        $this->template->render();
    }
}

?>
