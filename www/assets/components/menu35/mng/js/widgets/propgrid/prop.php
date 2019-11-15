<?
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1); 

$arrAnsw=array();
$arrAnsw['success']='true';
$arrAnsw['debug']=array();
//$arrAnsw['debug']['_POST']=array();
//$arrAnsw['debug']['_POST']=$_POST;

$fName=__DIR__.'/params.json';

$json=file_get_contents($fName);

$jsObj=json_decode($json);


$jsPost=json_decode($_POST['data']);


$name=$jsPost->name;
$value=$jsPost->value;
$jsObj->$name=$value;

$jsRes=json_encode($jsObj);
$nBytes=file_put_contents($fName, $jsRes);

//$arrAnsw['debug']["jsRes"]=$jsRes;
//$arrAnsw['debug']["nBytes"]=$nBytes;
//$arrAnsw['debug']["fName"]=$fName;


echo  json_encode($arrAnsw);
/*
_POST
:
HTTP_MODAUTH
:
"modx5b55f7ef0687c7.38205013_15d599d3a00ce14.71280757"
name
:
"sezon"
value
:
"1.5"

*/