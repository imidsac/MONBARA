
<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

/*$EDATE=(date('Y'));
$mois=$_GET['mois'];
$annee=$_GET['annee'];*/
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	
	?>
    
	<div id="colTwo">
<?php
echo fan();
echo fmois_fac($annee);
?>

	</div>
	
</div>

<?php
include_once('footer.php');
?>

