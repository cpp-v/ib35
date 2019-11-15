<?php
//****  include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/ITERATOR/iterForMenu.php");

include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/ITERATOR/iterator.php");
class IterFoMenu extends ResIterator{
   public $rowCount=0;	
   public $arrUserFuncsBeforWhile=array(); 
   public $arrUserFuncsStartCol=array(); 
   public $arrUserFuncsEndCol=array(); 
   public $arrUserFuncsAfterWhile=array(); 
   
   public $folderRow=0;  
   public $numCol=1;
   public $numRowInCol=0;
   public $idx=0;
   public $idCol=0;
    	
	function __construct($config = array()){
		parent::__construct();      				
		$this->sqlText="select t.id, t.pagetitle, t.parent, t.isfolder
           from ".$GLOBALS['arrCcFfGg']['table_prefix']."site_content t
           where t.deleted=0 and t.published=1";
		
				

	}
    //-------------------------
    protected function iterate($iterParam){
    	if($iterParam["curentLevel"] > 5) return;//защита стэка
    	if($iterParam["curentLevel"] > $this->level) return;
    	$sqlFull=$this->sqlText;
      $sqlFull=$this->sqlText." and t.".$this->fieldParent."=".$iterParam["parent"]."\n".$this->sortStr;                
    	   
         if($this->limit!==0) $sqlFull=$sqlFull."\n limit ".$this->limit;     //add_test_str('$sqlFull='.$sqlFull);         
 	 	   $sth=getSelect($sqlFull);   
 	 	   $this->rowCount=$sth->rowCount();

         $arrParam=array();
         $arrParam["instance"]=$this;
         $arrParam["curentLevel"]=$iterParam["curentLevel"];    if($this->debug) echo '<br>bfWile level='.$iterParam["curentLevel"].'<br>';

         foreach($this->arrUserFuncsBeforWhile as $value){
            call_user_func($value,$arrParam);//myHendler            
         } 
         $this->numRowInCol=(int)ceil($this->rowCount/$this->numCol); //будет своя для каждого каталога     
         $this->idxCol=0;
         $this->idx=0;
         
			while($row = $sth->fetch()) {  if($this->debug) echo '<br>inWhile level='.$iterParam["curentLevel"].'<br>';
            $arrParam=array();
            $arrParam["row"]=$row;
            $arrParam["instance"]=$this;
            $arrParam["curentLevel"]=$iterParam["curentLevel"];
            if($this->idxCol==0) {
   	         foreach($this->arrUserFuncsStartCol as $value){   //первая строка в колонке
                  call_user_func($value,$arrParam);//myHendler              
            
            	}  
            }           
            foreach($this->arrUserFuncs as $value){
                  call_user_func($value,$arrParam);//myHendler              
            
            }
            if($row["isfolder"]) { 
              $this->folderRow=&$row; 
              $this->iterate(array("curentLevel"=>($iterParam["curentLevel"]+1),"parent"=>$row["id"]));
            }
            ++$this->idxCol;
            ++$this->idx;
            if($this->numRowInCol<=$this->idxCol || $this->rowCount<=$this->idx) {//или колока кончилась, или общее кол-во. последняя колока может мсодержать меньше строк, чем расчетано
  	         	--$this->idxCol;--$this->idx;//чтобы передать текущие
   	         foreach($this->arrUserFuncsEndCol as $value){
                  call_user_func($value,$arrParam);//myHendler              
            	}  
               $this->idxCol=0;  ++$this->idx;//restore           
            }           
			}//while
															if($this->debug) echo '<br>afterWhile level='.$iterParam["curentLevel"].'<br>';
         foreach($this->arrUserFuncsAfterWhile as $value){
            call_user_func($value,$arrParam);//myHendler            
         } 
			
        			                                          
    }
    //-------------------------
  

};







?>