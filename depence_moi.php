<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$EDATE=(date('Y'));
//$mois=$_GET['mois'];
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<?php
echo fan();
echo fmois_dep($annee);
?>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

