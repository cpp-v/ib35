<?php
/*
include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
CppDebug::$arrItems[1]=new CppDebug(array('dir'=>$_SERVER['DOCUMENT_ROOT'].'/mdx'));
$dbg=&CppDebug::$arrItems[1];
//$dbg->clear(); 
$dbg->add(__FILE__);

$dbg->add(date("d.m.Y H:i:s"));
*/
class Menu35GetListProcessor extends modObjectGetListProcessor {

    public $classKey = 'Menu35';
    public $languageTopics = array('menu35M:default');
    public function prepareQueryBeforeCount(xPDOQuery $c) {
    $query = $this->getProperty('query');
     
    if (!empty($query)) {
        $c->where(array(
            'name:LIKE' => '%'.$query.'%',
        ));
    }
    $c->sortby('restint_2','ASC');
    $c->prepare();
/*
    include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
    $dbg=&CppDebug::$arrItems[1];
		$dbg->add(__METHOD__);	
		//$c->prepare();
		$sql=$c->toSQL();
		$dbg->addVar('sql',$sql);
*/
    return $c;
}
    public $defaultSortField = 'id';
    //public $defaultSortDirection = 'DESC';
    public $objectType = 'menu35.mane';
} 
return 'Menu35GetListProcessor';

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