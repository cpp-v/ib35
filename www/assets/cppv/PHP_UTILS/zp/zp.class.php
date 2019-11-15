<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php");
						delete_test_file();
                  add_test_str("========= ".__FILE__." ===========");



/*
include_once($_SERVER['DOCUMENT_ROOT'].'/assets/cppv/PHP_UTILS/zp/zp.class.php');
$zipCppv=new ZIP_CPPV();
$zipCppv->archive='assets/cppv/arch/test.zip';
$zipCppv->arrFrom[]='assets/cppv/test';
$zipCppv->START_IN();

*/
/*
include_once($_SERVER['DOCUMENT_ROOT'].'/assets/cppv/PHP_UTILS/zp/zp.class.php');
$zipCppv=new ZIP_CPPV();
$zipCppv->archive='assets/cppv/test.zip';
$zipCppv->to='assets/cppv/testUnZip';
$zipCppv->START_OUT();

*/


class ZIP_CPPV{
  public $pathPref; 
  public $archive;
  public $arrFrom=array();
  public $to;//for extract
  private $zip;

  
  function __construct($config=array()) {//***
    $this->pathPref=$_SERVER['DOCUMENT_ROOT'].'/';
    $this->archive="arch.zip";
  }	 //***  
  			//---------------------------------------------------------
  public function START_IN() {
   $this->zip = new ZipArchive(); 	
	if ($this->zip->open($this->pathPref.$this->archive, ZipArchive::CREATE)!==TRUE) {
   	 exit("Невозможно открыть <".$this->archive.">\n");
	}    	
  	
  	foreach($this->arrFrom as $v){
      $fullPath=$this->pathPref.$v;
      if(!file_exists($fullPath)) continue;       	    
  	   if(is_dir($fullPath)){ $this->addDir($fullPath);}  
  	   else $this->addFile($fullPath);
  	}
  	
  	
  }//START_IN
  			//---------------------------------------------------------
  public function START_OUT() {
 	$this->zip = new ZipArchive();
	$res = $this->zip->open($this->pathPref.$this->archive);
	if ($res === TRUE) {
	  	$this->zip->extractTo($this->pathPref.$this->to);
	  	$this->zip->close();
	}
	else{
     echo 'Не удалось открыть архив -'.$this->pathPref.$this->archive;	
	}

  	
  	
  }//START_OUT

  			//---------------------------------------------------------

  public function GET_STATUS() {  
  
    echo "numfiles: " . $this->zip->numFiles . "\n";
    echo "status:" . $this->zip->status . "\n";
  
  }//GET_STATUS
  			//---------------------------------------------------------77-58-36
  private function addDir($dir){
  			$d = dir($dir);
			while (false !== ($entry = $d->read())) {
				if ($entry == "." || $entry == "..") continue;
				$fullPath=$dir.'/'.$entry;
				if(is_dir($fullPath)) $this->addDir($fullPath);
				else $this->addFile($fullPath);
			}
			$d->close();  
  }  
  			//---------------------------------------------------------
  private function addFile($fullPath){
  	  $relPath=str_replace($this->pathPref,"",$fullPath);  add_test_str('$relPath='.$relPath); add_test_str('$fullPath='.$fullPath);
     $this->zip->addFile($fullPath,$relPath);       
  }  
  			//---------------------------------------------------------
  
  
}//class




?>