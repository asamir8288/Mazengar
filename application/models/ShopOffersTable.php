<?php

/**
 * ShopOffersTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ShopOffersTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ShopOffersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ShopOffers');
    }
    
     public static function getAllOffers($shop_id){
        return Doctrine_Query::create()
                ->select('so.*, m.id, s.id')
                ->from('ShopOffers so, so.ShopMenuSubs m, m.Shops s')
                ->where('s.id=?', $shop_id)
                ->andWhere('so.deleted=0')
                ->orderBy('so.offer_order ASC')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
    
    public static function getShopOffers($shop_id){
        return Doctrine_Query::create()
                ->select('so.*, soc.*, m.id, s.id')
                ->from('ShopOffers so, so.ShopOfferComponents soc, so.ShopMenuSubs m, m.Shops s')
                ->where('s.id=?', $shop_id)
                ->andWhere('so.deleted=0')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}