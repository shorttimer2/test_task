<?php

namespace Controllers;

use App;

class Home extends \App\Controller
{
    public $labeltext = array();
    
    
    public function index (){  
        
    if(App::$auth->isAuth())
            header('Location: /admin/cab');
        
    $message = '';
    $sort= '';
    
    if (isset($_GET['sort']) && $_GET['sort'] != '')
    {
        $sort = $_GET['sort'];
        setcookie('sort',$sort,time() + (86400 * 5));
    }
    
    $page = array_key_exists('page', $_GET) ? $_GET["page"] : 1;
    if (isset($_GET['page']))
        {
        $ref = App::$router->resolveRef();
        if($ref[1] != $sort)
            $page = 1;
        setcookie('page',$page,time() + (86400 * 5));
        }
  
                
    if (isset($_POST['a']))    
    {
       if(App::$db->saveRecord($this))
            {
            $message = 'Запись успешно добавлена';
            $page = App::$db->getTotal();
            unset($_POST);
            }
        else 
           $page = $_COOKIE['page'] != '' ? $_COOKIE['page'] : '1';    
        
      $sort = $_COOKIE['sort'] != '' ? $_COOKIE['sort'] : '';
      
    }
    
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