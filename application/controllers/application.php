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

    public function getAlbums($shop_id) {
        $data = ShopAlbumsTable::getShopAlbumsImages($shop_id);
        echo json_encode($data);
//        pre_print($data);
    }

    public function shop_contacts($shop_id) {
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

    public function shop_menu($shop_id) {
        $menu_items = ShopMenuSubsTable::getShopMenu($shop_id);

        echo json_encode($menu_items);
    }

    public function get_shop_products($shop_id) {
        $data = ShopMenuSubsTable::getShopProducts($shop_id);
//        pre_print($data);
        echo json_encode($data);
    }

    public function get_shop_offers($shop_id) {
        $data = ShopOffersTable::getShopOffers($shop_id);
        echo json_encode($data);
    }

    public function get_shop_branches($shop_id) {
        $data = ShopBranchesTable::getShopBranches($shop_id);
        echo json_encode($data);
    }

    public function get_shop_aboutus($shop_id) {
        $data = ShopAboutUsTable::getAboutUsItems($shop_id);
        echo json_encode($data);
    }

    public function registration() {
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);

        $data = array();
        $data['name'] = $decoded['full_name'];
        $data['email'] = $decoded['email'];
        $data['password'] = $decoded['password'];
        $data['phone'] = $decoded['phone'];

        $r = new MobileRegistrations();
        $response = false;
        if (!$r->isEmailExist($decoded['email'])) {
            $register = $r->addRegistration($data);
            $response = $register;
        }

        echo json_encode($response);
    }

    public function login() {
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);

        $r = new MobileRegistrations();
        $logged_in = $r->isUserExist($decoded['email'], $decoded['password']);

        echo json_encode($logged_in);
    }

    public function basket_items() {
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);

        $r = new MobileRegistrations();
        $user_id = $r->getIdByEmail($decoded['email']);

        $b = new UserProductsBasket();

        foreach ($decoded['basket_items'] as $items) {
            $data = array();
            $data['user_id'] = $user_id;
            $data['product_id'] = $items['product_id'];
            $data['quantity'] = $items['amount'];

            $b->addUserProductToBasket($data);
        }

        echo json_encode(true);
    }

    public function rate_product() {
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, TRUE);

        $r = new MobileRegistrations();
        $user_id = $r->getIdByEmail($decoded['email']);

        $data = array();
        $data['user_id'] = $user_id;
        $data['product_id'] = $decoded['product_id'];
        $data['rating'] = $decoded['rating'];

        $r = new ProductRating();
        $r->rateProduct($data);

        echo json_encode(true);
    }

    public function request_rating() {
        $email = $_GET['email'];
        $shop_id = $_GET['shop_id'];
        $r = new ProductRating();
        $ratings = $r->getRatingByEmailAndShopId($email, $shop_id);

        echo json_encode($ratings);
    }

    public function test() {
//        send_email('ahmed@dominosmedia.com', 'Mazengar Email', 'hello');
//        $arabic = $this->is_arabic('test');
        var_dump($this->is_arabic('test'));
    }

    function is_arabic($str) {
        if (mb_detect_encoding($str) !== 'UTF-8') {
            $str = mb_convert_encoding($str, mb_detect_encoding($str), 'UTF-8');
        }

        /*
          $str = str_split($str); <- this function is not mb safe, it splits by bytes, not characters. we cannot use it
          $str = preg_split('//u',$str); <- this function woulrd probably work fine but there was a bug reported in some php version so it pslits by bytes and not chars as well
         */
        preg_match_all('/.|\n/u', $str, $matches);
        $chars = $matches[0];
        $arabic_count = 0;
        $latin_count = 0;
        $total_count = 0;
        foreach ($chars as $char) {
//$pos = ord($char); we cant use that, its not binary safe 
            $pos = $this->uniord($char);
//            echo $char . " --> " . $pos . PHP_EOL;

            if ($pos >= 1536 && $pos <= 1791) {
                $arabic_count++;
            } else if ($pos > 123 && $pos < 123) {
                $latin_count++;
            }
            $total_count++;
        }
        if (($arabic_count / $total_count) > 0.6) {
// 60% arabic chars, its probably arabic
            return true;
        }
        return false;
    }

    function uniord($u) {
        // i just copied this function fron the php.net comments, but it should work fine!
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));
        return $k2 * 256 + $k1;
    }

}

?>
