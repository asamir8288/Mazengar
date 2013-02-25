<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of signup
 *
 * @author Asamir
 */
class Signup extends CI_Controller {

    var $data = array();

    function __construct() {
        parent::__construct();

        $this->template->set_template('guest');
    }

    public function index() {
        $this->data['submit_url'] = site_url('signup/index');
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Registeration</a></li>';
        $this->data['page_title'] = 'Sign up';
        $this->data['top_menu'] = setGuestMenuItemActive('signup');

        if ($this->input->post('submit')) {
            $posted_data = $_POST;

            //Check if the sub Domain is Exist
            $s = new Shops();
            if ($s->isSubDomainExist($posted_data['sub_domain'])) {
                redirect(site_url('signup'));
            }

            // add new shop data.
            $s = new Shops();
            $shop_id = $s->addShop($posted_data);

            // after adding the new shop return the Shop_id to add the new shop user.
            $u = new Users();
            $posted_data['is_primary_account'] = true;
            $posted_data['shop_id'] = $shop_id;
            $u->addUser($posted_data);

            // adding the shop online presence
            $o = new ShopOnlinePresence();
            $o->addOnlinePresence($posted_data);

            // login to the system and redirect user to shop dashboard
            Current_User::login($posted_data['email'], $posted_data['password']);

            redirect(site_url('shop/dashboard'));
        }

        $this->data['countries'] = LookupCountriesTable::listCountries(1);
        $this->data['shopCategories'] = LookupShopCategoriesTable::getAllShopCategories(1);

        $this->template->add_js('layout/js/site_url_global.js');
        $this->template->write_view('content', 'backend/registration', $this->data);
        $this->template->render();
    }

    public function check_sub_domain($subDomainName) {
        $s = new Shops();
        $data = $s->isSubDomainExist($subDomainName);

        echo json_encode($data);
    }

    public function forgot_password() {
        if ($this->input->post('submit')) {
            $incoded_email = rtrim(strtr(base64_encode($this->input->post('email')), '+/', '-_'), '=');

            $body = 'please press on the following URL to reset your password.';
            $body .= ' <a href="' . site_url('change-password/' . $incoded_email) . '">' . site_url('signup/change_password/' . $incoded_email) . '</a>';
            send_email('ahmed@dominosmedia.com', 'Forgot Password | Mazengar', $body);
        }

        $this->data['top_menu'] = setGuestMenuItemActive('');
        $this->data['submit_url'] = site_url('signup/forgot_password');
        $this->template->write_view('content', 'backend/forgot_password', $this->data);
        $this->template->render();
    }

    public function change_password($email) {
        if($this->input->post('submit')){
            $u = new Users();
            $u->updatePassword($this->input->post('email'), $this->input->post('new_password'));
            
            redirect(site_url('login'));
        }
        
        if ($email) {
            $decode_email = rtrim(base64_decode($email));
            $user = Doctrine::getTable('Users')->findOneByEmail($decode_email);
            if ($user) {

                $this->data['top_menu'] = setGuestMenuItemActive('');
                $this->data['submit_url'] = site_url('signup/change_password');
                $this->data['email'] = $decode_email;

                $this->template->write_view('content', 'backend/change_password', $this->data);
                $this->template->render();
            } else {
                redirect(site_url('login'));
            }
        } else {
            redirect(site_url('login'));
        }
    }

}

?>
