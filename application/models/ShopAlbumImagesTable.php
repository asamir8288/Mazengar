<?php

/**
 * ShopAlbumImagesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ShopAlbumImagesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ShopAlbumImagesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ShopAlbumImages');
    }
    
    public static function getAllAlbumImages($album_id){
        return Doctrine_Query::create()
                ->select('ai.*')
                ->from('ShopAlbumImages ai')
                ->where('ai.album_id =?', $album_id)
                ->orderBy('ai.img_order ASC')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}