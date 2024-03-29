<?php
namespace App;

use App;

class Db
{
    
    public $pdo;
    
    public function __construct()
    {
        
        $settings = $this->getPDOSettings();
        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
        
    }
    
    protected function getPDOSettings()
    {
        
        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Db.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }
    /**
     * execute any query
     * @param string $query
     * @param array $params
     * @return array result
     */
    protected function execute($query, array $params=null)
    {
        
        if(is_null($params)){
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
        
    }
    /**
     * get one page, three records
     * @param number $page
     * @return array result records
     */
    public function getRecords($page = 1,$sort = '') {
        $limit = 3;
        $sqlsort = '';
        
        switch ($sort)
        {
            
            case 'n0':
            $sqlsort = ' ORDER BY name ';
            break;
            case 'n1':
            $sqlsort = ' ORDER BY name DESC ';
            break;
            case 'e0':
            $sqlsort = ' ORDER BY email ';
            break;
            case 'e1':
            $sqlsort = ' ORDER BY email DESC ';
            break;
            case 's0':
            $sqlsort = ' ORDER BY status ';
            break;
            case 's1':
            $sqlsort = ' ORDER BY status DESC ';
            break;
        }
       
        if($page == 1)
        {
            return $this->execute('SELECT * FROM task ' . $sqlsort . 'LIMIT 0 ,3' );
        }
        else
        {
            $start = $page * 3 - 3;      
            $sql = 'SELECT * FROM task ' . $sqlsort .'LIMIT '. $start . ' ,3';
            return $this->execute($sql);
        }
            
    }
    /**
     * get total records
     * @return array
     */
    public function getTotal() {
        $totalpages = $this->execute('SELECT COUNT(*) FROM `task`');
        return  ceil($totalpages[0][0] / 3);
    }
    /*
     * save record with validation
     * @return array('name'=> 'label text','email'=> 'label text','text'=>'label text')
     * 
     */
    public function saveRecord(&$lt) {

        
        $name = htmlspecialchars(stripslashes($_POST['name']));
        $email = htmlspecialchars(stripslashes($_POST['email']));
        $text = htmlspecialchars(stripslashes($_POST['text']));
        if(isset($_POST['status']))
        {
            if(!$_POST['modify'])
                $status = 1;
            else 
                $status = 2;
        }
        else 
            $status = 0;
        
        if(empty($email))
            $lt->labeltext['email'] = "Вы не указали свой E-mail";
        
            elseif (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email))
            $lt->labeltext['email'] = "Вы ввели некорректный E-mail";     
        
        if(empty($name))
            $lt->labeltext['name'] = "Пожалуйста, укажите свое имя";
       
           
        elseif (!preg_match('/[a-zA-Zа-яА-ЯЁё_]+/ui', $name))
            $lt->labeltext['name'] = "Пожалуйста, введите корректно свое имя";
        
        if(empty($text))
            $lt->labeltext['text'] = "Пожалуйста, введите текст задачи";
        
        if(empty($lt->labeltext))
            {
                $sql = 'SELECT COUNT(*) FROM `task` WHERE name="'. $name . '"';
                $res = $this->execute($sql);
                $lt->saveresult = $res[0][0];
                if($lt->saveresult)
                    $sql = 'UPDATE  `task` SET email = "' . $email .'" ,message = "'. $text .'" ,status = "'. $status . '" WHERE name="' . $name . '"';
                else
                    $sql = 'INSERT INTO `task` (`name`,`email`,`message`,`status`) VALUES ( "'. $name . '" , "' . $email . '" , "' .  $text . '" , "0")';
                
                $this->execute($sql);
                return true;
            } 
 
        return false;
    }
    /**
     * fill text for labels
     */
    public function fillLabels(&$labels) {
        if(!isset($labels['name']))
            $labels['name'] = 'Ваше имя';
        if(!isset($labels['email']))
            $labels['email'] = 'Email';
        if(!isset($labels['text']))
            $labels['text'] = 'Текст задачи';
    }
    /**
     * fill text for login labels
     */
    public function fillLoginlabels(&$labels) {
        if(!isset($labels['name']))
            $labels['name'] = 'Логин';
        if(!isset($labels['pass']))
            $labels['pass'] = 'Пароль';

    }
    /**
     * check login and password
     */
    public function login(&$lt) {
        
        $name = htmlspecialchars(stripslashes($_POST['name']));
        $pass = htmlspecialchars(stripslashes($_POST['pass']));

        
        if(empty($name))
            $lt->labeltext['name'] = "Пожалуйста, укажите логин";
     elseif (!preg_match('/[a-zA-Zа-яА-ЯЁё_]+/ui', $name))
            $lt->labeltext['name'] = "Пожалуйста, введите корректно логин";
            
        if(empty($pass))
                $lt->labeltext['pass'] = "Пожалуйста, введите пароль";
        if(empty($lt->labeltext))
        {
        $query =  'SELECT pass FROM user WHERE name ="' . $name . '"';       
        $userdata = $this->execute($query);
        if(!empty($userdata))
            {
            if($userdata[0]['pass'] == md5($pass))
                    return true;
            }
        }
            
            
            
       return false;     
    }
}