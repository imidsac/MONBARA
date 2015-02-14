
<?php
include_once('connection.php');
$id_em=$_POST['id_em'];
$nom_em=$_POST['nom_em'];
$prenom_em=$_POST['prenom_em'];
$lieu=$_POST['lieu'];
$add_em=$_POST['add_em'];
$tel1_em=$_POST['tel1_em'];
$compte_banc=$_POST['compte_banc'];
$montant=$_POST['montant'];
$requete="update employer SET 
						nom_em='$nom_em', 
						prenom_em='$prenom_em',
						lieu='$lieu',
						add_em='$add_em',
						tel1_em='$tel1_em',
						compte_banc='$compte_banc',
						montant=$montant 
						where id_em=$id_em";
									
$resultat=pg_query($connexion,$requete);
?>
