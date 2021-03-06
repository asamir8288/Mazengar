<?php

/**
 * BranchFilters
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class BranchFilters extends BaseBranchFilters
{
    public function addBranchFilter($branch_id, $filter_id){
        $bf = new BranchFilters();
        $bf->branch_id = $branch_id;
        $bf->filter_id = $filter_id;
        $bf->save();
    }
    
    public function deleteBranchFilters($branch_id){
        Doctrine_Query::create()
                ->delete('BranchFilters bf')
                ->where('bf.branch_id =?', $branch_id)
                ->execute();
    }
}