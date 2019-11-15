<?php
//bramynew.ru/assets/cppv/PHP_UTILS/zp/exe/ADD_all_cppvBramy.php
include_once($_SERVER['DOCUMENT_ROOT'].'/assets/cppv/PHP_UTILS/zp/zp.class.php');
$zipCppv=new ZIP_CPPV();
$zipCppv->archive='assets/cppv/COPY/cppv_'.date('d_m_Y').'.zip';
$zipCppv->arrFrom[]='assets/cppv';
$zipCppv->START_IN();
$zipCppv->GET_STATUS();

echo '<br>From assets/cppv<br>';
echo 'To '.$zipCppv->archive;
?>
