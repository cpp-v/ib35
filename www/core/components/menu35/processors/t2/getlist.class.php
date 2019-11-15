<?php
class cppvkoefsAutoGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'TaxiAuto';
    public $languageTopics = array('counters:default');
    public function prepareQueryBeforeCount(xPDOQuery $c) {
    $query = $this->getProperty('query');
    
    if (!empty($query)) {
        $c->where(array(
            'class:LIKE' => '%'.$query.'%',
        ));
    }
                 
    $c->prepare();
    return $c;
}
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'cppvkoefs.auto';
} 
return 'cppvkoefsAutoGetListProcessor';

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
