<?php

/**
 * ShopMenuSubs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ShopMenuSubs extends BaseShopMenuSubs {

    public function getMenuLevelOne($shop_id, $menu_name) {
        $top_level = Doctrine_Query::create()
                ->select('id')
                ->from('ShopMenuSubs m')
                ->where('m.type=?', $menu_name)
                ->andWhere('m.shop_id=?', $shop_id)
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->fetchOne();
        return $top_level['id'];
    }
    
    public function getSubMenuItems($item_id){
        var_dump($item_id);exit;
        return Doctrine_Query::create()
                ->select('id, name')
                ->from('ShopMenuSubs m')
                ->andWhere('m.related_to=?', $item_id)
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }

}