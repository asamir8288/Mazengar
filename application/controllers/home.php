<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Asamir
 */
class home extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->template->write_view('content', 'backend/home');
        $this->template->render();
    }
    
    public function test(){
        $mysongs = simplexml_load_file('test.xml');
        
        foreach($mysongs->song as $tes){
            $has_sub = explode(', ', $tes->title[0]);
            if($has_sub[2] == 'has_sub'){
                $i=1;
                foreach($tes->title[1] as $item){
                    $has_sub = explode(', ', $item->sub[$i]);
                    if($has_sub == 'has_sub'){
                        foreach($tes->title[1]->sub as $item2){
                            $has_sub = explode(', ', $item2->sub[$i]);
                        }
                    }
                    
                    $i++;
                }
                exit;
            }
        }
        if($this->input->post('submit')){
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
            exit;
           for($i=0;$i<count($_POST['menu']);$i++){
//               foreach($item['sub_menu'] as $sub1){
//                   var_dump($sub1);
//               }
               var_dump($_POST['menu'][$i]);exit;
           }           
        }
        
        $this->template->write_view('content', 'test');
        $this->template->render();
    }
}

?>
