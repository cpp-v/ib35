<?php
class Menu35DublProcessor extends modObjectCreateProcessor {
    public $classKey = 'Menu35';
    public $languageTopics = array('menu35M:default');
    public $objectType = 'menu35M.menu35M';
    //public $permission='CountersCityCreate';
    public function beforeSet() {
        $obj=$this->modx->getObject('Menu35',$this->getProperty('id'));     	
    	  $arr=$obj->toArray();         // $this->modx->log(1,'$arr='.print_r($arr,true));
        $this->setProperties($arr); 	  
        return parent::beforeSet();

    }
    public function beforeSave() {
    	  
       
/*        
        $name = $this->getProperty('name');
        if (empty($name)) {
            $this->addFieldError('name',"Пустое значение");
        } 
        else if ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name',"Такое наименование уже есть");
        }
*/        
        return parent::beforeSave();
    }
    /*
    public function process() {             // $this->modx->log(1,'process()');
        $obj=$this->modx->getObject('TaxiKoefs',);   
        $q = $this->modx->newQuery('TaxiKoefs');

        $q->command('DELETE');
        $q->prepare()->execute();

        return $this->success('',array());
    }
    */
}
return 'Menu35DublProcessor';
