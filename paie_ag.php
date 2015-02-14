<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_bo=$_GET['id_bo'];
	$nom_bo=$_GET['nom_bo'];
	$adr_bo=$_GET['adr_bo'];
	$tel_bo=$_GET['tel_bo'];
	$mois=$_GET['mois'];
?>
<div id="content">
<?php
include_once('sidebar.php');
echo '<div id="colTwo">';
echo fan();
echo fpaie_ag($id_bo,$annee);

?>

	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
