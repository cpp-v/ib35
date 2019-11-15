<?
/*
include $_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/DEBUG/debugM.php";
$dbg=new CppDebug(array('dir'=>__DIR__));
$dbg->clear(); 
$dbg->add(__FILE__);
$dbg->add(date("d.m.Y H:i:s"));
$dbg->addVar('$rr',$rr);
$dbg->addMix('$obj',$obj);

по умолчанию debug.txt в текущем каталоге 
*/
class CppDebug{
	public $dir="";
   public $fName="";
   public static $arrItems;//CppDebug::$arrItems
   //-------------------------------------------
	function __construct ($config=array()) {
     $this->fName="debug.txt";       
     if($config['dir']) {
       $this->dir=$config['dir'];       			
	  }	
	  if(!is_array(self::$arrItems)) {
	  	self::$arrItems=array();
	  }	
	}
   //-------------------------------------------
   function add($str) {
     $fullPath=$this->dir."/".$this->fName;         
     $f_=fopen($fullPath,"a+");
     fwrite($f_, $str."\r\n");
     fflush($f_);
     fclose($f_);
   }
   //-------------------------------------------
   function addVar($varName,$var) {
     $str=$varName.'='.$var;  
     $this->add($str);
   }
   //-------------------------------------------
   function addVarN($varName) {
     $var=eval("return ".$varName.";");
     $str=$varName.'='.$var;  
     $this->add($str);
   }
   //-------------------------------------------
   function addMix($varName,$var) {
     $str=$varName.'='.print_r($var,true);
     $this->add($str);
   }
   //-------------------------------------------
   function addMixN($varName) {
     $var=eval("return ".$varName.";");
     $str=$varName.'='.print_r($var,true);
     $this->add($str);
   }
   //-------------------------------------------
   function clear() {
     $fullPath=$this->dir."/".$this->fName;         
     if(file_exists($fullPath)){	 
  			unlink($fullPath);	
 	  }
   }
      //-------------------------------------------
   function cppvObjRecurs($obj,$level,$parent,$arrParam,$pref='   '){//array('modxIgnore'=>$modxIgnore,'onlyKey'=>$onlyKey,'maxLevel'=>3)
	  if($level>=$arrParam['maxLevel']) return; 
 //$pref='';
 //for($i=0;$i<$level;++$i) $pref.='     ';
 	
 	
 	  foreach($obj as $k=>$v){
    	 if($k=='modx' && $arrParam['modxIgnore']) continue;
       //if(is_array($v)){ add_test_str($pref.$k.'='.print_r($v,true)); continue;}
     
       if(is_array($v)){ cppvObjRecurs($v,$level++,$parent.' '.$k,$arrParam,$pref.'   '); continue;}
       else if(is_object($v)){cppvObjRecurs($v,$level++,$parent.' '.$k,$arrParam,$pref.'   '); continue;}   
       else{
        //if($arrParam['onlyKey']) add_test_str($pref.'$level='.$level." key=".$k);
        //else 
       }      
     }
     //$level--; 
   }
		//---------------------------------------
};
