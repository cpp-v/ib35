<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php");
						//delete_test_file();
                  //add_test_str("========= START /assets/cppv	/PHP_UTILS/scaner/m.php ===========");

include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/PHP_UTILS/scaner/scaner.class.php");
//$Sc=new cppvScaner(array('days'=>10));
$Sc=new cppvScaner();

/*
8	atime	time of last access (Unix timestamp)
9	mtime	time of last modification (Unix timestamp)
10	ctime	time of last inode change (Unix timestamp)
*/

//$Sc->arrTimesName[]='atime';//last access              //если $Sc->arrTimesName пустой - время не учитывается 
//$Sc->arrTimesName[]='mtime';//last modification
//$Sc->arrTimesName[]='ctime';//last inode change



											// чтобы исключить из поиска каталоги, расширения
$Sc->arrFilterOut[]='cache';
$Sc->arrFilterOut[]='bootstrap';
//$Sc->arrFilterOut[]='cppv';
$Sc->arrFilterOut[]='*.jpg';
$Sc->arrFilterOut[]='*.jpeg';
//$Sc->arrFilterOut[]='*.png';
$Sc->arrFilterOut[]='*~';
//$Sc->arrFilterOut[]='*.js';
$Sc->arrFilterOut[]='*.sql';
//$Sc->arrFilterOut[]='*.php';


                                   // включить в поис. если надо, к примеру, найти среди *.tpl. имеет приоритет 
//$Sc->arrFilterIn[]='ajax-loader.gif';    
//$Sc->arrFilterIn[]='scaner.class.php';
//$Sc->arrFilterIn[]='index.html.bak.bak';
$Sc->arrFilterIn[]='*.php';
//$Sc->arrFilterIn[]='index.php';
//$Sc->arrFilterIn[]='*.ico';
//$Sc->arrFilterIn[]='*_add.png';
//$Sc->arrFilterIn[]='*.tpl';


//$Sc->strForFind="file_get_contents";
//$Sc->strForFind="include";
//$Sc->strForFind="preg_replace";
//$Sc->strForFind="preg_replace";
//$Sc->strForFind="function BrowseServer(ctrl)";
//$Sc->strForFind="catalog/Novogodnie-suveniry";
//$Sc->strForFind='\x2';
//$Sc->strForFind='eval';
//$Sc->strForFind='base64_decode';
//$Sc->strForFind='OnPageNotFound';
//$Sc->strForFind='getChunk';
//$Sc->strForFind='process';
//$Sc->strForFind='function processElementTags';
$Sc->strForFind='phpthumb.php';

$Sc->FillMasks();
											//add_test_str('$Sc->arrFilterOut='.print_r($Sc->arrFilterOut,true));   	
											//add_test_str('$Sc->arrFiltrOutExt='.print_r($Sc->arrFiltrOutExt,true));   	
											//add_test_str('$Sc->arrFiltrOutMask='.print_r($Sc->arrFiltrOutMask,true));   	

											//add_test_str('$Sc->arrFilterIn='.print_r($Sc->arrFilterIn,true));   	
											//add_test_str('$Sc->arrFiltrInExt='.print_r($Sc->arrFiltrInExt,true));   	
											//add_test_str('$Sc->arrFiltrInMask='.print_r($Sc->arrFiltrInMask,true));   	

											//add_test_str('$Sc->strForFind='.$Sc->strForFind);   	


$Sc->start_folder=$_SERVER['DOCUMENT_ROOT'];
$Sc->level=20;

echo '<table>';
$Sc->Start($Sc->start_folder,$Sc->level);
echo '</table>';






?>
