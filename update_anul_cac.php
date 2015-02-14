<?php
include_once('connection.php');
$id_ac=$_POST['id_ac'];
$requete="update achat_con set qte_livres=0 where id_ac=$id_ac";
									
$resultat=pg_query($connexion,$requete);
?>