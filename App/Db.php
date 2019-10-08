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
    public function getRecords($page = 1) {
        $limit = 3;
        
        if($page == 1)
            return $this->execute('SELECT * FROM task LIMIT 3');
        else
        {
            $start = $page * 3 - 2;
            $end = $start + 2;
            $sql = 'SELECT * FROM task WHERE id BETWEEN '. $start .' AND ' . $end;
            return $this->execute($sql);
        }
            
    }
    /**
     * get total records
     * @return array
     */
    public function getTotal() {
            return $this->execute('SELECT COUNT(*) FROM `task`');
    }
    /*
     * save record with validation
     * @return array('name'=> 'label text','email'=> 'label text','text'=>'label text')
     * 
     */
    public function saveRecord() {

        
        $name = htmlspecialchars(stripslashes($_POST['name']));
        $email = htmlspecialchars(stripslashes($_POST['email']));
        $text = htmlspecialchars(stripslashes($_POST['text']));
        
        if(empty($_POST['email']))
            $labelstext['email'] = "Вы не указали свой E-mail";
        
            elseif (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email))
            $labelstext['email'] = "Вы ввели некорректный E-mail";     
        
        if(empty($_POST['name']))
            $labelstext['name'] = "Пожалуйста, укажите свое имя";
       
        elseif (!preg_match("/^[а-яА-ЯёЁa-zA-Z0-9]+$/i", $name))
            $labelstext['name'] = "Пожалуйста, введите корректно свое имя";
        
        if(empty($_POST['text']))
            $labelstext['text'] = "Пожалуйста, введите текст задачи";
        
        return $labelstext;
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
}