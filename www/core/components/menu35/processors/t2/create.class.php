<?php
class cppvkoefsAutoCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'TaxiAuto';
    public $languageTopics = array('counters:default');
    public $objectType = 'cppvkoefs.TaxiAuto';
    //public $permission='CountersCityCreate';
    public function beforeSave() {
    	/*
        $name = $this->getProperty('class');
        if (empty($name)) {
            $this->addFieldError('name',"Пустое значение");
        } else if ($this->doesAlreadyExist(array('name' => $year))) {
            $this->addFieldError('name',"Такое наименование уже есть");
        }
      */  
        return parent::beforeSave();
    }
}
return 'cppvkoefsAutoCreateProcessor';
