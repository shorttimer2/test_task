<?php

namespace Controllers;

use App;

class Home extends \App\Controller
{
    private $labeltext = array();
    
    public function index (){  
                
        if (isset($_POST['a']))    
          $this->labeltext =  App::$db->saveRecord();
        
        App::$db->fillLabels($this->labeltext);
        
        $page = array_key_exists('page', $_GET) ? $_GET["page"] : 1;
        
        $result = App::$db->getRecords($page);
        $totalpages = App::$db->getTotal();
        
        return $this->render('home',[
            'result' => $result,
            'totalpages'=> ceil($totalpages[0][0] / 3),
            'page'=> $page,
            'labeltext' => $this->labeltext
        ]);
        
    }

    
}