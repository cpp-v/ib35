<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);     

require_once dirname(__FILE__).'/config.core.php';                       
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';
$corePath = MODX_CORE_PATH.'components/menu35/';
require_once $corePath.'model/menu35/menu35.class.php';
//$modx->koefs = new Cppvkoefs($modx);
$modx->menu35 = new Menu35($this->modx);
$modx->lexicon->load('menu35:default');
/* handle request */
$path = $modx->getOption('processorsPath',$modx->menu35->config,$corePath.'processors/');

$modx->log(1,'$path='.$path);
$modx->log(1,'$_POST='.print_r($_POST,1));


$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));

