<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);     


include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
CppDebug::$arrItems[0]=new CppDebug(array('dir'=>$_SERVER['DOCUMENT_ROOT'].'/mdx'));
$dbg1=&CppDebug::$arrItems[0];
$dbg1->clear(); 
$dbg1->add(__FILE__);
$dbg1->add(date("d.m.Y H:i:s"));
$dbg1->addMix('$_POST',$_POST);


include_once dirname(__FILE__).'/config.core.php';                       
include_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
include_once MODX_CONNECTORS_PATH.'index.php';   // $dbg1->addVar('MODX_CONNECTORS_PATH',MODX_CONNECTORS_PATH);

	
$res=$modx->addPackage('cppvmenu',MODX_CORE_PATH.'components/menu35/model/');
$corePath = MODX_CORE_PATH.'components/menu35/';
$path_=MODX_CORE_PATH.'components/menu35/model/';




$modx->lexicon->load('menu35:default');
                                         
                                         
/* handle request */
//$path = $modx->getOption('processorsPath',$modx->menu35->config,$corePath.'processors/');
//$path = $modx->getOption('processorsPath',$modx->menu35->config,$corePath.'processors/');
                                 //        $dbg1->add("3");

//$modx->log(1,'$path='.$path);
//$modx->log(1,'$_POST='.print_r($_POST,1));  
//$dbg1->addVar('$path',$path);
//$dbg1->addMix('$_POST',$_POST);
                                   //      $dbg1->add("4");
$action=$_POST['action'];

if($_POST['xaction']=='read') $_POST['xaction']='getlist';
if($_POST['xaction']=='destroy') $_POST['xaction']='remove';

$_POST['action']=$_POST['table'].'/'.$_POST['xaction'];
$_REQUEST['action']=$_POST['table'].'/'.$_POST['xaction'];  

if(empty($_POST['xaction'])) {$_POST['action']=$action; $_REQUEST['action']=$action;}   $dbg1->addMix('$_REQUEST',$_REQUEST);


$modx->request->handleRequest(array(
    'processors_path' => MODX_CORE_PATH.'components/menu35/processors/',  
    'location' => '',
));






