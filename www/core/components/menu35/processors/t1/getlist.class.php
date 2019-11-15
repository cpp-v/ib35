<?php
class CppvkoefsGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'TaxiKoefs';
    public $languageTopics = array('cppvkoefs:default');
    public function prepareQueryBeforeCount(xPDOQuery $c) {
    $query = $this->getProperty('query');
    
    if (!empty($query)) {
        $c->where(array(
            'name:LIKE' => '%'.$query.'%',
        ));
    }
    $c->sortby('restint_2','ASC');
    $c->prepare();
    return $c;
}
    public $defaultSortField = 'id';
    //public $defaultSortDirection = 'DESC';
    public $objectType = 'cppvkoefs.koefs';
} 
return 'CppvkoefsGetListProcessor';

/*

$classKey - This tells the Processor what MODX Class to grab. We want to grab our Doodle objects.
$languageTopics - An array of language topics to load for this processor.
$defaultSortField - The default sort field to use when grabbing the data.
$defaultSortDirection - The default sort direction to do when grabbing the data.
$objectType - This is often used to determine what error lexicon strings to load when grabbing data.
 Since in our lexicon file we have all the strings 
 as $_lang['doodles.doodle_blahblah'] and such,
 we'll specify the prefix here of "doodles.doodle".
 MODX then will prefix standard error messages with that prefix.

*/