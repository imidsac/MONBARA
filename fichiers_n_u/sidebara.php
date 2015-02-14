<div id="colOne00"  class="titre1">Usine</div>
<div id="colOne0">
	<div id="menu0">
		<ul>
			<!-- <li ><a href="fourni.php">Fournisseurs</a></li> -->
			<li ><a href="article.php">Articles</a></li>
			<li ><a href="entre_uac.php">Achats</a></li>
			<li ><a href="materiel.php">Matériels</a></li>
			<li ><a href="#">Atelier</a></li>
			<li ><a href="agence.php">Agences</a></li>
		</ul>
	</div>
</div>
<?php if($_SESSION['gid'] !=100) { ?> 
<div id="colOne1" >

<table align="center">
<tr>
<td align="center" class="titre1">Agence</td>
</tr>
<tr>
<td align="center" class="titre1"><?php echo $vila['nom_bo'] ?></td>
</tr>
</table>

</div>


<div id="colOne">
		<div id="menu1">
			<ul>
				<li><a href="accueil.php">acceuil</a></li>
				<li><a href="produit.php">Stocks</a></li>
				<li><a href="sortie.php">Ventes</a></li>
				<li><a href="entre.php">Entrees</a></li>
				<li><a href="depence_moi.php">Charges</a></li>
				<li><a href="client.php">Clients</a></li>
				<li><a href="journe.php">Les retours d'aujourd'hui</a></li>
				<li><a href="#">Transferts</a></li>
				<li><a href="benefice.php">BILANS</a></li>
				<li><a href="employe.php">Employes</a></li>
				<li><a href="admin.php">Administration</a></li>
				<!-- <li id="menu-10"><a href="#">Trace bancaire</a></li> -->
			</ul>
		</div>
	</div>
 <? } 
else {
echo '<div id="colOne1">
<table align="center">
<tr>
<td align="center" class="titre1">'.$_SESSION['gecos'].'</td>
</tr>
<tr>
<td align="center" class="titre1">'.$_GET['nom_bo'].'</td>
</tr>
</table>
</div>';
if(isset($_GET['id_bo']) && ($_GET['id_bo'] == $uti)) {
echo '<div id="colOne">
<div id="menu1">
			<ul>
				<li><a href="accueil.php">acceuil</a></li>
				<li><a href="produit.php?lib_m='.$uti.'&nom_bo='.$nom_bo.'">Stocks</a></li>
				<li><a href="sortie.php">Ventes</a></li>
				<li><a href="entre.php">Entrees</a></li>
				<li><a href="depence_moi.php">Charges</a></li>
				<li><a href="client.php">Clients</a></li>
				<li><a href="journe.php">Les retours d\'aujourd\'hui</a></li>
				<li><a href="#">Transferts</a></li>
				<li><a href="benefice.php">BILANS</a></li>
				<li><a href="employe.php">Employes</a></li>
				<li><a href="admin.php">Administration</a></li>
			</ul>
		</div>
</div>';
	}
	}
	
?> 
