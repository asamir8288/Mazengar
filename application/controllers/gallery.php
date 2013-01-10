<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gallery
 *
 * @author Asamir
 */
class Gallery extends CI_Controller {

    var $data = array();
    static $user_info = array();

    function __construct() {
        parent::__construct();

        self::$user_info = $this->session->userdata('user_info');
    }

    public function index() {
        
    }

    public function create() {
        if ($this->input->post('submit')) {
            $posted_data = $_POST;
            $a = new ShopAlbums();
            $a->addAlbum($posted_data);

            redirect(site_url('gallery/manage_albums'));
        }

        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Create New Album</a></li>';
        $this->data['page_title'] = 'Create New Album';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['submit_url'] = site_url('gallery/create');

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'gallery');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));

        $this->template->add_js('layout/js/jquery-ui.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/gallery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/jquery-ui.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/gallery/add_edit_album', $this->data);
        $this->template->render();
    }

    public function edit($id) {
        if ($this->input->post('submit')) {
            $posted_data = $_POST;
            $posted_data['album_id'] = $id;
            $a = new ShopAlbums();
            $a->updateAlbum($posted_data);

            redirect(site_url('gallery/manage_albums'));
        }

        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Edit Album</a></li>';
        $this->data['page_title'] = 'Create New Album';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['submit_url'] = site_url('gallery/edit/' . $id);

        $a = new ShopAlbums();
        $this->data['data'] = $a->getOne($id);

        $this->data['gallery_menu'] = ShopMenuSubsTable::getProductMenu($this->data['data']['sub_id']);

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'gallery');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));

        $this->template->add_js('layout/js/jquery-ui.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/gallery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/jquery-ui.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));
		$this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
        $this->template->write_view('content', 'backend/gallery/add_edit_album', $this->data);
        $this->template->render();
    }

    public function manage_albums() {
        if($this->input->post('submit')){
            $order_albums = $_POST;
            Global_Functions::rearrangeItems($order_albums, 'ShopAlbums', 'album_order');
            redirect(site_url('gallery/manage_albums'));
        }
        
        
        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="#">Gallery</a></li>
                                   <li>/</li>
                                   <li><a href="#">Manage Albums</a></li>';
        $this->data['page_title'] = 'Manage Albums';
        $this->data['top_menu'] = loggedinMenu('');

        $info = session_data();
        $this->data['albums'] = ShopAlbumsTable::getAllAlbums(self::$user_info['shop_id']);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/manage_albums.js?' . $this->config->item('static_version'));
	$this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
        $this->template->write_view('content', 'backend/gallery/manage_albums', $this->data);
        $this->template->render();
    }

    public function activate_deactivate($album_id) {
        $data = array();
        $a = new ShopAlbums();
        $data['status'] = $a->activateDeactivate($album_id);
        echo json_encode($data);
    }

    public function delete_album($album_id) {
        $a = new ShopAlbums();
        $a->deleteAlbum($album_id);
        echo json_encode('success');
    }

    public function album_images($album_id) {
        if ($album_id) {
            if ($this->input->post('submit')) {
                $posted_data = $_POST;
                $posted_data['album_id'] = $album_id;
                $ai = new ShopAlbumImages();
                $ai->addAlbumImage($posted_data);

                redirect(site_url('gallery/album_images/' . $album_id));
            }

            $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Add Albums Images</a></li>';
            $this->data['page_title'] = 'Add Album Images';
            $this->data['top_menu'] = loggedinMenu('');
            $this->data['submit_url'] = site_url('gallery/album_images/' . $album_id);

            $this->data['albumImages'] = ShopAlbumImagesTable::getAllAlbumImages($album_id);

            $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));

            $this->template->add_js('layout/js/jquery-ui.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/pages/gallery.js?' . $this->config->item('static_version'));
            $this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));

            $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
            $this->template->add_css('layout/css/jquery-ui.css?' . $this->config->item('static_version'));
            $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
            $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));
			
            $this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));

            $this->template->write_view('content', 'backend/gallery/album_images', $this->data);
            $this->template->render();
        } else {
            redirect(site_url('gallery/manage_albums'));
        }
    }

    public function delete_album_image($id, $album_id) {
        $ai = new ShopAlbumImages();
        $ai->deleteAlbumImage($id);

        redirect(site_url('gallery/album_images/' . $album_id));
    }
    
    public function arrange_images($album_id){
         if($this->input->post('submit')){
            $order_album_images = $_POST;
            Global_Functions::rearrangeItems($order_album_images, 'ShopAlbumImages', 'img_order');
            redirect(site_url('gallery/album_images/' . $album_id));
        }
    }

}

?>
