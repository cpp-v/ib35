<?php  //'Menu35Menu35startManagerController 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);                      
require_once dirname(dirname(__FILE__)) . '/model/menu35/menu35.class.php';
class Menu35Menu35startManagerController extends modExtraManagerController {
	   
    public $koefs; 
    public function initialize() {
            
        $this->menu35 = new Menu35CFG($this->modx);
        $this->addJavascript($this->menu35->config['jsUrl'].'js.js');
        /*                
        $this->addCss($this->koefs->config['cssUrl'].'css.css');
      	 //$fP=$_SERVER["DOCUMENT_ROOT"]."/assets/components/morph35/count.txt";
          //$count_=file_get_contents($fP);
          //$str=" осталось ".$count_." запросов <small>повторите запрос для обновления</small>";       	

        //$this->koefs->config['countrest']=$str;   
           
        */             
           
            $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                CPPVMENU.config = '.$this->modx->toJSON($this->menu35->config).';                
            });
            </script>');
            return parent::initialize();
    }
    public function getLanguageTopics() {
            return array();
    }
    public function checkPermissions() { return true;}
    public function process(array $scriptProperties = array()) {}
    public function getPageTitle() {
    	 return 'Редактор меню';
    	 
    	 }
    	 
    public function loadCustomCssJs() {
        $this->addJavascript($this->menu35->config['jsUrl'].'widgets/stores.js');
        $this->addJavascript($this->menu35->config['jsUrl'].'widgets/home.panel.js');
        $this->addLastJavascript($this->menu35->config['jsUrl'].'sections/index.js');
        $this->addJavascript($this->menu35->config['jsUrl'].'widgets/main.grid.js');
        //$this->addJavascript('/mdx/assets/cppv/COM/RowEditor.js');
        //$this->addJavascript('/mdx/assets/cppv/COM/RowEditor.css');
        //$this->addJavascript('/mdx/assets/cppv/COM/App.js');


/*

        $this->addJavascript($this->morph35->config['jsUrl'].'widgets/mrph35_T2.grid.js');
        $this->addJavascript($this->morph35->config['jsUrl'].'widgets/mrph35.grid.js');
        $this->addJavascript($this->morph35->config['jsUrl'].'widgets/home.panel.js');
        $this->addLastJavascript($this->morph35->config['jsUrl'].'sections/index.js');
*/   
    }
    public function getTemplateFile() {
    	 //$_SERVER['DOCUMENT_ROOT'].'/core/components/morpher/templates/home.tpl';
       return $this->menu35->config['templatesPath'].'home.tpl';
    }
    
}



