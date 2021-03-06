<?php

/**
 * MobileRegistrations
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class MobileRegistrations extends BaseMobileRegistrations {

    public function addRegistration(array $data) {
        $r = new MobileRegistrations();
        $r->shop_id = $data['shop_id'];
        $r->name = $data['name'];
        $r->email = $data['email'];
        $r->password = $data['password'];
        $r->phone = $data['phone'];
        $r->created_at = date('ymdHis');
        $r->save();
        
        return true;
    }

    public function isUserExist($email, $password) {
        $q = Doctrine_Query::create()
                ->select('count(r.id) as is_exist, r.*')
                ->from('MobileRegistrations r')
                ->where('r.email =?', trim($email))
                ->andWhere('r.password=?', trim($password))
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->fetchOne();

        if ($q['is_exist'] > 0){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function isEmailExist($email) {
        $q = Doctrine_Query::create()
                ->select('count(r.id) as is_exist')
                ->from('MobileRegistrations r')
                ->where('r.email =?', trim($email))
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->fetchOne();

        if ($q['is_exist'] > 0)
            return true;
        return false;
    }
    
     public function getIdByEmail($email) {
        $q = Doctrine_Query::create()
                ->select('r.id')
                ->from('MobileRegistrations r')
                ->where('r.email =?', trim($email))
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->fetchOne();
        return $q['id'];
    }

}