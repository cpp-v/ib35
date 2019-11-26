<?php
class CppvUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'Menu35';
    public $languageTopics = array('cppvmenu:default');
    public $objectType = 'cppvmenu.main';
    //public $permission='CountersCityUpdate';
    public function initialize() {
        $data = $this->getProperty('results');
        if (empty($data)) return "Неверные данные 1";
        $data = $this->modx->fromJSON($data);
        if (empty($data)) return "Неверные данные 2";
        $this->setProperties($data);
        $this->unsetProperty('data');
        return parent::initialize();
    }
    
    
}
return 'CppvUpdateProcessor';
