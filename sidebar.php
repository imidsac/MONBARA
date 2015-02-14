<?php
if (isset($_SESSION['login'])){
$uti=$_SESSION['id_bo'];
$gid=$_SESSION['gid'];}
$vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
$vila=pg_fetch_assoc($vil);

$lan=pg_query($connexion, "select f_annee() as an");
$rlan=pg_fetch_assoc($lan);

?>

<div id="colOne00"  class="titre1">Usine</div>
<div id="colOne0">
	<div id="menu0">
		<ul>
			<li ><a href="article.php">Articles</a></li>
			<li ><a href="fourni.php">Fournisseurs</a></li> 
			<li ><a href="entre_uac.php">Achats</a></li>
			<li ><a href="materiel.php">Matériels</a></li>
			<li ><a href="#">Atelier</a></li>
			<li ><a href="agence.php?&bar=AG&annee=<?php echo $rlan['an'] ?>">Agences</a></li>
		</ul>
	</div>
</div>

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
				      <?php if($_SESSION['gid'] ==3 || $_SESSION['gid'] ==4 || $_SESSION['gid'] ==5 || $_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000) { ?>				
                      <li><a href="journe.php">Les retours d'aujourd'hui</a></li>	
                   <?php } ?>
                   <?php if($_SESSION['gid'] ==3 || $_SESSION['gid'] ==4 || $_SESSION['gid'] ==5 || $_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000) { ?>							          
				          <li><a href="client.php?&bar=CL&annee=<?php echo $rlan['an'] ?>">Clients</a></li>
				      <?php } ?>
						<?php if($_SESSION['gid'] ==3 || $_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000) { ?>
							<li><a href="produit.php">Stocks</a></li>
						<?php if($_SESSION['id_bo'] == 1 ) { ?>
							<li><a href="sortie_t.php?&bar=TR&annee=<?php echo $rlan['an'] ?>">Transferts</a></li> 
						<?php } ?>
							<li><a href="entre.php?&bar=EN&annee=<?php echo $rlan['an'] ?>">Entrees</a></li>
						<?php } ?>	
                   
                   <?php if($_SESSION['gid'] ==3 || $_SESSION['gid'] ==5 ||$_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000) { ?>
							<li><a href="sortie.php?&bar=FAC&annee=<?php echo $rlan['an'] ?>">Ventes</a></li>
						<?php } ?>						
						
						<?php if($_SESSION['gid'] == 4 || $_SESSION['gid'] == 1 || $_SESSION['gid'] == 1000) { ?>
							<li><a href="paie_ag_cl.php?&bar=PAI&annee=<?php echo $rlan['an'] ?>">Paiements</a></li>
							<li><a href="depence_moi.php?&bar=DEP&annee=<?php echo $rlan['an'] ?>">Depences</a></li>
							<li><a href="caisse.php?&bar=CAI&annee=<?php echo $rlan['an'] ?>">Caisses</a></li>
						<?php } ?>
						<?php if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==5 || $_SESSION['gid'] ==1000) { ?>
							<li><a href="banc.php?&bar=BAN&annee=<?php echo $rlan['an'] ?>">Trace bancaire</a></li>
							<li><a href="employe.php?&bar=EMP&annee=<?php echo $rlan['an'] ?>">Employes</a></li>
						<?php } ?>	
						<?php if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000) { ?>
						<li><a href="benefice.php?&bar=BE&annee=<?php echo $rlan['an'] ?>">BILANS</a></li> 
						<?php } ?>		
						<?php if($_SESSION['gid'] == 1000 ) { ?>
						  <!--  <li><a href="paiement_moie.php">essai_pai</a></li> -->
							<li><a href="admin.php">Administration</a></li>
						<?php } ?>

			</ul>
		</div>
	</div>

