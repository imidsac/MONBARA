<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_cl=$_GET['id_cl'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$add_cl=$_GET['add_cl'];
	$tel1_cl=$_GET['tel1_cl'];
	$mois=$_GET['mois'];
?>
<div id="content">
<?php
include_once('sidebar.php');

echo '<div id="colTwo">';
	echo fan();
echo fpaie_cl($id_cl,$annee);
?>

	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
