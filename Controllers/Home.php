<?php

namespace Controllers;

use App;

class Home extends \App\Controller
{
    public $labeltext = array();
    
    public function index (){  
        
        $page = array_key_exists('page', $_GET) ? $_GET["page"] : 1;
                
        if (isset($_POST['a']))    
           if(App::$db->saveRecord($this))
           {
               $a=10;
           }
        
        
        
        
        
        $result = App::$db->getRecords($page);
        $totalpages = App::$db->getTotal();
        
        App::$db->fillLabels($this->labeltext);
        
        return $this->render('home',[
            'result' => $result,
            'totalpages'=> ceil($totalpages[0][0] / 3),
            'page'=> $page,
            'labeltext' => $this->labeltext
        ]);
        
    }

    
}