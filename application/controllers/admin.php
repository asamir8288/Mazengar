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
    
    public function delete_shop($shop_id){
        ProductRatingTable::hardDeleteProductsRatings($shop_id);
        
        $pc = new ShopProductComponents();
        $pc->hardDeleteProductsComponents($shop_id);
        
        $p = new ShopProducts();
        $p->hardDeleteProducts($shop_id);
        
        $po = new ShopOfferComponents();
        $po->hardDeleteOffersComponents($shop_id);
        
        $o = new ShopOffers();
        $o->hardDeleteOffers($shop_id);
    }
}

?>
