<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php"); //delete_test_file();
                        //add_test_str(__FILE__);
                        //add_test_str(date("d.m.Y H:i:s"));


	/*
     include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/classes/mdxTable.php");
     $mdxT=new mdxTable();     
     $mdxT->getRec(12);     
     $id=$mdxT->row('id');// а можно сразу $id=$mdxT->getRec(12,'id');  

   */
   
   
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/SqlConnect/SQLconnect.php");
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/SqlConnect/SQLutils.php");

class mdxTable{
				//init fields
	public $tablePrefix;
	public $tableName;
	public $idFieldName;
	public $idVal;
	public $fieldsForRet;
	public $select;
	public $from;
	public $where;
	public $and;

	public $orderBy;
	public $sqlRest;
	public $sqlFull;
			//ret fields
	public $row;		
	public $sth;		
	public $arrRet;  	
	public $arrFields;  		

	function __construct($config=array()){
	  //global $arrCcFfGg;	  
     if(isset($config['fieldsForRet'])) $this->fieldsForRet=$config['fieldsForRet'];
     else $this->fieldsForRet[]='id';  
     $this->tablePrefix=$GLOBALS['arrCcFfGg']['table_prefix'];   
     $this->tableName='site_content';
     $this->idFieldName='id';
     $this->fieldsForRet=array();        
     $this->orderBy='';
     $this->sqlRest='';
     $this->idVal=0;
     $this->arrRet=array();
     $this->and='';     
   }
	//----------------------------------------------------------------------------------------------
   public function getRec($id,$fieldForRet=''){     	  // add_test_str('### '.__METHOD__);
      $this->idVal=$id;
    	$fieldsStr=implode(',',$this->fieldsForRet);
		if($fieldsStr=='') {$fieldsStr="*";}      
		$this->select='select '.$fieldsStr;
      $this->from='from '.$this->tablePrefix.$this->tableName;
      $this->where='where '.$this->idFieldName.'='.$this->idVal;

		$this->sqlFull=$this->select.' '.$this->from.' '.$this->where.' '.$this->and.' '.$this->orderBy.' '.$this->sqlRest;
  // echo '$this->sqlFull='.$this->sqlFull;     
	                                                //add_test_str('$this->sqlFull='.$this->sqlFull);


      //echo '$this->sqlFull='.$this->sqlFull.PHP_EOL; //exit(); 
      $this->sth=getSelect($this->sqlFull);
      $this->row=$this->sth->fetch();               //add_test_str('$this->row='.print_r($this->row,true));
      if($fieldForRet) return $this->row[$fieldForRet];
      return $this->row;               
	}
	//----------------------------------------------------------------------------------------------
  public function setRec($row) {
  	$id=null;
  	if(isset($row[$this->idFieldName])) {
    $id=$this->getRec($row[$this->idFieldName],$this->idFieldName);
   }
       
   if($id){//есть такая запись      
     $sqlText=getSqlUpdateStrFromArr($this->tablePrefix.$this->tableName,$row,$this->idFieldName);
   }else{
     $sqlText=getSqlInsertStrFromArr($this->tablePrefix.$this->tableName,$row);
   }
		echo '$sqlText='.$sqlText.PHP_EOL;	  
	  
	  $res=AsSqlExec($sqlText);   
  } 
//----------------------------------------------------------------------------------------------   
  public function instRecCM($row) { //с проверкой наличия полей, т.е. можно подсунуть кучу левых полей, они отсекутся 
                                    //need befor $this->getTableFieds()      
   $sqlText=$this->getSqlInsertStrF($row);
	//echo '$sqlText='.$sqlText.PHP_EOL;	  
   $res=AsSqlExec($sqlText);   
  } 
//----------------------------------------------------------------------------------------------   
  public function makeArrRet($fieldForArrRet) { // $fieldForArrRet-поле индексации $fieldForArrRet='tmplvarid';
        if(!isset($fieldForArrRet)) $fieldForArrRet=$this->idFieldName;//если не назначено - то по значению индекса
        if(!$this->row) return; 
        
       	$ind=$this->row[$fieldForArrRet];  //уже есть одна строка. для $this->sth сделан один fetch
        	foreach($this->fieldsForRet as $field){
        	 $this->arrRet[$ind][$field]=$this->row[$field];        	
        	}
   
        	while($row = $this->sth->fetch()) {//например для TV по полю tmplvarid - будет несколько строк. поскольку одтн fetch сделан - просто донабираем
        	$ind=$row[$fieldForArrRet];
        	foreach($this->fieldsForRet as $field){
        	 $this->arrRet[$ind][$field]=$row[$field];        	
        	}
		}
   }
//----------------------------------------------------------------------------------------------   
  public function getTableFieds(){
    $sqlText='select * from '.$this->tablePrefix.$this->tableName.' limit 1'; 
    $sth=getSelect($sqlText);
    $arrMetaCols=getSthColumnsMeta($sth);
    foreach($arrMetaCols as $v){
    	$nameField=$v['name'];
      $this->arrFields[$nameField]=$v;
    }    
  }
//----------------------------------------------------------------------------------------------
  public function getSqlInsertStrF($row){ //need befor $this->getTableFieds()
   $table=$this->tablePrefix.$this->tableName;
  	$ins_str="insert into ".$table." ";  $fieds=" ("; $values=" values(";
  	$i=0; 
  	foreach($row as $k=>$v){
  		if(isset($this->arrFields[$k])) {//проверка наличия     
  	      $v=addslashes($v);
         if($i>0) {$fieds.=','; $values.=',';}
         $fieds.=$k;   $values.='\''.$v.'\'';
         $i++;
      } //проверка наличия
  	}  
   $fieds.=") "; $values.=") ";
   $ins_str.=$fieds.$values;
   return $ins_str; 
  }
//----------------------------------------------------------------------------------------------
  public function removeOne($id){ 
    $sqlText='delete from '.$this->tablePrefix.$this->tableName.' where '.$this->idFieldName.'='.$id.' LIMIT 1';
    $res=AsSqlExec($sqlText);
  }    	
};
?>


