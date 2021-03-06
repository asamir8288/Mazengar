<?php

/**
 * LookupCollectionsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LookupCollectionsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LookupCollectionsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('LookupCollections');
    }
    
    public static function getCollections($governate_id){
        return Doctrine_Query::create()
                ->select('c.*')
                ->from('LookupCollections c')
                ->where('c.governate_id =?', $governate_id)
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}