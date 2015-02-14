<?php
/**
 * Created by PhpStorm.
 * User: imidsac
 * Date: 07/05/14
 * Time: 15:04
 */
if (isset($_SESSION['privilege']) == true &&
    isset($_SESSION['nom']) == true &&
    isset($_SESSION['prenom']) == true &&
    isset($_SESSION['gecos']) == true &&
    isset($_SESSION['login']) == true &&
    isset($_SESSION['pass']) == true &&
    isset($_SESSION['id_bo']) == true &&
    isset($_SESSION['gid']) == true){
    $uti=$_SESSION['id_bo'];
    $gid=$_SESSION['gid'];
    $vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
    $vila=pg_fetch_assoc($vil);

    $lan=pg_query($connexion, "select f_annee() as an,f_mois(now()::date) as moi");
    $rlan=pg_fetch_assoc($lan);
}
else {
    header("Location:index.php?erreur=intru");
}