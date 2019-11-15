<?php 
  /*
     $recRes=new ResourseAs(array('id'=>976,'fields'=>array("id","pagetitle","longtitle","alias")));
     $recRes->rec['pagetitle'] - "Опора алюминиевая"
     $recRes->TVs['tovar_img']['value'] - "assets/images/our_photo/otk_vorota/dhs20320-opora-rolikovaya.PNG"
   */
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/com/SQLconnect.php");

class ResourseAs{
   public $id=-1;
   public $rec=array();
   public $TVs=array();   
   public $cfg=array('fields'=>array());
	function __construct($config = array()){  
        if(isset($config['fields'])) $this->cfg['fields']=$config['fields'];
        $this->id=$config['id']; 
	$this->rec=$this->getRec();
	$this->getTVs();	   
   }
   function  getRec(){     	
    	$filedsStr=implode(',',$this->cfg['fields']);
		if($filedsStr=='') {$filedsStr="*";}             
		$sql='select '.$filedsStr.' from modx_site_content where id='.$this->id;
      $STH=getSelect($sql);
      $row=$STH->fetch();
      return $row;   
	}
   function getTVs(){
   	$sql='select tvc.*,tv.* 
from modx_site_tmplvar_contentvalues tvc
left outer join modx_site_tmplvars tv on tvc.tmplvarid=tv.id
where tvc.contentid='.$this->id;
      $STH=getSelect($sql);
   	while($row = $STH->fetch()) {  
			$name_=$row['name'];
			$this->TVs[$name_]=$row;		
		}            
	}
};
?>
