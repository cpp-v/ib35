<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/assets/cppv/PHP_UTILS/zp/zp.class.php');
$zipCppv=new ZIP_CPPV();
$zipCppv->archive='assets/cppv/phpUtils.zip';
$zipCppv->arrFrom[]='assets/cppv/PHP_UTILS';
$zipCppv->START_IN();
$zipCppv->GET_STATUS();
?>