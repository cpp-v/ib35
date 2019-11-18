<?php
class Menu35CFG {
    public $modx;
    public $config = array();
    function __construct(modX &$modx,array $config = array()) {

/*
include_once $_SERVER['DOCUMENT_ROOT']."/mdx/assets/cppv/UTILS/DEBUG/debugM.php";
CppDebug::$arrItems[5]=new CppDebug(array('dir'=>$_SERVER['DOCUMENT_ROOT'].'/mdx'));
$dbg2=&CppDebug::$arrItems[5];
$dbg2->clear();
$dbg2->add(__FILE__);
$dbg2->add(date("d.m.Y H:i:s"));
*/

        $this->modx =&$modx;
 
        $basePath = $this->modx->getOption('core_path').'components/menu35/';
        $assetsUrl = $this->modx->getOption('assets_url').'components/menu35/mng/';
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'templatesPath' => $basePath.'templates/',
            'chunksPath' => $basePath.'elements/chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
        ),$config);
        
/*
$dbg2->addVar('path',$this->config['modelPath']);
$this->modx->addPackage('cppvmenu',$this->config['modelPath']);       
$c = $this->modx->newQuery('Menu35');
$c->prepare();
$sql=$c->toSQL();  $dbg2->addVar('$sql',$sql);
*/
        
    }
        
public  function getChunk($name,$properties = array()) {
    $chunk = null;
    if (!isset($this->chunks[$name])) {
        $chunk = $this->modx->getObject('modChunk',array('name' => $name));
        if (empty($chunk) || !is_object($chunk)) {
            $chunk = $this->_getTplChunk($name);
            if ($chunk == false) return false;
        }
        $this->chunks[$name] = $chunk->getContent();
    } else {
        $o = $this->chunks[$name];
        $chunk = $this->modx->newObject('modChunk');
        $chunk->setContent($o);
    }
    $chunk->setCacheable(false);
    return $chunk->process($properties);
}
 
private function _getTplChunk($name,$postfix = '.chunk.tpl') {
    $chunk = false;
    $f = $this->config['chunksPath'].strtolower($name).$postfix;
    if (file_exists($f)) {
        $o = file_get_contents($f);
        $chunk = $this->modx->newObject('modChunk');
        $chunk->set('name',$name);
        $chunk->setContent($o);
    }
    return $chunk;
}
        
        
        
        
};