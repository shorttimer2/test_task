<?php

namespace Controllers;

use App;

class Home extends \App\Controller
{
    public $labeltext = array();
    
    
    public function index (){  
        
    $message = '';
    $sort= '';
    
    if (isset($_GET['sort'])) 
        $sort = $_GET['sort'];
    
    $page = array_key_exists('page', $_GET) ? $_GET["page"] : 1;
                
    if (isset($_POST['a']))    
       if(App::$db->saveRecord($this))
            $message = 'Запись успешно добавлена';
               
    App::$db->fillLabels($this->labeltext);
        
    return $this->render('home',[
            'result' => App::$db->getRecords($page,$sort),
            'totalpages'=> App::$db->getTotal(),
            'page'=> $page,
            'message' => $message,
            'labeltext' => $this->labeltext,
            'sort' => $sort,
        ]);
        
    }

    
}