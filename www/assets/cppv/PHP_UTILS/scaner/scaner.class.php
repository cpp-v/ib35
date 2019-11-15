<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php");
						//delete_test_file();
                  //add_test_str("========= START /assets/cppv	/PHP_UTILS/scaner/scaner.class.php ===========");
   //================================================================================
class cppvScaner{
   public $start_folder;
   
   public $arrFilterIn;   //только вхождение  
   public $arrFiltrInMask; //выборка *.png, *mail*  если *. ... то по расширению  
	public $arrFiltrInExt;	// если *mail - по маске, 
			  					   // если mail.php - четко по файлу
								  
   public $arrFilterOut;     //на вылет
	public $arrFilterOutMask; //аналогично In, но на вылет
	public $arrFilterOutExt;
	public $arrTimesName;
   public $level;
   public $OnlyIn;
      
   public $strForFind;   
   public $notStringFoFind;
   
      
   //public $period = 86400 * $days   
   public $period;
   private $pieceOfFind;
   
	function __construct($config = array('days'=>1)){  
	    $this->start_folder = $_SERVER['DOCUMENT_ROOT'];
	    $this->arrFilterOut=array();
	    $this->arrFilterIn=array();
	    $this->arrFiltrInExt=array();
	    $this->arrFiltrOutExt=array();
	    $this->arrFiltrInMask=array();
	    $this->arrFiltrOutMask=array();
	    
	    $this->arrTimesName=array();
	    $this->level=6;
	    $this->period = 86400 * $config['days'];
	    $this->OnlyIn=false;
	    $this->strForFind="";
   }
   
   //================================================================================
   function FillMasks(){
   	//включаемый поиск  
	   foreach($this->arrFilterIn as $filterItem){
	   	$this->OnlyIn=true;
			if($filterItem[0]=='*') { //'*.jpg'  - откидываем картинки(расширение jpg)
           if($filterItem[1]=='.'){ 			
			 	 $extFilter=substr($filterItem,2);   //add_test_str('$extFilter='.$extFilter);
		  	    if($extFilter){
		         $this->arrFiltrInExt[]=strtoupper($extFilter);
		  	    }		  
		  	  }else{
			 	 $maskFilter=substr($filterItem,1);   //add_test_str('$extFilter='.$extFilter);
		  	    if($maskFilter){
		         $this->arrFiltrInMask[]=strtoupper($maskFilter);
		  	    }		  
		  	  }		  	   
			}else {
		         $this->arrFiltrInMask[]=strtoupper($filterItem);
			}
			 
  		}
   	//исключаемый поиск  
	   foreach($this->arrFilterOut as $filterItem){
			if($filterItem[0]=='*') { //'*.jpg'  - откидываем картинки(расширение jpg)
           if($filterItem[1]=='.'){ 			
			 	 $extFilter=substr($filterItem,2);   //add_test_str('$extFilter='.$extFilter);
		  	    if($extFilter){
		         $this->arrFiltrOutExt[]=strtoupper($extFilter);
		  	    }		  
		  	  }else{
			 	 $maskFilter=substr($filterItem,1);   //add_test_str('$extFilter='.$extFilter);
		  	    if($maskFilter){
		         $this->arrFiltrOutMask[]=strtoupper($maskFilter);
		  	    }		  
		  	  }		  	   
			} 
  		}
  		if(strlen($this->strForFind)<2){$this->notStringFoFind=true;}  		
  		
   }
      //===========================   function FillMasks()    =================================================
   //============================================================================================      
   function FindString($folder,$file){
      if($this->notStringFoFind) return false;
      $fullPath=$folder.'/'.$file;
      if(is_dir($fullPath)) return false; 
      $fCont=file_get_contents($fullPath);     
      $res=strpos($fCont,$this->strForFind);  // add_test_str('$fullPath='.$fullPath.'   $this->strForFind='.$this->strForFind);
      
      
      if($res){
      	$startPos=$res;
      	if($res>30) $startPos=$res-30;  
	      $this->pieceOfFind=substr($fCont,$startPos, 100);
      	return false;
      }
      else {return true;}
   }   
      //===========================   function FindString()    =================================================
   
