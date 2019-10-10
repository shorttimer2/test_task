<?php

namespace Controllers;

use App;

class Admin extends \App\Controller
{
    public $labeltext = array();
    
    public $saveresult = 0;
    
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
            header('Location: /admin');
            
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
                    if($this->saveresult == false)
                        {
                        $message = 'Запись успешно добавлена';
                        $page = App::$db->getTotal();
                        }
                    else
                        {
                        $message = 'Запись успешно изменена';
                        $page = $_COOKIE['page'] != '' ? $_COOKIE['page'] : '1';
                        }    
                    unset($_POST);
                }   
                $sort = $_COOKIE['sort'] != '' ? $_COOKIE['sort'] : '';                  
            }
            
                    App::$db->fillLabels($this->labeltext);
                    
                    return $this->render('admin',[
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