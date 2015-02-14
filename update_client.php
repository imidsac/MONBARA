
<?php
include_once('connection.php');
$id_cl=$_POST['id_cl'];
$nom_cl=$_POST['nom_cl'];
$prenom_cl=$_POST['prenom_cl'];
$add_cl=$_POST['add_cl'];
$tel1_cl=$_POST['tel1_cl'];
//$tel2_cl=$_POST['tel2_cl'];
$requete="update clients SET 
						nom_cl='$nom_cl', 
						prenom_cl='$prenom_cl',
						add_cl='$add_cl',
						tel1_cl='$tel1_cl'
						where id_cl=$id_cl";
									
$resultat=pg_query($connexion,$requete);
?>
