<?php
//include_once($_SERVER["DOCUMENT_ROOT"].'/assets/cppv/GLOB/ccffgg.php'); //$GLOBALS['arrCcFfGg'][...]
 
include_once($_SERVER["DOCUMENT_ROOT"].'/assets/cppv/GLOB/errOut.php');
if(!isset($CLOBALS['arrCcFfGg'])) {
	
$GLOBALS['arrCcFfGg']=array();

 $dirMdxCfg=$_SERVER["DOCUMENT_ROOT"].'/core/config'; //может быть другим!!!
 include($dirMdxCfg.'/config.inc.php');

 $GLOBALS['arrCcFfGg']['database_server']=$database_server;
 $GLOBALS['arrCcFfGg']['database_user']=$database_user;
 $GLOBALS['arrCcFfGg']['database_password']=$database_password;
 $GLOBALS['arrCcFfGg']['dbase']=$dbase;
 $GLOBALS['arrCcFfGg']['database_connection_charset']=$database_connection_charset;
 $GLOBALS['arrCcFfGg']['table_prefix']=$table_prefix;
 $GLOBALS['arrCcFfGg']['modx_core_path']=MODX_CORE_PATH;//$modx_core_path;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 //$arrCcFfGg['']=;
 }
?>
