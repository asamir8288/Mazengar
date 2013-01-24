<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Asamir
 */
class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    public function delete_shop(){
        $pc = new ShopProductComponents();
        $pc->hardDeleteProductsComponents(21);
        
        $p = new ShopProducts();
        $p->hardDeleteProducts(21);
        
        $po = new ShopOfferComponents();
        $po->hardDeleteOffersComponents(21);
        
        $o = new ShopOffers();
        $o->hardDeleteOffers(21);
    }
}

?>
