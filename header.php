<?php
session_start();
require 'fun/connect.php';
include('fun/f_annee.php');
include('fun/f_mois.php');
if (isset($_GET['annee']) or isset($_GET['mois']) or isset($_GET['bar'])) {
    $mois = $_GET['mois'];
    $annee = $_GET['annee'];
    $bar = $_GET['bar'];
}
?>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title>SOCIETE AMINATA KONATE</title>
        <meta name="Keywords" content=""/>
        <meta name="Description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="default0.css" rel="stylesheet" type="text/css"/>
        <link href="bleu3/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
        <!--<script src="respond.min.js"></script>-->
    </head>
    <body>
    <div id="header">
        <h5 class="titre">STÉ AMINATA KONATÉ s.a.r.l</h5>

        <div id="idtitre">
			<?php
			if (isset($_SESSION['privilege']) == true &&
                isset($_SESSION['nom']) == true &&
                isset($_SESSION['prenom']) == true &&
                isset($_SESSION['gecos']) == true &&
                isset($_SESSION['login']) == true &&
                isset($_SESSION['pass']) == true &&
                isset($_SESSION['id_bo']) == true &&
                isset($_SESSION['gid']) == true) {
                echo '<p align="right"><a href="index.php?erreur=logout"><button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';"><strong>Vous d&eacute;connecter</strong></button></a></p>';
            }

		echo '</div></div>';

