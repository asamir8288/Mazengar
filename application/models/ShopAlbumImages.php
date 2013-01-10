<?php

/**
 * ShopAlbumImages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ShopAlbumImages extends BaseShopAlbumImages
{
    public function addAlbumImage(array $data){
        $ai = new ShopAlbumImages();
        $ai->album_id = $data['album_id'];
        $ai->title = $data['title'];
        $ai->image = $data['main_img'];
        $ai->created_at = date('ymdHis');
        $ai->save();
    }
    
    public function deleteAlbumImage($id){
        Doctrine_Query::create()
                ->delete('ShopAlbumImages ai')
                ->where('ai.id =?', $id)
                ->execute();
    }
}