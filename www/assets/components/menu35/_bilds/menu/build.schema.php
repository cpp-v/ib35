<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);     

/*
test2.ru/assets/cppv/_bilds/morphAdmn/build.schema.php


Путь к контроллеру, который будет использоваться этим пунктом меню. 
Путь к контроллеру строится с префиксом в виде путей пространства имен, контроллеров 
и темы панели управления + значение пути.
 (Прим.: user/update для пространства имен core будет вида 
 [core_namespace_path]controllers/[mgr_theme]/user/update.class.php)
 Class 'Cppv_compsMorpherIndManagerController' not found 
*/
// test2.ru/assets/cppv/_bilds/morphAdmn/build.schema.php
require_once dirname(__FILE__).'/build.config.php';
include_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->loadClass('transport.modPackageBuilder','',false, true);
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$sources = array(
    'model' => CPPV_CORE_PATH.'cppvmenu/model/',
    'schema_file' => CPPV_CORE_PATH.'cppvmenu/model/schema/cppvmenu.mysql.schema.xml'
);


$manager= $modx->getManager();
$generator= $manager->getGenerator();
 
echo  $sources['model'],'<br>';
if (!is_dir($sources['model'])) { $modx->log(1,'Model directory not found!'); die(); }
if (!file_exists($sources['schema_file'])) { $modx->log(1,'Schema file not found!'); die(); }
$generator->parseSchema($sources['schema_file'],$sources['model']);
$modx->addPackage('cppvmenu', $sources['model']); // add package to make all models available
$manager->createObjectContainer('Menu35'); // created the database table
//$manager->createObjectContainer('TaxiAuto');
$modx->log(1, 'Done!');



