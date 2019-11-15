<?php
/**
 * Use this script to add your extension package to MODX's "radar".
 * This should only need to be done once.
 * Note that we have to instantiate MODX: xPDO is not sufficient
 * because we're running functions that exist only in MODX, not in the 
 * underlying xPDO framework.
 *
 * USAGE:
 * 1. Copy this file into the docroot (web root) of your MODX installation.
 * 2. Execute the file by visiting it in a browser, e.g. <a href="http://yoursite.com/add_extension.php"> <a href="http://yoursite.com/add_extension.php"> http://yoursite.com/add_extension.php
</a>
</a>
 */
//------------------------------------------------------------------------------
//! CONFIGURATION
//------------------------------------------------------------------------------
// Your package shortname:
//$package_name = 'morpher';
//------------------------------------------------------------------------------
//  DO NOT TOUCH BELOW THIS LINE
//------------------------------------------------------------------------------
define('MODX_API_MODE', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/index.php');
if (!defined('MODX_CORE_PATH')) {
    print '<p>MODX_CORE_PATH not defined! Did you put this script in the web root of your MODX installation?</p>';
    exit;
}
$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(xPDO::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
$modx->addExtensionPackage("morpher35","[[++core_path]]components/morpher/model/");
print 'Success!';
?>
