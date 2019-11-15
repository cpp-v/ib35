<?php
require_once (dirname(__FILE__).'/update.class.php');
class cppvkoefsAutoUpdateFromGridProcessor extends cppvkoefsAutoUpdateProcessor {
    public function initialize() {
        $data = $this->getProperty('data');
                           //$data_str = var_export($data, TRUE); //add_test_str('$data_str='.$data_str);        
        if (empty($data)) return "Неверные данные";
        $data = $this->modx->fromJSON($data);
        if (empty($data)) return "Неверные данные";
        $this->setProperties($data);
        $this->unsetProperty('data');
        return parent::initialize();
    }
}
return 'cppvkoefsAutoUpdateFromGridProcessor';
