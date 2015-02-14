<?php
include_once('header.php');
include_once('connection.php');
?>

<?php

if (!empty($_POST) && addslashes($_POST['login']) < 3) {

    if (isset($_POST['login'])) {
        $login = addslashes($_POST['login']);
        $pass = addslashes(md5($_POST['pass']));

        $verif = pg_query($connexion, "SELECT * FROM utilisateurs WHERE login='$login' AND pass='$pass'");
        $row_verif = pg_fetch_assoc($verif);
        $utilisateur = pg_num_rows($verif);


        if ($utilisateur) {
            //$_SESSION[SOFTWARESHORTNAME .'authentification'];
            $_SESSION['id_user'] = $row_verif['id_user'];
            $_SESSION['privilege'] = $row_verif['privilege'];
            $_SESSION['nom'] = $row_verif['nom'];
            $_SESSION['prenom'] = $row_verif['prenom'];
            $_SESSION['gecos'] = $row_verif['gecos'];
            $_SESSION['login'] = $row_verif['login'];
            $_SESSION['pass'] = $row_verif['pass'];
            $_SESSION['id_bo'] = $row_verif['id_bo'];
            $_SESSION['gid'] = $row_verif['gid'];
            header("Location:accueil.php");
        } else {
            header("Location:index.php?erreur=login");
        }
    }
} else {
    if (!empty($_POST) && strlen($_POST['login']) <= 3) {
        $error_login = 'Votre login doit comporter au minimun 4 caractere!';
    }

    if (!empty($_POST) && strlen($_POST['pass']) <= 3) {
        $error_pass = 'Votre mot de pass doit comporter au minimun 4 caractere!';
    }
}
/*$uti1=$_SESSION['gid'];
$nom_ville=pg_query($connexion, "SELECT * FROM boutiques WHERE id_bo=$uti1");
$row_nom_ville = pg_fetch_assoc($nom_ville);
$agence = pg_num_rows($nom_ville);*/

if (isset($_GET['erreur']) && $_GET['erreur'] == 'logout') {
    $prenom = $_SESSION['prenom'];
    session_unset("authentification");
    header("Location:index.php?erreur=delog&prenom=$prenom");
}
?>

<?php

?>
<div id="content">

    <div id="colOne00" class="titre1">Usine</div>
    <div id="colOne0">
        <div id="menu0">
            <ul>
                <!-- <li ><a href="fourni.php">Fournisseurs</a></li> -->
                <li><a href="article.php">Articles</a></li>
                <li><a href="entre_uac.php">Achats</a></li>
                <li><a href="materiel.php">Materiels</a></li>
                <li><a href="#">Atelier</a></li>
                <li><a href="agence.php">Agences</a></li>
            </ul>
        </div>
    </div>
    <!-- <div id="colOne">
            <div id="menu1">
             <img src="images/baramusso/9.jpg" width="100%" height="100%" alt="" align="left" border="0" />

            </div>
        </div>

    <div id="colTwo"> -->


    <table align="center">
        <tr>
            <td><h5 align="center" class="titre2"><b>- : : :BIENVENUE BOUILLON EN POUDRE BARA MUSSO : : : -</b></h5>
            </td>
        </tr>
    </table>
    <p align="center"><u>LAFIABOUGOU GRAND MARCHE</u><br>
        - Rue Cheick Zayed -Porte 270
        - Imm. DIABY<br>
        - Cell:(223) 76 44 75 75 / 66 67 73 73 <br>
        Bamako - Republic du Mali </br></p>

    <div id="loginindex">
        <form action="" method="post" name="connect">
            <!-- <h1 align="center" ><b>- : : :BIENVENUE BOUILLON EN POUDRE BARA MUSSO : : : -</b></h1> -->
            <p align="center" class="title">
                <?php if (isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { ?>
                    <strong class="erreur crouge">Echec d'authentification !!! &gt; login ou mot de passe
                        incorrect</strong>
                <?php } ?>
                <?php if (isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) { ?>
                    <strong class="reussite cnoire">D&eacute;connexion r&eacute;ussie... A
                        bient&ocirc;t <?php echo $_GET['prenom']; ?> !</strong>
                <?php } ?>
                <?php if (isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) { ?>
                    <strong class="erreur cnoire">Echec d'authentification !!! &gt; Aucune session n'est ouverte ou vous
                        n'avez pas les droits pour afficher cette page</strong>
                <?php } ?>

                <?php if (isset($error_login)) {
                    echo $error_login;
                } ?>
                <?php if (isset($error_pass)) {
                    echo $error_pass;
                } ?>

            </p>

            <!-- - Empreintes des mot de passe stock&eacute;s par md5</p> -->
            <!-- <p align="center"><em><a href="lisez_moi.htm">lire les instructions d'installation &gt;&gt;</a><br>
              <a href="details.doc">lire le fonctionnement d&eacute;taill&eacute; &gt;&gt;</a></em></p> -->
            <table cellpadding="10" cellspacing="0" align="left" class="ui-widget ui-widget-content" style="width:90%">
                <tr>
                    <th colspan="2" class="header3 lcentre">CONNECTEZ-VOUS</th>
                </tr>
                <tr>
                    <th class="header3 ldroite">login</th>
                    <td width="50%"><input name="login" type="text" class="text header1 ui-corner-all" id="login"></td>
                    <br>

                </tr>
                <tr>
                    <th class="header3 ldroite">mot de passe</th>
                    <td width="50%"><input name="pass" type="password" class="text header1 ui-corner-all" id="pass">
                    </td>

                </tr>
                <tr>
                    <td height="34" colspan="2">
                        <div align="center">
                            <input type="submit" name="Submit" value="Se connecter" id="myb"
                                   class="ui-state-active ui-corner-all boutons" onclick="this.style.display ='none';">
                        </div>
                    </td>
                </tr>
            </table>
            <!--
            <img src="images/telefone/13.jpg" width="50%" height="81%" alt="" align="right" border="0" />
            <img src="images/telefone/tel1.jpg" width="49%" height="59%" alt="" align="left" border="0" />-->
            <!-- <p align="center"><a href="http://www.cv-webmaster.com" title="cv webmaster webdesigner d�veloppeur php/mysql">CV webmaster et auteur du script</a></p> -->
        </form>
    </div>
    <!--</div> -->
    <?php
    include_once('footer.php');
    ?>

