<!--IE Compatability-->
<!--[if lte IE 8]>
<script src="includes/jquery-1.11.1.js"></script>
	<![endif]-->
	<!--[if gte IE 9]>
<script src="includes/jquery-2.1.1.js"></script>
	<![endif]-->
	<!--[if !IE]><!-->
<script src="includes/jquery-2.1.1.js"></script>
	<!--<![endif]-->
<script src="themes/Lightness/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="themes/Lightness/jquery-ui.css">

<?php
/*Check if there is a install directory*/
$checkfile = 'install/index.php';
$checkinstall = 'install/install.log';
if (file_exists($checkfile)) {
    if (file_exists($checkinstall)) {
		$exist = '1';
	} else {
		$exist = '2';
	}
} else {
	$exist = '0';
}
?>
<?php if ($exist == '1'): ?>
	<div class="ui-widget ui-state-error ui-corner-all" style="padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
		<center><strong>Warning:</strong>Install directory still exsits!<br/>Please manually remove it for the saftey of your blog.</p></center>
	</div>
<?php endif ?>
<?php if ($exist == '2'): ?>
	<div class="ui-widget ui-state-error ui-corner-all" style="padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
		<center><strong>Alert:</strong>You have not installed and/or configured your blog yet!<br/>Please use the installer here: <a href="install">Installer</a>, to begin.</p></center>
	</div>
<?php endif ?>
<?php if ($exist == '0'): ?>
<!--BLOG INDEX BEGINS HERE-->
	
<!--AND ENDS HERE-->
<?php endif ?>