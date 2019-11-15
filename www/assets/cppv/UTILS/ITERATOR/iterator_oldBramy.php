<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php"); 
/*
  задается текст SQL
  цикл по запросу
     вызов обратки - в нем по ссылке передается строка запроса
     
     так можно задать много ответок, каждаю будет запускать свою обработку.
     
     
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/com/classes/ITERATOR/iterator.php");








     
*/

include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/com/SQLconnect.php");

class ResIterator{
    public $sqlText;
    public $arrUserFuncs=array(); 
    public $level=1;    
    public $parent=0;
    public $limit=0;
    public $sortStr="";    
    
    function __construct(){
    
    }
    //-------------------------
 	 public function START() {  
 	 	$this->iterate(array("curentLevel"=>1,"parent"=>$this->parent));
    }    
    //-------------------------
    protected function iterate($iterParam){
    	if($iterParam["curentLevel"] > 5) return;//защита стэка
    	if($iterParam["curentLevel"] > $this->level) return;
    	$sqlFull=$this->sqlText;
    	   if($iterParam["parent"]>-1){
           $sqlFull=$this->sqlText." and t.parent=".$iterParam["parent"]."\n".$this->sortStr;                
    	   }else{
           $sqlFull=$this->sqlText."\n".$this->sortStr;                
    	   }     
    	   
         if($this->limit!==0) $sqlFull=$sqlFull."\n limit ".$this->limit;
                                               	   									//echo '<pre>',$sqlFull,'</pre>';

	    	   					//add_test_str('$sqlFull='.$sqlFull);         
 	 	   $sth=getSelect($sqlFull);   
			while($row = $sth->fetch()) {  
            $arrParam=array();
            $arrParam["row"]=$row;
            
            foreach($this->arrUserFuncs as $value){
                  call_user_func($value,$arrParam);//myHendler              
            
            }
            

            
            if($row["isfolder"]) {  
              $this->iterate(array("curentLevel"=>($iterParam["curentLevel"]+1),"parent"=>$row["id"]));
            }
			}
        			                                          
    }
    //-------------------------
    
    
    

};
