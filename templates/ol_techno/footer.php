<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $_VERSION;
require_once('libraries/joomla/utilities/date.php');
$date  = new JDate();
$config = new JConfig();
// NOTE - You may change this file to suit your site needs
?>
Copyright &copy; <?php echo $date->toFormat( '2005 - %Y' ) . ' ' . $config->sitename;?>.
Наш партнер:  <a href="http://www.realtymag.ru/rostovskaya-oblast/dom/prodazha"> RealtyMag.ru </a>
