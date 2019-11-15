<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php"); //delete_test_file();  
                        //add_test_str("========= START ".__FILE__." ===========");add_test_str(date("d.m.Y H:i:s"));
//add_test_str('<pre>');  
   

/*
	
     include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/classes/mdxTable/mdxRes.php");
     $mdxRes=new mdxTableRes();
     $mdxRes->$fieldsForRet[]='pagetitle';
     $mdxRes->$fieldsForRet[]='parent';          
     $mdxRes->getRec(1);     
     $name=$mdxRes->row('pagetitle');// а можно сразу $pagetitle=$mdxT->getRec(12,'pagetitle');  - но тогда вернет только одно поле
     или
     $mdxRes=new mdxTableRes(array('id'=>12,'fieldsFoRet'=>array("id","pagetitle","longtitle","alias","description","parent","introtext")));  	
	
	
	  $arrParents=array();
	  mdxTableRes::getParentsIds(12,$arrParents);
	
*/
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/classes/mdxTable.php");
class mdxTableRes extends mdxTable{
	public $ar;
	public $contentid;	
	function __construct($config = array()){ 			
      parent::__construct($config);
                                // add_test_str('### '.__METHOD__);
                                // add_test_str('$config='.print_r($config,true));                                  
                                 
      if(isset($config['id'])){//если передано ID - вызываем get()
      
      
        $this->idVal=$config['id'];  
        $this->getRec($this->idVal); 
      }      
      
	}
	//--------------------------------------------------------	
	static public function getParentsIds($idRes,&$arrRet,$depth= 10){     
		$textSQL='select parent from '.$GLOBALS['arrCcFfGg']['table_prefix'].'site_content where id='.$idRes;
   									
   	$sth=getSelect($textSQL);   
   	$row = $sth->fetch();   
	   if($row) { 
			 $arrRet[] = $row['parent'];   	   
		}             	
	   					
      if ($row) {
         if ($depth) {                    
		      mdxTableRes::getParentsIds($row['parent'],$arrRet,--$depth);
         }
      }
      return;
	}	
	//--------------------------------------------------------
	public function getChieldsIds(){
		   $arrForRet=array(); $arrForRet[]=$this->idVal;//добавим текущий id, иначе не найдет потомков-страниц прямых
		   
	      $this->getChFoldersIds($this->idVal,$arrForRet,$depth= 6);
         //return $arrForRet; 
         								   			
         $idsParents = implode(',',$arrForRet);   								
	      $sql='select c.id from '.$this->tablePrefix.'site_content c where c.parent in('.$idsParents.') and c.isfolder=0 and c.published=1 and deleted=0';
					//echo 	$sql;						  
         $sth=getSelect($sql);
	      $arrID=array();            
	      while($row = $sth->fetch()){$arrID[]=$row['id'];}
	      return $arrID;
	      		
	}
	//--------------------------------------------------------
	private function getChFoldersIds($idsStr,&$arrF,$depth= 6) {
		
	 $textSQL='select id,isfolder  from '.$this->tablePrefix.'site_content where isfolder=1 and parent in ('.$idsStr.')
	 and published=1 and deleted=0'; //echo $textSQL;
	 
        //add_test_str('$textSQL='.$textSQL);         	 
	 
    $idx = array(); 
    $sth=getSelect($textSQL);   
	 while($row = $sth->fetch()) {  
			 $idx[] = $row['id'];     	
	 }                                          
	 $arrF=array_merge($arrF,$idx);    
     										 
	 $depth--; 
	 $idx = implode(',',$idx);
            if (!empty($idx)) {
                if ($depth) {                    
                    $this->getChFoldersIds($idx,$arrF,$depth);
                }
            }
            
            return;

	 }
};

//add_test_str('</pre>');
?>



