<?php

/**
 * LookupShopCategoriesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LookupShopCategoriesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LookupShopCategoriesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('LookupShopCategories');
    }
    
    public static function getAllShopCategories($lang_id){
        return Doctrine_Query::create()
                ->select('sc.*')
                ->from('LookupShopCategories sc')
                ->where('sc.lang_id=?', $lang_id)
                ->orderBy('sc.name ASC')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}