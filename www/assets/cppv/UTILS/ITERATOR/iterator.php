<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php"); 


/*
  задается текст SQL
  цикл по запросу
     вызов обратки - в нем по ссылке передается строка запроса
     
     так можно задать много ответок, каждаю будет запускать свою обработку.
     
     
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/ITERATOR/iterator.php");     
$itr=new ResIterator();

/*
 price (4) - руб.        tv price - id=4
 catalog_item_image (5) 
 catalog_item_full_image (8)
 image_tov1 (14) 
*/
/*
$sortStr="";
if(isset($_GET['sort'])){
 if($_GET['sort']=='price') $sortStr=" order by 6 ".$_GET['dir'];
 if($_GET['sort']=='pagetitle') $sortStr=" order by 2 ".$_GET['dir'];
}

$itr->sqlText="select t.id, t.pagetitle, t.parent, t.isfolder,t.introtext,
cast(tv.value as signed) as price, img1.value as img1   
from modx_site_content t
left outer join modx_site_tmplvar_contentvalues tv on tv.contentid=t.id and tv.tmplvarid=4 
left outer join modx_site_tmplvar_contentvalues img1 on img1.contentid=t.id and img1.tmplvarid=5 
left outer join modx_site_tmplvar_contentvalues img2 on img2.contentid=t.id and img2.tmplvarid=8
left outer join modx_site_tmplvar_contentvalues img3 on img3.contentid=t.id and img3.tmplvarid=14 
where 1=1 ";

//echo '<pre>',$itr->sqlText,'</pre>';


$itr->arrUserFuncs[]="myHendler";
$itr->arrUserFuncs[]="myHendlerFolder";
//$itr->arrUserFuncs[]="mHFoldersRefsPlHolder";
$itr->parent=10315;
$itr->level=3;
$itr->sortStr=$sortStr;
//$itr->limit=10;

$itr->START();

//---------------------------------------------------------------------------
/*
print_r($arrParam["row"],true) =>
Array
(
    [id] => 10339     
    [pagetitle] => Панда с листочком муз.
    [parent] => 10316
    [isfolder] => 0
)
*/
/*
function myHendler($arrParam) { if($arrParam["row"]["isfolder"]==1) return;
	$row=$arrParam["row"];
   $dir_=$_SERVER['DOCUMENT_ROOT'].'/assets/media/lists/'.$row['parent'];
   $filePath=$dir_.'/'.$row['id'].'.jpg';
   $src=$_SERVER['DOCUMENT_ROOT'].'/'.$row['img1'];
   $wwwfilePath='/assets/media/lists/'.$row['parent']."/".$row['id'].'.jpg';  

   if(!file_exists($filePath) && file_exists($src)) {
   	if(!is_dir($dir_)) mkdir($dir_, 0777, true);
   	img_resize($src, $filePath, 80, 80); 
   }   

   global $modx;   
   $ref=$modx->makeUrl($row['id']);   
	$introtext=strip_tags($row['introtext']);
	//echo $introtext;
	$price=number_format($row['price'], 0, '', ' ').' р.';
   
echo <<<"HERE"
  <div>
     <a href="{$ref}"> 
     		<img src="{$wwwfilePath}">
	     	<strong>{$price}</strong>
	     	<h4>{$row['pagetitle']}</h4>
	     	<span>{$introtext}</span>
	  </a>   
  </div>  
HERE;
}
//---------------------------------------------------------------------------
function myHendlerFolder($arrParam) { if($arrParam["row"]["isfolder"]==0) return;   
	$row=$arrParam["row"];   
   echo "<h3 class='text-primary'>".$row["pagetitle"]."</h3>";
}
//---------------------------------------------------------------------------
function mHFoldersRefsPlHolder($arrParam) {if($arrParam["row"]["isfolder"]==0) return; 
   $row=$arrParam["row"];   
	   
   //echo "<h3 class='text-primary'>".$row["pagetitle"]."</h3>";
}
//---------------------------------------------------------------------------

*/

include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/UTILS/SqlConnect/SQLconnect.php");

class ResIterator{
    public $sqlText;
    public $arrUserFuncs=array(); 
    public $level=1;    
    public $parent=0;//если "-1" - то без and '  t.".$this->fieldParent."=".$iterParam["parent"]  ', т.е. просто итерация по выборке. без привязки к родителю. 
    public $limit=0;
    public $sortStr="";
    public $fieldId="id";
    public $fieldParent="parent";
    public $userArr=array();
    public $debug=0;
    function __construct(){

    }
    //-------------------------
 	 public function START() {  
 	 	$this->iterate(array("curentLevel"=>1,"parent"=>$this->parent));
    }    
    //-------------------------
    protected function iterate($iterParam){            //add_test_str("iterate $iterParam=".print_r($iterParam,true));
    	if($iterParam["curentLevel"] > 10) return;//защита стэка
    	if($iterParam["curentLevel"] > $this->level) return;
    	$sqlFull=$this->sqlText;
    	   if($iterParam["parent"]>-1){
           $sqlFull=$this->sqlText." and t.".$this->fieldParent."=".$iterParam["parent"]."\n".$this->sortStr;                
    	   }else{
           $sqlFull=$this->sqlText."\n".$this->sortStr;                
    	   }     
    	   
         if($this->limit!==0) $sqlFull=$sqlFull."\n limit ".$this->limit;                                               	   									
   					//add_test_str('$sqlFull='.$sqlFull);         
 	 	   $sth=getSelect($sqlFull);   
			while($row = $sth->fetch()) {  
            $arrParam=array();
            $arrParam["row"]=&$row;
            $arrParam["instance"]=&$this;
            foreach($this->arrUserFuncs as $value){           //  add_test_str('userFunc $value='.$value);
                  call_user_func($value,$arrParam);//myHendler              
            
            }
            if($row["isfolder"]) {  
              $this->iterate(array("curentLevel"=>($iterParam["curentLevel"]+1),"parent"=>$row["id"]));
            }
			}
        			                                          
    }
    //-------------------------
    
    
    

};
