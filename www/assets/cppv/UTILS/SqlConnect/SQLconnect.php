<?php
//include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/com/SQLconnect.php");


//include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php"); //delete_test_file();  add_test_str(__FILE__);
include $_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/DEBUG/debugM.php";
$dbg=new CppDebug(array('dir'=>__DIR__));
//$dbg->clear(); 
$dbg->add(__FILE__);
$dbg->add(date("d.m.Y H:i:s"));
//$dbg->addVar('$rr',$rr);
//$dbg->addMix('$obj',$obj);


include($_SERVER["DOCUMENT_ROOT"].'/assets/cppv/GLOB/ccffgg.php');

$host=$GLOBALS['arrCcFfGg']['database_server'];    
$dbname=$GLOBALS['arrCcFfGg']['dbase'];
$user=$GLOBALS['arrCcFfGg']['database_user'];
$pass=$GLOBALS['arrCcFfGg']['database_password'];
			$dbg->addMix('$GLOBALS["arrCcFfGg"]',$GLOBALS["arrCcFfGg"]);
try {  

	$GLOBALS['DBH_AS'] = new PDO("mysql:".$host."=localhost;dbname=".$dbname, $user, $pass); 
																							
	$GLOBALS['DBH_AS']->exec('SET NAMES utf8');                                    
	$GLOBALS['DBH_AS']->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}  
catch(PDOException $e) {  
    echo $e->getMessage();
}
//===================================================================================
function initPDO_AS(){   
include($_SERVER["DOCUMENT_ROOT"].'/assets/cppv/GLOB/ccffgg.php');	
$host=$GLOBALS['arrCcFfGg']['database_server']; 
$dbname=$GLOBALS['arrCcFfGg']['dbase'];
$user=$GLOBALS['arrCcFfGg']['database_user'];
$pass=$GLOBALS['arrCcFfGg']['database_password'];


try {  
	$GLOBALS['DBH_AS'] = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$GLOBALS['DBH_AS']->exec('SET NAMES utf8');                                    
	$GLOBALS['DBH_AS']->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
	}  
catch(PDOException $e) {  
    echo $e->getMessage();   
	}	
	
	
}
//===================================================================================
function getSelect($textSQL){ 
   if(!$GLOBALS['DBH_AS']){initPDO_AS(); }      
   $STH_AS=$GLOBALS['DBH_AS']->query($textSQL);
	$STH_AS->setFetchMode(PDO::FETCH_ASSOC);  
	return $STH_AS;
}
//===================================================================================
function AsSqlExec($textSQL){   
   //global  $DBH_AS;            
   if(!$GLOBALS['DBH_AS']){  initPDO_AS(); }     
   $count=$GLOBALS['DBH_AS']->exec($textSQL);
	return $count;
}
//===================================================================================
function AsLastInsertId(){
 //global  $DBH_AS;            
 return $GLOBALS['DBH_AS']->lastInsertId();
}
//===================================================================================

//===================================================================================

?>


