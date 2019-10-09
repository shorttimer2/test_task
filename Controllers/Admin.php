<?php

namespace Controllers;

use App;

class Admin extends \App\Controller
{
    public $labeltext = array();
    
    public function index (){
        
          $message = '';
          
          if (isset($_POST['lg']))
              if(!App::$db->login($this))
                  $message = 'Неверно введен логин или пароль';
              else
              {
                  if(App::$auth->isAuth())
                      App::$auth->out();
                  
                  App::$auth->auth(htmlspecialchars(stripslashes($_POST['name']))); 
                  header('Location: /admin/cab');
              }
               

          App::$db->fillLoginlabels($this->labeltext);
          
          return $this->render('login',[
              'labeltext' => $this->labeltext,
              'message' => $message,
             ]);
                    
    }
    
    public function cab(){
        
        if(!App::$auth->isAuth())
            header('Location: /home');
            
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
    
    public function logout() {
        
        if(App::$auth->isAuth())
            App::$auth->out();
        header('Location: /home');
    }
    
    
}