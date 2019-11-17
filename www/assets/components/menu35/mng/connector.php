<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);     


include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
//$dbg=new CppDebug(array('dir'=>__DIR__));
CppDebug::$arrItems[0]=new CppDebug(array('dir'=>__DIR__));
$dbg=&CppDebug::$arrItems[0];

$dbg->clear(); 
$dbg->add(__FILE__);
$dbg->add(date("d.m.Y H:i:s"));
//$dbg->addVar('$rr',$rr);


require_once dirname(__FILE__).'/config.core.php';                       
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';    $dbg->addVar('MODX_CONNECTORS_PATH',MODX_CONNECTORS_PATH);
$corePath = MODX_CORE_PATH.'components/menu35/';
require_once $corePath.'model/menu35/menu35.class.php';

                                         $dbg->add("1");
//$modx->koefs = new Cppvkoefs($modx);
$modx->menu35 = new Menu35($modx);
$modx->addPackage('cppvmenu',MODX_CORE_PATH.'components/menu35/model/');

                                         $dbg->add("1.1");
$modx->lexicon->load('menu35:default');
                                         $dbg->add("2");
                                         
                                         
/* handle request */
$path = $modx->getOption('processorsPath',$modx->menu35->config,$corePath.'processors/');
                                         $dbg->add("3");

//$modx->log(1,'$path='.$path);
//$modx->log(1,'$_POST='.print_r($_POST,1));  
$dbg->addVar('$path',$path);
$dbg->addMix('$_POST',$_POST);
                                         $dbg->add("4");

$modx->request->handleRequest(array(
    'processors_path' => $path,  
    'location' => '',
));
/*
*/
