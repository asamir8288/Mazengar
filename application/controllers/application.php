<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of application
 *
 * @author Asamir
 */
class Application extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function json() {
        $data = ShopsTable::getShops();
        echo json_encode($data);
    }
    
    public function getAlbums($shop_id){
        $data = ShopAlbumsTable::getShopAlbumsImages($shop_id);
        echo json_encode($data);
//        pre_print($data);
    }
    
    public function shop_contacts($shop_id){
        $s = new Shops();
        $data = $s->getOne($shop_id);
        echo json_encode($data);
    }

    public function menu() {       
        $menu = ShopMenuSubsTable::getShopMenuItem($_GET['shop_id'], $_GET['item_id']);

        $i = 0;
        $collection_items = 'count=' . count($menu);
        foreach ($menu as $item) {
            $collection_items .= '&cat' . $i . '=' . $item['name'] . '&id' . $i . '=' . $item['id'] . '&';
            $i++;
        }
        pre_print($collection_items);
    }
    
    public function shop_menu($shop_id){
        $menu_items = ShopMenuSubsTable::getShopMenu($shop_id);       
        
         echo json_encode($menu_items);
    }
    
    public function get_shop_products($shop_id){
        $data = ShopMenuSubsTable::getShopProducts($shop_id);
//        pre_print($data);
        echo json_encode($data);
    }
    
    public function get_shop_offers($shop_id){
        $data = ShopOffersTable::getShopOffers($shop_id);
        echo json_encode($data);
    }
    
    public function get_shop_branches($shop_id){
        $data = ShopBranchesTable::getShopBranches($shop_id);        
        echo json_encode($data);
    }
    
    public function get_shop_aboutus($shop_id){
        $data = ShopAboutUsTable::getAboutUsItems($shop_id);        
        echo json_encode($data);
    }
    
    public function registration(){
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);
        
        $data = array();
        $data['name'] = $decoded['full_name'];
        $data['email'] = $decoded['email'];
        $data['password'] = $decoded['password'];
        $data['phone'] = $decoded['phone'];
        
        $r = new MobileRegistrations();
        $response = false;
        if(!$r->isEmailExist($decoded['email'])){
            $register = $r->addRegistration($data);
            $response = $register;
        }
        
        echo json_encode($response);              
    }
    
    public function login(){        
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);
        
        $r = new MobileRegistrations();
        $logged_in = $r->isUserExist($decoded['email'], $decoded['password']);
        
        echo json_encode($logged_in);
    }
    
    public function basket_items(){
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);
       
        $r = new MobileRegistrations();
        $user_id = $r->getIdByEmail($decoded['email']);                

        $b = new UserProductsBasket();
        
        foreach($decoded['basket_items'] as $items){
            $data = array();
            $data['user_id'] = $user_id;
            $data['product_id'] = $items['product_id'];
            $data['quantity'] = $items['amount'];
            
            $b->addUserProductToBasket($data);
        }
        
        echo json_encode(true);
    }
}

?>
