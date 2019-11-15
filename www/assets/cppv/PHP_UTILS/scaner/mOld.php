<?php
include_once($_SERVER['DOCUMENT_ROOT']."/assets/cppv/aset_test.php");
						delete_test_file();
                  add_test_str("========= START /assets/cppv/PHP_UTILS/scaner/mOld.php ===========");
                        
//$days=200;          
                        
$start_folder = $_SERVER['DOCUMENT_ROOT'];// Задаём начальную директорию сканирования
if (!empty($_GET['days'])) $days = intval ($_GET['days']); else $days = 1;// Получаем через GET отрезок времени

$days=200;

$period = 86400 * $days;//Пересчитываем в секунды для сравнения с timestamp

$filter = array('cache', 'logs.old', 'logs','*.jpg','*.png','*.jpeg','*.js','*.less','*.php~','*.js~','bootstrap');// Список фильтруемых папок, они будут игнорироваться при сканировании
$arrFiltrExt=array();

           //только их
$filterInOnly=array('*.php','index.html');//только их и выбирать
$arrFilterInOnlyExt=array();


fillArrFiltrExt($filter,$arrFiltrExt);

fillArrFilterInOnlyExt($filterInOnly,$arrFilterInOnlyExt);


add_test_str('$filter='.print_r($filter,true));
add_test_str('$arrFiltrExt='.print_r($arrFiltrExt,true));


echo '<table>';
scan_tree ($start_folder, $period, $filter);
echo '</table>';


function scan_tree ($folder, $period, $filter = NULL,$level=6) {   //add_test_str("1");
	     if($level==0) { return;}
        // Получаем массив папок и файлов в текущей папке
        $files = scandir ($folder);                        //add_test_str('$files='.print_r($files,true));
            // В цикле обходим все папки и файлы в дериктории
        foreach ($files as $file) {                    //add_test_str('$folder='.$folder.'      $file='.$file);
																        //$res=in_array ($file, $filter);
																			//add_test_str('$res='.$res);
												//if(in_array ($file, $filter)) {
												//	add_test_str('=============  YES!  ============');													
												//}																										

            if(filtrCppv($file)) continue; 
  
            // Формируем полный путь к папке или файлу
            $item = $folder.'/'.$file;
                // Если текущий элемент - папка, то рекурсивно вызываем функцию сканирования
            if (is_dir ($item)) {
                scan_tree ($item, $period, $filter,$level-1);
            } else {
                // Если текущий элемент - файл, то получаем информацию о файле
                $stat_info = stat ($item);
                if (time () - $stat_info['mtime'] < $period) {
                    // Если дата изменения файла не старше заданного отрезка времени, то выводим новую строку в таблицу
                    echo '<tr><td>'.date ("d-m H:i", $stat_info[9]).'</td><td>'.$folder.'/'.$file.'</td></tr>';
                }
            }
        }
}
//=====================================================================================================
function fillArrFiltrExt($filter,&$arrFiltrExt){   add_test_str('fillArrFiltrExt()');                  
  foreach($filter as $filterItem){
		if($filterItem[0]=='*' && $filterItem[1]=='.') { //'*.jpg'  - откидываем картинки(расширение jpg)
							add_test_str('$filterItem='.$filterItem);
		  $extFilter=substr($filterItem,2);   add_test_str('$extFilter='.$extFilter);
		  if($extFilter){
		      $arrFiltrExt[]=strtoupper($extFilter);
		  }		  
		}  
  }
}
//=====================================================================================================
function fillArrFilterInOnlyExt($filterInOnly,$arrFilterInOnlyExt){
  foreach($filterInOnly as $filterItem){
		if($filterItem[0]=='*' && $filterItem[1]=='.') { //'*.jpg'  - откидываем картинки(расширение jpg)
							//add_test_str('$filterItem='.$filterItem);
		  $extFilter=substr($filterItem,2);   //add_test_str('$extFilter='.$extFilter);
		  if($extFilter){
		      $arrFilterInOnlyExt[]=strtoupper($extFilter);
		  }		  
		}  
  }
}
//=====================================================================================================
function filtrCppv($file,$filterExt) {  add_test_str('filtrCppv  $file='.$file);
	//которые включаем, если есть включаемые, откидываемые игнорируем
             //$onlyFile=in_array ($file, $filterInOnly);
   global $filterInOnly;         
   //if(in_array ($file, $filterInOnly)) return false; 

   
   if(count($filterInOnly)>0) return true;//откидываем все если есть точные
   //которые откидываем
            // Пропускаем текущую папку, родительскую папку и папки из фильтруемых
  global $filter;             
  if (($file == '.') || ($file == '..') || (in_array ($file, $filter))) return true;

  $posPointerFile=strrpos($file,'.');
  $extFile=substr($file, $posPointerFile+1);  
  $extFile=strtoupper($extFile);
  global $arrFiltrExt; 
  foreach($arrFiltrExt as $filterExt){   add_test_str('$filterExt='.$filterExt.'   $extFile='.$extFile);
	 	     if($extFile==$filterExt) {
	 	     	 add_test_str('YES!!!');
	 	     	 return true;
	 	     }
		}	
 return false;	
}	



?>