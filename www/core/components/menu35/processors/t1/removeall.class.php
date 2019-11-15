<?php

//$modx->log(1,__FILE__);
class MorphRemoveallProcessor extends modProcessor {
    public $classKey = 'Morph35Adm';
    public $languageTopics = array('counters:default');
    public $objectType = 'morpher35.morph35adm';
    //public $permission='CountersCityRemove';
    public function process() {             // $this->modx->log(1,'process()');
                                        	
    	
        $q = $this->modx->newQuery('Morph35Adm');
        $q->command('DELETE');
        $q->prepare()->execute();

        return $this->success('',array());
    }
    

}
return 'MorphRemoveallProcessor';
