<?php

/**
 * ShopsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ShopsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ShopsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Shops');
    }
    
    public static function getShops(){
        return Doctrine_Query::create()
                ->select('s.*, op.*, p.*, c.name, m.id, b.name, b.longitude, b.latitude, b.city, b.tel1, b.tel2, b.fax, b.email, b.main_img, col.name, pc.*, cf.*, bf.*, sbf.*, o.*, oc.*')
                ->from('Shops s, s.LookupShopCategories c, s.ShopMenuSubs m, s.ShopOnlinePresence op')
                ->leftJoin('m.ShopProducts p ON p.sub_id=m.id')
                ->leftJoin('m.ShopBranches b ON b.menu_id=m.id')
                ->leftJoin('b.LookupCollections col')
                ->leftJoin('b.BranchFilters bf, bf.ShopCategoryFilters sbf')
                ->leftJoin('p.ShopProductComponents pc')
                ->leftJoin('p.ShopCategoryFilters cf')
                ->leftJoin('m.ShopOffers o')
                ->leftJoin('o.ShopOfferComponents oc')
                ->where('s.deleted=0')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}