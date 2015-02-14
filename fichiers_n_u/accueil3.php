<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}

//if($_SESSION['gid'] ==100) {
	//header("Location:agence.php");
	//}
?>

<?php
include_once('connection.php');
include_once('header.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<div align="center">
	<strong>
	<table align="center">
<tr>
<td >
<h5 class="titre2">
- : : : VOTRE ESPACE PRIVE &quot;<span class="donnee"><?php echo $_SESSION['gecos']; ?></span>&quot; : : : -
</h5>
</td>
<tr>
<td >
<!-- <h5 class="titre2"><i>ON EST LE <? echo date("d/m/Y");?></i></h5> -->
</td>
</tr>
</tr>
</table>
	
	</strong>
	</div>
<p>Bienvenue &quot;<span class="donnee"><?php echo $_SESSION['prenom']; ?></span> <span class="donnee"><?php echo $_SESSION['nom']; ?></span>&quot; dans votre espace gestionnaire;. <br>
Vous &ecirc;tes connect&eacute; en tant que &quot;<span class="donnee"><?php echo $_SESSION['login']; ?></span>&quot; avec le privil&egrave;ge &quot;<span class="donnee"><?php echo $_SESSION['privilege']; ?></span>&quot;.<br>
</p>
<p>
  <?php 
  
  
  if($_SESSION['privilege'] == "admin") {  ?>
<strong><u>En tant qu'administrateur vous pouvez effectuer les actions suivantes : </u></strong></p>

  <?php } ?>
<p>
  <?php 
  if($_SESSION['privilege'] == "user") { ?>
  <strong><u>En tant qu'utilisateur simple vous ne pouvez pas effectuer d'actions</u></strong>
<?php } ?>
</p>
<!-- <p align="center"><a href="index.php?erreur=logout"><strong>Vous d&eacute;connecter</strong></a></p> -->
	
	<!-- <h1 align="center"><em><strong>BIENVENUE!!!</strong></em></h1>
	<h1 align="center"><em><strong>QUINCAILLERIE SISSOKO ET FRERES</strong></em></h1>
	<h2><p align="center"><strong>Vente de Matériaux de Construction</strong></p></h2>
	<h2><p align="center"><strong>Fer à Béton - Ciment - Fer - Tôle et Divers</strong></p></h2>
	<h2><p align="center">N° Fiscal: 084107735-N</p></h2>
	<h2><p align="center">BP 480 - Tél: 20 29 28 04 - Cell: 76 15 09 63</p></h2>
	<h2><p align="center">Ouolofobougou Nouveau Marché - Rue 42 - Porte 620 - 626</p></h2>
	<h2><p align="center">Bamako - Mali</p></h2> 	
		<img src="images/telefone/iphone4.jpg" width="50%" height="83%" alt="" border="0" />
		<img src="images/telefone/iphone4_1.jpg" width="49%" height="83%" alt="" border="0" />  -->
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

