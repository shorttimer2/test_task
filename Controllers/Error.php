<?php

namespace Controllers;

use App;

class Error extends \App\Controller
{
    
    public function Error500 ($e)
    { 
        return $this->render('error',[
            'head' => 'Ошибка на сервере',
            'message' => $e[0]
        ]);
        
    }
    public function Error404 ($e)
    {
        
        return $this->render('error',[
            'head' => 'Ошибка 404',
            'message' => 'Страница не существует',
        ]);
        
    }
    
}