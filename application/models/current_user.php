<?php
class Current_User extends CI_Model{

    private static $user;

    public static function user() {
        if (!isset(self::$user)) {
            $CI = & get_instance();

            if (!$user_info = $CI->session->userdata('user_info')) {
                return FALSE;
            }
            if (!$u = Doctrine::getTable('Users')->findOneById($user_info['user_id'])) {
                return FALSE;
            }
            self::$user = $user_info;
        }
        return self::$user;
    }

    public static function login($email, $password) {
        $user = Doctrine_Query::create()
                        ->select('u.*, COUNT(u.id) AS count_user, u.shop_id')
                        ->from('Users u')
                        ->Where('u.email = \'' . trim($email) . '\'')
                        ->andWhere('u.password = \'' . md5(trim($password)) . '\'')
                        ->andWhere('u.deleted = 0')
                        ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                        ->fetchOne();
        
        if ($user['count_user'] > 0) {
            $CI = & get_instance();
            $user_info = array(
                'user_id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'shop_id' => $user['shop_id']
            );
            $CI->session->set_userdata('user_info', $user_info);
            self::$user = $user_info;
            return self::$user;
        }else{
            return false;
        }
    }

    public static function logout(){
        $CI = & get_instance();
        self::$user = null;
        $CI->session->sess_destroy();
        redirect('/');
    }

}

?>
