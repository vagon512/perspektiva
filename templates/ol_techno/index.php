<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<jdoc:include type="head" />

<link href="<?php echo $this->baseurl ?>/templates/system/css/system.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->baseurl ?>/templates/system/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/css/template_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main">
<table width="857" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td>
<div class="top">
<div class="toptop">
<div class="topmenu">

<object type="application/x-shockwave-flash" data="templates/<?php echo $this->template?>/images/topheader.swf" width="700" height="180">
<param name="wmode" value="transparent" />
<param name="movie" value="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/images/topheader.swf" />
</object>
</div>
</div>
</div>
</td>
</tr>
				<tr>
					<td><div id="topline">
<div class="users-bar">
<jdoc:include type="modules" name="user4" style="xhtml" /></div>
<div id="date-format">
<span class="date"><?php $now = &JFactory::getDate(); echo $now->toFormat('%A, %d %B, %Y'); ?></span>
</div></div></td>
				</tr>
				<tr>
<td valign="top" bgcolor="white">
<table border="0" cellspacing="10" cellpadding="0">
<tr>
<td valign="top" width="100%">

<?php if( $this->countModules('user6') ) {?>
<div class="content">
<div id="newsflash">
<jdoc:include type="modules" name="user6" style="xhtml" /></div>
</div>
<?php
} ?>
<jdoc:include type="module" name="breadcrumbs" style="none" />
<table width="98%" border="0" align="center" cellspacing="0">
<tr>
<td class="mainpage" rowspan="5" valign="top">
<?php if( $this->countModules('right') ) {?>
<div class="melol">
<jdoc:include type="modules" name="right"  style="xhtml"/></div>
<?php } ?>
</td>
<td class="mainpage">
<?php if( $this->countModules('user2') ) {?>
<div style=" float:left;">
<div class="leftint">
<div class="leftex">
<jdoc:include type="modules" name="user2" style="xhtml" /></div>
</div>
</div>
<?php
} ?></td>
<td class="mainpage">
<?php if( $this->countModules('user1') ) {?>
<div style=" float:right;">
<div class="leftint">
<div class="leftex">
<jdoc:include type="modules" name="user1" style="xhtml" /></div>
</div>
</div>
<?php
} ?></td>
</tr>
<tr>
<td class="mainpage" colspan="2" bgcolor="white">
<jdoc:include type="component" /></td>
</tr>
<tr>
<td class="mainpage" colspan="2">
<jdoc:include type="modules" name="inset" style="xhtml" /></td>
</tr>
<tr>
<td class="mainpage" colspan="2">
<jdoc:include type="modules" name="bottom" style="xhtml" /></td>
</tr>
<tr>
<td class="mainpage" colspan="2">
<div align="center">
<jdoc:include type="modules" name="banner" /></div>
</td>
</tr>
</table>
</td>
<td valign="top">
<div class="right">
<div class="melol">

<table cellpadding="0" cellspacing="0" class="moduletable">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr align="left">
<td>
<jdoc:include type="modules" name="left" style="xhtml" />
<jdoc:include type="modules" name="user8" style="xhtml" />
<jdoc:include type="modules" name="user7" style="xhtml" /></td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<?php if( $this->countModules('user5') ) {?>
<div style="width:160px">
<jdoc:include type="modules" name="user5" style="xhtml" /></div>
<?php
} ?></div>
</td>
</tr>
</table>
</td>
</tr>
</table>
<div class="footer"></div>
<div class="footertext" align="center">
<?php include (dirname(__FILE__).DS.'/footer.php');?></div>
</body>
</html><!-- 1150902270 -->