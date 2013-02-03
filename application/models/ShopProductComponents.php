<?php

/**
 * ShopProductComponents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ShopProductComponents extends BaseShopProductComponents
{
    public function addProdComponents(array $componentsdata){
        $pc = new ShopProductComponents();
        $pc->product_id = $componentsdata['product_id'];
        $pc->item = $componentsdata['item'];
        $pc->product_order = $componentsdata['product_order'];
        $pc->type = $componentsdata['type'];
        $pc->caption = $componentsdata['caption'];
        $pc->created_at = date('ymdHis');
        $pc->save();
    }
    
     public function hardDeleteProductsComponents($shop_id){
        Doctrine_Query::create()
                ->delete('ShopProductComponents pc')
                ->where('pc.product_id IN (SELECT p.id FROM ShopProducts p INNER JOIN p.ShopMenuSubs ms WHERE ms.shop_id='. $shop_id .')')
                ->execute();
    }
}