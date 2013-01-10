<?php

/**
 * Users
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Users extends BaseUsers
{
    function addUser(array $user_data){
        $activation_code = md5(uniqid(rand()));
        
        $u = new Users();
        $u->shop_id = $user_data['shop_id'];
        $u->first_name = $user_data['first_name'];
        $u->last_name = $user_data['last_name'];
        $u->job_title = $user_data['job_title'];
        $u->phone = $user_data['phone'];
        $u->email = $user_data['email'];
        $u->password = md5($user_data['password']);
        $u->activation_code = $activation_code;
        $u->is_primary_account = $user_data['is_primary_account'];
        $u->save();
    }
}