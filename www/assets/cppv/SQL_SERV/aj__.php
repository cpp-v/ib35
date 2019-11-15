<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



include_once($_SERVER['DOCUMENT_ROOT']."/test_aset/aset_test.php"); delete_test_file();
                        add_test_str("========= START SQL_SERV/aj.php ===");
                        add_test_str('$_REQUEST='.print_r($_REQUEST,true));

//exit();


$CFG=array(); $CFG["db_init_alredy"]=0;
print($_REQUEST["task"]."<br>");
if($_REQUEST["task"]=="sql_start")
{                                            add_test_str('sql_start');
    print($_REQUEST["sql_text"]);

//	 global $CFG;//['subStr']=$subStr;
    $sql_text=trim($_REQUEST["sql_text"]);
    $subStr=substr($sql_text, 0, 4);
    $subStr=strtoupper($subStr);              add_test_str('$subStr======'.$subStr);
//    $CFG['subStr']=$subStr;

echo "<table>";
if(($subStr==='SELE') || ($subStr==='SHOW') ){     add_test_str('$subStr='.$subStr);
			
GFG_field_list_load();
  
header_out();       
}    
	$sqlText=stripslashes($_REQUEST["sql_text"]);    add_test_str('$sqlText='.$sqlText);
	if($subStr=='SELE'){			
echo "<tbody>";
		$sth=qwery($sqlText);                    
		$n_f=$sth->columnCount();
		while($row=$sth->fetch())
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
	else {		
		qwery($sqlText);  
	}	
   exit();
}
//==========================================================================
if($_REQUEST["task"]=="table_list_load")
{                                     add_test_str("table_list_load *********");      
    $sth=qwery("show tables");        add_test_str("qwery after");     
    while($row = $sth->fetch()){
      print("<option value='".$row[0]."'>".$row[0]."</option>");
    }
 }
//==========================================================================
 
if($_REQUEST["task"]=="meta_start")
{
 if($_REQUEST["meta"]=="meta_create")
 {                                                                                  add_test_str("meta_create =======");

  global $CFG;
  echo "create table ",$_REQUEST["table_name"],"(<br>";  
  $res_=qwery("describe ".$_REQUEST["table_name"]);
  $n_f=mysql_num_fields ($res_);
  $curent_n=0;
  $n_row=mysql_num_rows ($res_);
  while($row_=mysql_fetch_row($res_))
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
   $n_row=mysql_num_rows ($res_);
   if($n_row==0) {echo "Записи не обнаружены"; exit();}
   $n_f=mysql_num_fields ($res_);
   $f_name=$_REQUEST["table_name"].".out";       echo "<h4>Выгрузка в:".$f_name."</h4>";
   $f_=fopen($f_name,"w");
   while($row_=mysql_fetch_row($res_))
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
     echo "<h4>",$_REQUEST["file_"],"</h4>";
     echo "<h3>-",$_SERVER["DOCUMENT_ROOT"],"-</h3>";

     $f_=fopen($_SERVER["DOCUMENT_ROOT"].$_REQUEST["file_"],"r");

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

 else exit();
}
//=========       F U N C           ===================================================================

function db_init()
{
  global $CFG;                                         
  if($CFG["db_init_alredy"]==1) {return;} 
  
  													//echo '$_REQUEST='.print_r($_REQUEST,true);
$host=$_REQUEST["server"];
$dbname=$_REQUEST["db_name"];
$user=$_REQUEST["user"];
$pass=$_REQUEST["passw"];
   global $DBH_AS;  
	$DBH_AS = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);  
	$DBH_AS->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   $DBH_AS->exec("set names utf8");	
	  
                                      //echo 'PDO OK';
  $CFG["db_init_alredy"]=1;
}
//============================================================================
function qwery($text_qery)
{                                       
                                            add_test_str('$text_qery='.$text_qery);
     
    $subStr=substr($text_qery, 0, 4);
    $subStr=strtoupper($subStr);              add_test_str('$subStr======'.$subStr);
    

    db_init();
    global $DBH_AS;                    //echo '$text_qery='.$text_qery;
    if(($subStr==='SELE') || ($subStr==='SHOW')) {            add_test_str('qwery SLE SHOW');
		    										                         add_test_str('$text_qery='.$text_qery);   
      $STH=$DBH_AS->query($text_qery);                           
      return $STH;
    } 
    else{                          
                                   
      try {
                                          
	    		$DBH_AS->exec($text_qery);
    	                               //add_test_str('qwery exec finish');
    	}
    	catch(Exception $e){           //add_test_str('$e->getMessage='.$e->getMessage());
          echo 'Выброшено исключение: ',  $e->getMessage(), "\n";       	
    	
    	}                               
    	                              
 	 }	    
 	 //print_r($DBH_AS->errorInfo());
}
//============================================================================
function GFG_field_list_load()
{
  global $CFG;
  echo "<h3>",$_REQUEST["table_name"],"</h3>";
  //$sth = qwery("select * from ".$_REQUEST["table_name"]." limit 1");
  $qrSQL=$_REQUEST["sql_text"];
  $posLimit=strpos($qrSQL, "limit");
  if(!$posLimit) $sth =qwery($qrSQL." limit 1");
  else  $sth =qwery($qrSQL);
  
  $n_f=$sth->columnCount();
  $CFG["field_count"]=$n_f;
  $CFG["fields_arr"]=array();
  for($i=0;$i<$CFG["field_count"];$i++)
  {
  	     $colMeta=$sth->getColumnMeta($i); 
        $CFG["fields_arr"][$i]=array();
        $CFG["fields_arr"][$i]["name"]=$colMeta['name'];     
        $CFG["fields_arr"][$i]["len"]=$colMeta['len'];
        $CFG["fields_arr"][$i]["type"]=$colMeta['native_type'];
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
//===============================================================================
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

?>


