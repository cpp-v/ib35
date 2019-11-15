<?php
//include_once($_SERVER['DOCUMENT_ROOT']."/assets/aset/com/imR.php");   imR($src,$width,$height);                      
                      include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php"); //delete_test_file();
                        //add_test_str("========= START imR.php ===========");


include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/imgR/gd.php");
function imR($src,$width,$height) {
 $src_raw=urldecode($src); 	
 $src=addslashes($src);
 $src=str_replace(array("%",","), "_", $src);
 
 $posP=strrpos($src,'.');
 $ss1=substr($src,0,$posP);
 $ext=substr($src,$posP+1);
 $fCache=$ss1.'-'.$width.'-'.$height.'.'.$ext;  // add_test_str('$fCache='.$fCache.' $src_raw='.$src_raw);
 if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$fCache)){ 	                  // add_test_str('Not exist');  
	 img_resize($_SERVER['DOCUMENT_ROOT'].'/'.$src_raw, $_SERVER['DOCUMENT_ROOT'].'/'.$fCache, $width, $height);  // add_test_str('$src_raw='.$src_raw);
 }
 return $fCache; 	
}




?>