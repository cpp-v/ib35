<?php
   /*
      include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/PHP_UTILS/cpy/cpy.class.php");
      $fdU=new FDUtils();
      $fdU->from="";
      $fdU->to="";
      $fdU->rewrite=true;
      $fdU->START();
   */


  class FDUtils{
    public $from;
    public $to;
    public $pathPref=$_SERVER['DOCUMENT_ROOT'].'/'; 
    public $rewrite = true;
    
    function __construct($config=array()) {//***
    	
    }	 //***   
        //----------------------------------------------------    
    private function COPY($from, $to, $rewrite) {//***
		if (is_dir($from)) {
			@mkdir($to);
			$d = dir($from);
			while (false !== ($entry = $d->read())) {
				if ($entry == "." || $entry == "..") continue;
				$this->COPY($from.'/'.$entry, $to.'/'.$entry, $rewrite);
			}
			$d->close();
		} else {
			if (!file_exists($to) || $rewrite)
			copy($from, $to);
		}    	
    } //*** 
        //----------------------------------------------------
    public function START() {//***
       COPY($this->from, $$this->to, $$this->rewrite);
    }//***
  }//class
?>