<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/assets/cppv/PHP_UTILS/zp/zp.class.php');
$zipCppv=new ZIP_CPPV();
$zipCppv->archive='assets/cppv/test.zip';
$zipCppv->to='assets/cppv/testUnZip';
$zipCppv->START_OUT();
$zipCppv->GET_STATUS();
?>