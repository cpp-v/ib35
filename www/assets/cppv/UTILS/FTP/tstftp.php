<?php
exit();
error_reporting(E_ALL | E_STRICT ^ E_DEPRECATED); 
//error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
?>

<!doctype html>
<html lang=ru>
  <head>
      <meta charset=utf-8>
      <title>HTML5</title>
   <style type="text/css"> 
     #content{
       width: 1000px;
       margin:0 auto;      
     }
   </style>
 </head>
 <body>
      <header> TEST FTP
           <nav>==============</nav>
      </header>
      <section id="content">
           <article>
<pre>           
<?php
include $_SERVER["DOCUMENT_ROOT"]."/core/cppv/xxx.php";

// установка соединения
//$ftp_server='';
//$ftp_user_name=''; 
//$ftp_user_pass='';

$jsonStr=file_get_contents(__DIR__.'/modx_catalog.json');
$arrOldResIdAlbom=json_decode($jsonStr,true);    //echo print_r($arrOldResIdAlbom,true);



$conn_id = ftp_connect($ftp_server);
if($conn_id) {
  echo "ftp_connect=".$conn_id.PHP_EOL;

}
// вход с именем пользователя и паролем
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// включение пассивного режима
ftp_pasv($conn_id, true);

// проверка соединения
if ((!$conn_id) || (!$login_result)) {
    echo "Не удалось установить соединение с FTP-сервером!".PHP_EOL;
    echo "Попытка подключения к серверу $ftp_server была произведена под именем $ftp_user_name".PHP_EOL;
    exit;
} else {
    echo "Установлено соединение с FTP сервером $ftp_server под именем $ftp_user_name".PHP_EOL;
}	

parse_dir($conn_id,"public_html/assets/images/albums",0);

function parse_dir($conn_id,$dirName,$level,$pref="") {
  //$arrDirCont=ftp_mlsd($conn_id ,$dirName);
  if($level>10) return;
  $arrDirCont=ftp_nlist($conn_id ,$dirName);//  array ftp_nlist ( resource $ftp_stream , string $directory )
  //$arrDirCont=ftp_rawlist ($conn_id, $dirName);//mixed ftp_rawlist ( resource $ftp_stream , string $directory [, bool $recursive = false ] )
  if($level==3){
  	 $arrDir=explode('/',$dirName);//  	 echo print_r($arrDir);
  	 $idAlb=substr($arrDir[5],6);
  	 $resAliasParent=$arrDir[6];   echo $pref.'$idAlb='.$idAlb.' $resAliasParent='.$resAliasParent.PHP_EOL; 
    global $arrOldResIdAlbom;  	
    
    $dirLocal=""; 
  	 foreach($arrOldResIdAlbom['rows'] as $key=>$v){
  	 	if(!$key) continue;
  	   if($idAlb==$v['id']) {//нашли в массиве альбом
  	      $idRes=$v['idResurs'];
  	                               echo $pref.'$idRes='.$idRes.PHP_EOL; 
  	      //assets/resourceimages/387
         $dirLocal=$_SERVER['DOCUMENT_ROOT'].'/assets/resourceimages/'.$idRes;
         //$res=mkdir ($dirLocal);  	      
  	      break;
  	      
  	   }
  	 } 	 
  }	
  foreach($arrDirCont as $item){

    if($item=='.') continue;
    if($item=='..') continue;
    if(substr($item,0,11)=='public_html') continue;
    
    //echo $pref.'$item='.print_r($item,true).PHP_EOL;  
    echo $pref.$item." level=".$level.PHP_EOL;  
    if($level==3) {    
     $local_file=$dirLocal."/".$item;    
     $server_file=$dirName.'/'.$item; 
   	if (ftp_get($conn_id, $local_file, $server_file,FTP_BINARY)) {
    		echo $pref."Произведена запись в $local_file\n";
		} else {
    		echo $pref."Не удалось завершить операцию\n";
		}
    }
    
    parse_dir($conn_id,$dirName.'/'.$item,$level+1,$pref."  ");
    
        
             	      

  }  

  //echo print_r($arrDirCont, true);
  

}
ftp_close($conn_id);
/*
$arrDir=
Array
(
    [0] => public_html
    [1] => assets
    [2] => images
    [3] => albums
    [4] => user_41
    [5] => album_129
    [6] => tualet
)




http://domsoseda.ru/assets/cache/images/albums/user_71/album_252/kitchen/734x540-4074019934.009.jpg

exit();

$local_file=__DIR__.'/destFile.txt';
$server_file='/public_html/assets/cppv/com/SQLconnect.php';
// закачивание файла
//$upload = ftp_get($conn_id, $destination_file, $source_file, FTP_BINARY);

// попытка скачать $server_file и сохранить в $local_file
if (ftp_get($conn_id, $local_file, $server_file,FTP_ASCII)) {
    echo "Произведена запись в $local_file\n";
} else {
    echo "Не удалось завершить операцию\n";
}

// закрытие соединения
ftp_close($conn_id);

*/
?>
</pre>
           
           
           </article>
           <aside></aside>
      </section>
 
      <footer></footer>
   </body>
</html>

