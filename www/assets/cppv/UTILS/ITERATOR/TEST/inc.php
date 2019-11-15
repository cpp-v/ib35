<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);     
/*   
$arrCcFfGg=Array
(
    [database_server] => localhost
    [database_user] => andrey
    [database_password] => oL7g7p3l
    [dbase] => database
    [database_connection_charset] => utf8
    [table_prefix] => FkjfnJf23ccsFs_
    [modx_core_path] => 
)
*/

//include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/ITERATOR/iterator.php");
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/ITERATOR/iterForMenu.php");
 
$itr=new IterFoMenu();  echo 'iterator init!';

$itr->numCol=3;
$itr->sqlText="select t.id, t.pagetitle, t.parent, t.isfolder
from ".$GLOBALS['arrCcFfGg']['table_prefix']."site_content t
where 1=1 ";
$sortStr=" order by 2 ";

$itr->arrUserFuncs[]="myHendlerRowItem";
//$itr->arrUserFuncs[]="myHendlerFolder";

$itr->arrUserFuncsBeforWhile[]="myHendlerBFW";
$itr->arrUserFuncsStartCol[]="myHendlerSC";
$itr->arrUserFuncsEndCol[]="myHendlerEndC";
//----------------------------
function myHendlerSC($arrParam) { 
   $instance=$arrParam["instance"];    
  	$row=$arrParam["row"];   
   echo "<h5 class='text-primary'>StartCol  ".row["pagetitle"]." level=".$arrParam["curentLevel"]."</h5>";
}
//----------------------------
function myHendlerEndC($arrParam) { 
   $instance=$arrParam["instance"];    
  	$row=$arrParam["row"];   
   echo "<h5 class='text-primary'>EndCol  ".row["pagetitle"]."level=".$arrParam["curentLevel"]."</h5>";
   
   
}
//----------------------------
function myHendlerBFW($arrParam) { 
   $instance=$arrParam["instance"];    
   $folderRow=$instance->folderRow;
   if($folderRow==0) return;   
	$instance=$arrParam["instance"];   
   echo "<h3 class='text-primary'>".$folderRow["pagetitle"].' ('.$instance->rowCount."). curentLevel=".$arrParam["curentLevel"]."</h3>";
}
//----------------------------
function myHendlerFolder($arrParam) { if($arrParam["row"]["isfolder"]==0) return;   
	$row=$arrParam["row"];
	$instance=$arrParam["instance"];   

   echo "<h3 class='text-primary'>".$row["pagetitle"].' ('.$instance->rowCount."). curentLevel=".$arrParam["curentLevel"]."</h3>";

}

function myHendlerRowItem($arrParam) { if($arrParam["row"]["isfolder"]==1) return;
   global $modx;
	$row=$arrParam["row"];
	$instance=$arrParam["instance"];
   	
	   
   $out_="<div class='text-primary'>".$row["pagetitle"]."  level=".$instance->curentLevel." numRowInCol=".$instance->numRowInCol." idx=".$instance->idx." idxCol=".$instance->idxCol."</div>";
   $url=$modx->makeUrl($row['id']);
	$a_='<a href="/'.$url.'">'.$out_."</a>";

	echo $a_;
}	


$itr->parent=616;
$itr->level=3;
$itr->sortStr=$sortStr;
//$itr->limit=10;

$itr->START();



?>
