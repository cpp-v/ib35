<?php

//$modx->log(1,__FILE__);
class MorphT2RemoveallProcessor extends modProcessor {
    public $classKey = 'Morph35';
    public $languageTopics = array('counters:default');
    public $objectType = 'morpher35.morph35adm';
    public function process() {             // $this->modx->log(1,'process()');                                       	
    	
        $q = $this->modx->newQuery('Morph35');
        $q->command('DELETE');
        $q->prepare()->execute();

        return $this->success('',array());
    }
    

}
return 'MorphT2RemoveallProcessor';
