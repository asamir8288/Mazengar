<?php

class Global_Functions extends CI_Model {

    public static function isMine($id = '', $shop_id, $model) {
        $q = Doctrine_Query::create()
                ->select('COUNT(i.id) as counts')
                ->from($model . ' i, i.ShopMenuSubs m')
                ->where('m.shop_id=?', $shop_id)
                ->andWhere('i.id=?', $id)
                ->fetchOne();

        if ($q['counts'] > 0)
            return true;
        return false;
    }

    public static function rearrangeItems(array $items, $model, $filed_name) {
        $i = 0;
        foreach ($items['rank'] as $item) {
            Doctrine_Query::create()->update("$model")
                    ->set("$filed_name", '?', $i)
                    ->where('id=?', $item)
                    ->execute();
            $i++;
        }
    }

}

?>
