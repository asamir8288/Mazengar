<?php

/**
 * ShopMenuSubsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ShopMenuSubsTable extends Doctrine_Table {

    static $shop_id;

    /**
     * Returns an instance of this class.
     *
     * @return object ShopMenuSubsTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('ShopMenuSubs');
    }

    public static function saveShopMenu($menu, $shop_id) {
        self::$shop_id = $shop_id;
        Doctrine_Query::create()
                ->delete('ShopMenuSubs')
                ->where('shop_id=?', $shop_id)
                ->execute();
        self::traverse($menu, 1, null);
    }

    /**
     *
     * @param array $menu
     * @param type $level
     * @param type $parent_id parent id in database
     */
    static function traverse(array $menu, $level, $parent_id) {
        foreach ($menu as $key => $value) {
            $sub = array();
            if (isset($value['sub']))
                $sub = $value['sub'];
            unset($value['sub']);
            $this_id = self::saveItem(
                            $value
                            , $parent_id, $level);
//            $this_id = $parent_id . "[sub][$key]";
            if ($sub) {
                self::traverse($sub, $level + 1, $this_id);
            }
        }
    }

    static function saveItem($data, $parent_id, $level) {
//        echo "Saving menu '$data' with index $parent_id on level $level <br>";

        $menu = new ShopMenuSubs();
        $menu->shop_id = self::$shop_id;
        $menu->name = $data['name'];
        if (isset($data['type']))
            $menu->type = $data['type'];
        if (isset($data['img']) && $data['img'] != 'undefined')
            $menu->img = trim(array_pop(explode(base_url(), $data['img'])), '/');
        if ($parent_id) {
            $menu->related_to = $parent_id;
        }
        $menu->level = $level;
        $menu->created_at = date('ymdHis');
        $menu->updated_at = date('ymdHis');

        $menu->save();
        return $menu->id;
    }

    static function getShopMenu($shop_id) {
        $q = new Doctrine_RawSql();
        $array = self::buildQuery($q, $shop_id);
        $q->select(implode(',', $array['select']));
        return ($q->execute());
    }

    public static function buildQuery(Doctrine_RawSql &$q, $shop_id) {
        $max_level = array_shift(Doctrine_Query::
                        create()->from('ShopMenuSubs')
                        ->select('MAX(level)')
                        ->where('shop_id=?', $shop_id)
                        ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                        ->fetchOne());

        $select[] = ('{s1.*}');
        $q->addComponent('s1', 'ShopMenuSubs s1');
        $q->from('
            (select * from shop_menu_subs where shop_id="' . $shop_id . '" AND level=1) s1
            ');

        for ($i = 2; $i <= $max_level; $i++) {
            $select[] = ('{s' . $i . '.*}');
            $q->addComponent('s' . $i, 's' . ($i - 1) . '.ShopMenuSubs s' . $i);
            $q->addFrom('
            left join 
            (select * from shop_menu_subs where shop_id="' . $shop_id . '" AND level=' . $i . ') s' . $i . '
            ON s' . ($i - 1) . '.id=s' . $i . '.related_to
            ');
        }

        $q->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

        return array("max_level" => $max_level, "select" => $select);
    }

    static function getShopProducts($shop_id) {
        $q = new Doctrine_RawSql();
        $array = self::buildQuery($q, $shop_id);

        for ($i = 1; $i <= $array['max_level']; $i++) {
            $q->addFrom('
                    LEFT JOIN shop_products sp' . $i . ' ON s' . $i . '.id=sp' . $i . '.sub_id
                LEFT JOIN shop_product_components pc' . $i . ' ON pc' . $i . '.product_id=sp' . $i . '.id 
                LEFT JOIN lookup_currencies c' . $i . ' ON c' . $i . '.id=sp' . $i . '.currency_id');
            $q->addComponent('sp' . $i . '', 's' . $i . '.ShopProducts sp' . $i . '');
            $q->addComponent('pc' . $i . '', 'sp' . $i . '.ShopProductComponents pc' . $i . '');
            $q->addComponent('c' . $i, 'sp' . $i . '.LookupCurrencies c');
            $array['select'][] = ('{sp' . $i . '.*}, {pc' . $i . '.*}, {c' . $i . '.name}');
        }
        $q->select(implode(',', $array['select']));
//        echo $q->getSqlQuery();exit;
        return ($q->execute());
    }

    public static function buildProductQuery(Doctrine_RawSql &$q, $shop_id) {
        $max_level = array_shift(Doctrine_Query::
                        create()->from('ShopMenuSubs')
                        ->select('MAX(level)')
                        ->where('shop_id=?', $shop_id)
                        ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                        ->fetchOne());

        $select[] = ('{s1.*}');
        $q->addComponent('s1', 'ShopMenuSubs s1');
        $q->from('
            (select * from shop_menu_subs where shop_id="' . $shop_id . '" AND level=1 AND type="products") s1
            ');

        for ($i = 2; $i <= $max_level; $i++) {
            $select[] = ('{s' . $i . '.*}');
            $q->addComponent('s' . $i, 's' . ($i - 1) . '.ShopMenuSubs s' . $i);
            $q->addFrom('
            left join 
            (select * from shop_menu_subs where shop_id="' . $shop_id . '" AND level=' . $i . ') s' . $i . '
            ON s' . ($i - 1) . '.id=s' . $i . '.related_to
            ');
        }

        $q->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

        return array("max_level" => $max_level, "select" => $select);
    }

    static function getApplicationShopProducts($shop_id) {
        $q = new Doctrine_RawSql();
        $array = self::buildProductQuery($q, $shop_id);

        for ($i = 1; $i <= $array['max_level']; $i++) {
            $q->addFrom('
                    LEFT JOIN shop_products sp' . $i . ' ON s' . $i . '.id=sp' . $i . '.sub_id
                LEFT JOIN shop_product_components pc' . $i . ' ON pc' . $i . '.product_id=sp' . $i . '.id 
                LEFT JOIN lookup_currencies c' . $i . ' ON c' . $i . '.id=sp' . $i . '.currency_id');
            $q->addComponent('sp' . $i . '', 's' . $i . '.ShopProducts sp' . $i . '');
            $q->addComponent('pc' . $i . '', 'sp' . $i . '.ShopProductComponents pc' . $i . '');
            $q->addComponent('c' . $i, 'sp' . $i . '.LookupCurrencies c');
            $array['select'][] = ('{sp' . $i . '.*}, {pc' . $i . '.*}, {c' . $i . '.name}');
        }
        $q->select(implode(',', $array['select']));
//        echo $q->getSqlQuery();exit;
        return ($q->execute());
    }

    public static function getProductMenu($menuId) {
        $q = Doctrine_Query::create()
                ->select('m.id, m.level, related_to, name')
                ->from('ShopMenuSubs m')
                ->where('m.id=?', $menuId)
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->fetchOne();

        $menu_item = array();
        for ($i = ($q['level'] - 2); $i >= 0; $i--) {
            $n = Doctrine_Query::create()
                    ->select('m.id, m.level, name')
                    ->from('ShopMenuSubs m')
                    ->where('m.id=?', ($q['related_to'] - $i))
                    ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                    ->fetchOne();

            $menu_item[] = $n;
        }

        $menu_item[] = $q;
        return $menu_item;
    }

}