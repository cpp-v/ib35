<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);     

/*
include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
CppDebug::$arrItems[0]=new CppDebug(array('dir'=>__DIR__));
$dbg1=&CppDebug::$arrItems[0];
$dbg1->clear(); 
$dbg1->add(__FILE__);
$dbg1->add(date("d.m.Y H:i:s"));
*/

include_once dirname(__FILE__).'/config.core.php';                       
include_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
include_once MODX_CONNECTORS_PATH.'index.php';   // $dbg1->addVar('MODX_CONNECTORS_PATH',MODX_CONNECTORS_PATH);
//include_once MODX_CORE_PATH.'components/menu35/model/menu35/menu35.class_.php'; 

	
$res=$modx->addPackage('cppvmenu',MODX_CORE_PATH.'components/menu35/model/');

/*
									$dbg1->addMix('=========================== $res',$res);																	

$c = $modx->newQuery('Menu35');
$c->prepare();
$sql=$c->toSQL();  $dbg1->addVar('$sql',$sql);
*/	
	
	

$corePath = MODX_CORE_PATH.'components/menu35/';
//$fileClass=MODX_CORE_PATH.'components/menu35/model/menu35/menu35.class.php=====';  $dbg1->add($fileClass);

                                       

//$modx->menu35 = new Menu35(&$modx);
//$modx->addPackage('cppvmenu',MODX_CORE_PATH.'components/menu35/model/');
												
												
									$path_=MODX_CORE_PATH.'components/menu35/model/';
									//$dbg1->addVar('$path_',$path_);																	




                             //            $dbg1->add("1.1");
$modx->lexicon->load('menu35:default');
                               //          $dbg1->add("2");
                                         
                                         
/* handle request */
//$path = $modx->getOption('processorsPath',$modx->menu35->config,$corePath.'processors/');
//$path = $modx->getOption('processorsPath',$modx->menu35->config,$corePath.'processors/');
                                 //        $dbg1->add("3");

//$modx->log(1,'$path='.$path);
//$modx->log(1,'$_POST='.print_r($_POST,1));  
//$dbg1->addVar('$path',$path);
//$dbg1->addMix('$_POST',$_POST);
                                   //      $dbg1->add("4");

$modx->request->handleRequest(array(
    'processors_path' => MODX_CORE_PATH.'components/menu35/processors/',  
    'location' => '',
));
