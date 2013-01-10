<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acl
 *
 * @author Ahmed Samir
 */
class ACL {

    function is_allowed() {
        $CI = & get_instance();
        $user_info = $CI->session->userdata('user_info');

        $public_pages = array('application', 'about-us', 'merchant', 'site', 'contact-us');
        if (!in_array($CI->uri->segment(1), $public_pages)) {
            if (!$user_info) {
                if ($CI->uri->segment(1) != '' && $CI->uri->segment(1) != 'signup' && $CI->uri->segment(1) != 'login') {
                    redirect(site_url('/'));
                }
            } else {
                if ($CI->uri->segment(1) == 'login' && $CI->uri->segment(2) != 'logout') {
                    if ($CI->uri->segment(1) == '' || $CI->uri->segment(1) == 'signup' || $CI->uri->segment(1) == 'login') {
                        redirect(site_url('shop/dashboard'));
                    }
                }
            }
        }
    }

}

?>
