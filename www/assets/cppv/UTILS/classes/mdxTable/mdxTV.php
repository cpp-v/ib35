<?php
/*
     include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/classes/mdxTable/mdxTV.php");
     $mdxTV=new mdxTableTV();
     $mdxTV->idVal=1;//$contentid=1 
     $mdxTV->getValue(126);  // $this->tmplvarid=126
     $mdxTV->getValues();   // $this->idVal=1
     $mdxTV->getValues(12);  
          или
     $mdxTV=new mdxTableTV(array('tmplvarid'=>126,'contentid'=>12));  	

*/

include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/classes/mdxTable.php");
class mdxTableTV extends mdxTable{
	public $tmplvarid;
	public $contentid;	
	function __construct($config = array()){ 			
      parent::__construct($config);
		$this->tableName='site_tmplvar_contentvalues';           	  
	   $this->idFieldName='contentid';												
	   $this->fieldsForRet[]='tmplvarid';
	   $this->fieldsForRet[]='contentid';			
	   $this->fieldsForRet[]='value';

	   if(isset($config['contentid'])){
        $this->contentid=$config['contentid'];
        $this->idVal=$config['contentid'];  
        if(!isset($config['tmplvarid'])) {
        $this->getValues();	
        }
	   }
	   if(isset($config['tmplvarid'])){//если передано id tv - вызываем get()
        $this->tmplvarid=$config['tmplvarid'];  
        $this->getValue($this->tmplvarid); 
      }      
      
	}
	public function getValue($tmplvarid){
		$this->tmplvarid=$tmplvarid;
		$this->and='and tmplvarid='.$this->tmplvarid;
	   $this->getRec($this->idVal);        
      if(!$this->row) $this->row['value']=''; 	   
	   return $this->row['value'];
	}	
	public function getValues($contentid=-1){//можно вызвать для другого ресурса
		if($contentid==-1) {$contentid=$this->idVal;}
      $this->arrRet=array();		
		$this->and='';
	   $this->getRec($contentid);        
      $this->makeArrRet('tmplvarid');
      return $this->row;	
	}
	
};


?>



