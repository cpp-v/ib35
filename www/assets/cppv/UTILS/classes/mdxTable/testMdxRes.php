<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);            

?>

<h3>Test mdxTableRes</h3>


<?php
   echo '<h3>',__FILE__,'</h3>'; 

     include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/classes/mdxTable/mdxRes.php");
     $mdxRes=new mdxTableRes();
     $mdxRes->fieldsForRet[]='pagetitle';
     $mdxRes->fieldsForRet[]='parent';          
	  $mdxRes->tablePrefix='FkjfnJf23ccsFs_';
     $mdxRes->getRec(616);   
echo '<pre>', print_r($mdxRes->row,true),'</pre>';     
       
     $name=$mdxRes->row['pagetitle'];// а можно сразу $pagetitle=$mdxT->getRec(12,'pagetitle');  - но тогда вернет только одно поле
	
echo '<br>', $name;

   $mdxRes->makeArrRet('id');
   
echo '$mdxRes->arrRet=<pre>', print_r($mdxRes->arrRet,true),'</pre>';     

$arrFolders=$mdxRes->getChieldsIds();

echo '$arrFolders=<pre>', print_r($arrFolders,true),'</pre>';   

?>