   //============================================================================================      
   function Filtr($folder,$file){ //return true чтоб отфильтровать(выкинуть)
      
   //которые включаем
      if(in_array ($file, $this->arrFilterIn))  return false;       
               //расширения  
         $posPointerFile=strrpos($file,'.');
         $extFile=substr($file, $posPointerFile+1);  
     		$extFile=strtoupper($extFile);

		foreach($this->arrFiltrInExt as $filterExt){   //add_test_str('$filterExt='.$filterExt.'   $extFile='.$extFile);
	 	   	if($extFile==$filterExt) {	 	     	 //add_test_str('YES!!!');
	 	     		 return false;
	 	   	}
		}	
					//maska	
			          //по маске
  			foreach($this->arrFiltrInMask as $filterMask){ 
	 	   	if(strpos(strtoupper($file),$filterMask)) {	 	     	 
	 	     		 return false;
	 	   	}
			}	


                 //если есть включаемые, то обрвываем обработку, но только для файлов. директории нам нужны

      $fullPath=$folder.'/'.$file;
      $isFile=is_file($fullPath);      
      if($this->OnlyIn && $isFile) return true;
   //которые откидываем
            // Пропускаем текущую папку, родительскую папку и папки из фильтруемых
         if (($file == '.') || ($file == '..') || (in_array ($file, $this->arrFilterOut))) return true; //



  			foreach($this->arrFiltrOutExt as $filterExt){   //add_test_str('$filterExt='.$filterExt.'   $extFile='.$extFile);
	 	   	if($extFile==$filterExt) {	 	     	 //add_test_str('YES!!!');
	 	     		 return true;
	 	   	}
			}	
			          //по маске
  			foreach($this->arrFiltrOutMask as $filterMask){ 
	 	   	if(strpos(strtoupper($file),$filterMask)) {	 	     	 
	 	     		 return true;
	 	   	}
			}	
			
 		return false; 	
   	
   }	    
      //===========================   function Filtr($file)  =================================================
   //============================================================================================      
   function Start($folder,$level){
											//add_test_str('$this->arrFilterOut='.print_r($this->arrFilterOut,true));   	
											//add_test_str('$this->arrFiltrOutExt='.print_r($this->arrFiltrOutExt,true));   	
											//add_test_str('$this->arrFiltrOutMask='.print_r($this->arrFiltrOutMask,true));   	
   	                           //add_test_str('$folder='.$folder);
   	                           //add_test_str('$level='.$level);
     if($level==0) { return;}   
     $files = scandir ($folder); 
     foreach ($files as $file){
            if($this->Filtr($folder,$file)) continue;  
		      if($this->FindString($folder,$file))	 continue;													                  
                                                      
     
            $item = $folder.'/'.$file;                //$isFile=is_file($item);                   
            
            														//if($isFile) {
            														//	add_test_str('$item='.$item);
            														//}
            if (is_dir ($item)) {
                $this->Start($item,$level-1);
            } else{
                $stat_info = stat ($item);// Если текущий элемент - файл, то получаем информацию о файле
                $d_=time () - $stat_info['mtime'];
                //add_test_str('$this->period='.$this->period.'      timeElapsed='.$d_);
/*                
$Sc->arrTimesName[]='atime';//last access
$Sc->arrTimesName[]='mtime';//last modification
$Sc->arrTimesName[]='ctime';//last inode change
*/             
					if(count($this->arrTimesName)==0){
                  echo '<tr>
                  <td>'.$folder.'/'.$file.'</td>
                  <td><b>'.$this->pieceOfFind.'</b></td>
                  </tr>';
						continue;
					}   
               $arrTimes=array($this->arrTimesName);
               $timeMaxName=$this->arrTimesName[0];
               //$timeMax=$stat_info[$timeMaxName];
                 
               foreach($this->arrTimesName as $v){
                 if($stat_info[$v]>$timeMax){
                  $timeMaxName=$v;
                  $timeMax=$stat_info[$v];                 
                 //$arrTimes[]=$stat_info[$v]; 
                  if ((time () - $timeMax) < $this->period) {// Если дата изменения файла не старше заданного отрезка времени, то выводим новую строку в таблицу
                    echo '<tr><td>'.date ("d-m-Y H:i", $timeMax).' '.$timeMaxName.'</td><td>'.$folder.'/'.$file.'</td></tr>';
                  }
                }               	
               }
               //$timeReq=max($arrTimes); 
                
               /* 
               $timeOfLastAccess=$stat_info[8];
               $timeOfLastModif=$stat_info[9];
               $timeOfLastInodeCh=$stat_info[10];
               */
               //$timeReq=max($timeOfLastAccess,$timeOfLastModif,$timeOfLastInodeCh);


               //$timeName="LastAccess";
               //if($timeReq===$timeOfLastAccess) $timeName="LastAccess";
               //if($timeReq===$timeOfLastModif) $timeName="LastModif)";
               //if($timeReq===$timeOfLastInodeCh) $timeName="InodeCh";                                 
               
               
              /* 
                if ((time () - $timeMax) < $this->period) {// Если дата изменения файла не старше заданного отрезка времени, то выводим новую строку в таблицу
                    echo '<tr><td>'.date ("d-m-Y H:i", $timeMax).' '.$timeMaxName.'</td><td>'.$folder.'/'.$file.'</td></tr>';
                }
                                  
				*/	


                /*
                if (time () - $stat_info['mtime'] < $this->period) {// Если дата изменения файла не старше заданного отрезка времени, то выводим новую строку в таблицу
                    echo '<tr><td>'.date ("d-m-Y H:i", $stat_info[9]).'</td><td>'.$folder.'/'.$file.'</td></tr>';
                }
               */
                
            }
	  }	   
   }	    
      //===========================   function Start($folder)  =================================================
      
};

/* stat results

0	dev	device number
1	ino	inode number *
2	mode	inode protection mode
3	nlink	number of links
4	uid	userid of owner *
5	gid	groupid of owner *
6	rdev	device type, if inode device
7	size	size in bytes
8	atime	time of last access (Unix timestamp)
9	mtime	time of last modification (Unix timestamp)
10	ctime	time of last inode change (Unix timestamp)
11	blksize	blocksize of filesystem IO **
12	blocks	number of 512-byte blocks allocated ** * On Windows this will always be 0.
** Only valid on systems supporting the st_blksize type - other systems (e.g. Windows) return -1.

*/


?>