<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('LookupShopCategories', 'default');

/**
 * BaseLookupShopCategories
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $lang_id
 * @property string $name
 * @property SiteLanguages $SiteLanguages
 * @property Doctrine_Collection $ShopCategoryFilters
 * @property Doctrine_Collection $Shops
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLookupShopCategories extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('lookup_shop_categories');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('lang_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('name', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('SiteLanguages', array(
             'local' => 'lang_id',
             'foreign' => 'id'));

        $this->hasMany('ShopCategoryFilters', array(
             'local' => 'id',
             'foreign' => 'cat_id'));

        $this->hasMany('Shops', array(
             'local' => 'id',
             'foreign' => 'category_id'));
    }
}