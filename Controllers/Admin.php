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
                  header('Location: /admin/cab');
               

          App::$db->fillLoginlabels($this->labeltext);
          
          return $this->render('login',[
              'labeltext' => $this->labeltext,
              'message' => $message,
             ]);
                    
    }
    
    public function cab(){
        $ca = 10;
    }
    
    
}