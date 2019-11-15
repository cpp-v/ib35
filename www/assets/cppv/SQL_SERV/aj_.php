<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$CFG=array(); $CFG["db_init_alredy"]=0;
$ARR_FIELD=array();
print($_REQUEST["task"]."<br>");
//================================================    S Q L - запрос    ====================
if($_REQUEST["task"]=="sql_start")
{
print($_REQUEST["sql_text"]);
echo "<table>";

$res=qwery($_REQUEST["sql_text"]);
$n_f=mysql_num_fields ($res);

//GFG_field_list_load();
GFG_field_list_load_2018($res);

header_out();




echo"<tbody>";
while($row=mysql_fetch_array($res))
{
    echo "<tr>";
    for($i=0;$i<$n_f;$i++)
    {
      echo "<td>",$row[$i],"</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";
}
//=============================================================================================
if($_REQUEST["task"]=="table_list_load")
{
    //print("table_list_load"); exit();
    $res=qwery("show tables");
    while($row=mysqli_fetch_array($res))
    {
      print("<option value='".$row[0]."'>".$row[0]."</option>");

    }

 }
if($_REQUEST["task"]=="meta_start")
{
 if($_REQUEST["meta"]=="meta_create")
 {
  global $CFG;
  echo "create table ",$_REQUEST["table_name"],"(<br>";
  $res_=qwery("describe ".$_REQUEST["table_name"]);
  $n_f=mysqli_num_fields ($res_);
  $curent_n=0;
  $n_row=mysqli_num_rows ($res_);
  while($row_=mysqli_fetch_row($res_))
  { $curent_n++;
      for($i_=0;$i_<$n_f;++$i_)
      {
          echo $row_[$i_], " ";
      }
     if($n_row!=$curent_n){echo ",";}
      echo "<br>";
  }
  echo ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
 }
 else if($_REQUEST["meta"]=="meta_out")
 {
   echo "<h3>meta OUT</h3>";
   global $CFG;
   $res_=qwery("select * from ".$_REQUEST["table_name"]);
   $n_row=mysqli_num_rows ($res_);
   if($n_row==0) {echo "Записи не обнаружены"; exit();}
   $n_f=mysqli_num_fields ($res_);
   $f_name=$_REQUEST["table_name"].".out";       echo "<h4>Выгрузка в:".$f_name."</h4>";
   $f_=fopen($f_name,"w");
   while($row_=mysqli_fetch_row($res_))
   {   $str_="";
       for($i_=0;$i_<$n_f;++$i_)
       {
          $str_=$str_.$row_[$i_]."~$@";
       }
       $str_=$str_."\n";
       fputs($f_,$str_);
   }
   fclose($f_);
   echo "<pre>";
   readfile($f_name);
   echo "</pre>";
 }
 else if($_REQUEST["meta"]=="meta_in")
 {
     echo "<h3>meta IN</h3>";
     global $CFG;
     echo "<h4>",'$_REQUEST["file_"]=',$_REQUEST["file_"],"</h4>";
     echo "<h4>",'$_SERVER["DOCUMENT_ROOT"]',$_SERVER["DOCUMENT_ROOT"],"</h4>";
     $fullName=$_SERVER["DOCUMENT_ROOT"].'/assets/cppv/SQL_SERV/'.$_REQUEST["file_"];
     echo "<h4>",'full file name=',$fullName,"</h4>";
     if(!file_exists($fullName)){
       echo "<h3 style='color:red;'>",'Файл не обнаружен. Расчет прерван!',"</h3>";
      exit();
     }
     echo "<h3 style='color:green;'>",'Файл обнаружен. Все ОК.',"</h3>";

     $f_=fopen($fullName,"r");
     if($f_)  echo "<h3 style='color:green;'>",'Файл открыт. ОК.',"</h3>";
     else{echo "<h3 style='color:red;'>",'Ошибка. Файл НЕ открыт.',"</h3>"; exit();}


     while(!feof($f_))
     {
         $str_=fgets($f_);
         $str_= addslashes($str_);
         echo $str_,"<br>";
         $arr_=explode("~$@",$str_);
         //echo 'count=',count($arr_), '<br>';
         $str_finish="";
         $field_count_=count($arr_)-1;
         if($field_count_==0) continue;
         for($i_=0;$i_<$field_count_;$i_++)
         {
           //echo $arr_[$i_],"<br>";
           if(strlen($str_finish)!=0)
           {
             $str_finish=$str_finish.", '".$arr_[$i_]."'";
           }
           else
           {
             $str_finish="'".$arr_[$i_]."'";
           }
         }
         echo "str_finish=",$str_finish,"<br>";
         $str_sql="insert into ".$_REQUEST["table_name"]." values (".$str_finish.")";
         echo $str_sql,"<br>";
         $res_=qwery($str_sql);
     }
     fclose($f_);
 }
 else if($_REQUEST["meta"]=="meta_csv")
 {
   echo "<h3>meta OUT</h3>";  echo $_REQUEST["sql_text"],'<br/>';
   global $CFG;
   $res_=qwery($_REQUEST["sql_text"]);   //$res_=qwery("select * from ".$_REQUEST["table_name"]);
   $n_row=mysql_num_rows ($res_);
   if($n_row==0) {echo "Записи не обнаружены"; exit();}
   $n_f=mysql_num_fields ($res_);
   $f_name=$_REQUEST["table_name"].".csv";       echo "<h4>Выгрузка в:".$f_name."</h4>";
   $f_=fopen($f_name,"w");
   while($row_=mysql_fetch_row($res_))
   {   
     fputcsv($f_, $row_, ';');   
   }
   fclose($f_);
   echo "<pre>";
   readfile($f_name);
   echo "</pre>";
 }

 else exit();
}

function db_init()
{
  global $CFG;
  if($CFG["db_init_alredy"]==1) {return;}
  $db_serv=mysqli_connect($_REQUEST["server"],$_REQUEST["user"],$_REQUEST["passw"]);
  $k=mysqli_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
  mysqli_select_db($_REQUEST["db_name"],$db_serv);
  $CFG["db_init_alredy"]=1;
}

function qwery($text_qery)
{
    db_init();
    $res=mysqli_query($text_qery);
    return $res;
}

function GFG_field_list_load()
{
  global $CFG;
  echo "<h3>",$_REQUEST["table_name"],"</h3>";
  $res = qwery("select * from ".$_REQUEST["table_name"]." limit 1");

  $n_f=mysqli_num_fields($res);
  //echo "num_fields=",$n_f,"<br>";
  $CFG["field_count"]=$n_f;
  $CFG["fields_arr"]=array();
  for($i=0;$i<$CFG["field_count"];$i++)
  {
        $CFG["fields_arr"][$i]=array();
        $CFG["fields_arr"][$i]["name"]=mysqli_field_name($res,$i);
        $CFG["fields_arr"][$i]["len"]=mysqli_field_len($res,$i);
        $CFG["fields_arr"][$i]["type"]=mysqli_field_type($res,$i);
  }
  return;
  $res=qwery("show columns from ".$_REQUEST["table_name"]);
  $n_r=mysqli_num_rows($res);

  $CFG["field_count"]=$n_r;
  $CFG["fields_arr"]=array();
  for($i=0;$i<$CFG["field_count"];$i++)
  {
            $CFG["fields_arr"][$i]=array();
      $row_ = mysql_fetch_row($res);
            $CFG["fields_arr"][$i]["name"]=$row_[0];
            $CFG["fields_arr"][$i]["len"]=$row_[1];
            $CFG["fields_arr"][$i]["type"]=$row_[2];
   }
}
function header_out()
{
    global $CFG;
    for($i=0;$i<$CFG["field_count"];$i++)
    {
        if($CFG["fields_arr"][$i]["type"]=="text" || $CFG["fields_arr"][$i]["type"]=="string")
        {
          echo '<col align="left" style="width: 180px;" />';
        }
        else{echo '<col align="right"/>';}



    }
    echo "<thead><tr>";
    for($i=0;$i<$CFG["field_count"];$i++)
    {
       echo "<th>";
       echo $CFG["fields_arr"][$i]["name"]," ";
       echo $CFG["fields_arr"][$i]["len"]," ";
       echo $CFG["fields_arr"][$i]["type"]," ";
       echo "</th>";
    }
    echo "</thead></tr>";
}
//=========================================================================
function GFG_field_list_load_2018(&$res)
{

  global $CFG;
  echo "<h3>",$_REQUEST["table_name"],"</h3>";
  //$res = qwery("select * from ".$_REQUEST["table_name"]." limit 1");

  $n_f=mysqli_num_fields($res);
  //echo "num_fields=",$n_f,"<br>";
  $CFG["field_count"]=$n_f;
  $CFG["fields_arr"]=array();
  for($i=0;$i<$CFG["field_count"];$i++)
  {
        $CFG["fields_arr"][$i]=array();
        $CFG["fields_arr"][$i]["name"]=mysqli_field_name($res,$i);
        $CFG["fields_arr"][$i]["len"]=mysqli_field_len($res,$i);
        $CFG["fields_arr"][$i]["type"]=mysqli_field_type($res,$i);
  }
  return;
  $res=qwery("show columns from ".$_REQUEST["table_name"]);
  $n_r=mysql_num_rows($res);

  $CFG["field_count"]=$n_r;
  $CFG["fields_arr"]=array();
  for($i=0;$i<$CFG["field_count"];$i++)
  {
            $CFG["fields_arr"][$i]=array();
      $row_ = mysql_fetch_row($res);
            $CFG["fields_arr"][$i]["name"]=$row_[0];
            $CFG["fields_arr"][$i]["len"]=$row_[1];
            $CFG["fields_arr"][$i]["type"]=$row_[2];
   }
}



?>


