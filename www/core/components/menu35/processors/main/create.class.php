<?php

class Menu35CreateProcessor extends modObjectCreateProcessor {

//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 1);                      
    


//include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
//CppDebug::$arrItems[2]=new CppDebug(array('dir'=>$_SERVER['DOCUMENT_ROOT'].'/mdx'));
//$dbg2=&CppDebug::$arrItems[2];



    public $classKey = 'Menu35';
    public $languageTopics = array('menu35M:default');
    //public $objectType = 'morpher35.morph35adm';
    //public $permission='CountersCityCreate';
    public function beforeSave() {
//include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
//$dbg2=&CppDebug::$arrItems[2];

       //$data = $this->getProperty('results');
       //$name =$data['name']; 
       $this->object->set('name',"Новая строка");
       
       //$dbg2->addMix('$data',$data);  
       
/*
        if (empty($name)) {
            $this->addFieldError('name',"Пустое значение");
        } 
        else if ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name',"Такое наименование уже есть");
        }
*/        


        return parent::beforeSave();
    }
}
return 'Menu35CreateProcessor';
