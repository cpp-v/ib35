<?
class Menu_35 {
    public $modx;
    public $config = array();
    function __construct(modX &$modx,array $config = array()) {

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
    }
}
?>
