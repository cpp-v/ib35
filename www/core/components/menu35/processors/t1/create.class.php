<?php
class CppvkoefsCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'TaxiKoefs';
    public $languageTopics = array('counters:default');
    public $objectType = 'morpher35.morph35adm';
    //public $permission='CountersCityCreate';
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
}
return 'CppvkoefsCreateProcessor';
