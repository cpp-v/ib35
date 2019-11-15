<?php
class CppvkoefsDublProcessor extends modObjectCreateProcessor {
    public $classKey = 'TaxiKoefs';
    public $languageTopics = array('counters:default');
    public $objectType = 'morpher35.morph35adm';
    //public $permission='CountersCityCreate';
    public function beforeSet() {
        $obj=$this->modx->getObject('TaxiKoefs',$this->getProperty('id'));     	
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
return 'CppvkoefsDublProcessor';
