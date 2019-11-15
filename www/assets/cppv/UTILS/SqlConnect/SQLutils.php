<?php
// include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/SQLutils.php");
function getSqlUpdateStr($table,$row,$id_update_field_name){
/*
$upd_str=getExtUtilUpdateStr("girls",$_POST['results'],'id');
$_POST=Array
(
    [results] => {"v0":10,"id":1}
    [xaction] => update
)
*/
  $fields=json_decode($row,true);  //(array) - иначе создаст объект, а с ним геморою.....
  $upd_str="update ".$table." SET";  $fieds=" "; $where=" where ".$id_update_field_name."=";
  $i=0; 
  foreach($fields as $k=>$v){
    if($k==$id_update_field_name){
      $where.=$v;
    }
    else{
       if($i>0) $fieds.=',';
       $fieds.=$k."='".$v."'";
      $i++;
    }
  }  
  $upd_str.=$fieds.$where;
  return $upd_str;  
}
//===================================================================================
function getSqlUpdateStrFromArr($table,$row,$id_update_field_name='id'){
  $upd_str="update ".$table." SET";  $fieds=" "; $where=" where ".$id_update_field_name."=";
  $i=0; 
  foreach($row as $k=>$v){     $v=addslashes($v);
    if($k==$id_update_field_name){
      $where.=$v;
    }
    else{
       if($i>0) $fieds.=',';
       $fieds.=$k."='".$v."'";
      $i++;
    }
  }  
  $upd_str.=$fieds.$where;
  return $upd_str; 
}
//===================================================================================
function getSqlInsertStrFromArr($table,$row){
  $ins_str="insert into ".$table." ";  $fieds=" ("; $values=" values(";
  $i=0; 
  foreach($row as $k=>$v){     $v=addslashes($v);
       if($i>0) {$fieds.=','; $values.=',';}
       $fieds.=$k;   $values.='\''.$v.'\'';
      $i++;
  }  
   $fieds.=") "; $values.=") ";
  $ins_str.=$fieds.$values;
  return $ins_str; 
}
//===================================================================================
function getSthColumnsMeta($sth) {
  $arrForRet=array();
  $n_f=$sth->columnCount();
  for($i=0;$i<$n_f;$i++)
  {
  	     $arrForRet[]=$sth->getColumnMeta($i); 
  }
  return $arrForRet;
}
//===================================================================================





