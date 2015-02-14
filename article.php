<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

?>

<div id="content">

    <?php
    include_once('sidebar.php');
    ?>

    <div id="colTwo">


        <?php
        if (isset($_POST['role1'])) {
            $role1 = $_POST['role1'];
            if ($role1 == 'modifier')
                include_once('update_ar.php');
            if ($role1 == 'ajouter')
                include_once('insert_ar.php');
            if ($role1 == 'supprimer')
                include_once('delete_ar.php');
        }
        $resultat = pg_query($connexion, "SELECT * from articles order by lib_ar,type_ar,prix_vente desc");
        if ($_SESSION['id_bo'] == 1) {
            if ($_SESSION['gid'] == 1 || $_SESSION['gid'] == 1000 || $_SESSION['gid'] == 3) {
                echo '<a href="#"><button id="myb"  class="ui-state-active ui-corner-all boutons">Liste des articles(PDF)</button></a>';
                echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
                echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">LISTE DES ARTICLES DISPONIBLE</h5></th></tr>';
                echo '<tr class="header3 bw">
       <td colspan="8">';
                if ($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000) {
                    echo '<a href="ajo_ar.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un article</button></a>';
                }
                echo '</td>';

                echo '</tr>';
                echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th class="lgauche">ARTICLE</th>
		<th class="lgauche">REFERENCE</th>';

                echo '<th class="lgauche">ETATS</th>';

                echo '<th class="ldroite">PRIX-VENTE</th>';
                if ($_SESSION['gid'] == 1000) {
                    echo '<th colspan="2" class="lcentre">ACTION</th>';
                }
                echo '</tr>';
                $i = 1;
                while ($ligne = pg_fetch_assoc($resultat)) {

                    echo '<tr class="' . ligneColor() . ' bw">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $ligne['lib_ar'] . '</td>';
                    echo '<td>' . $ligne['type_ar'] . '</td>';

                    if ($ligne['etat'] == 'a') {
                        echo '<td>Actif</td>';
                    } else {
                        echo '<td>Inactif</td>';
                    }
                    echo '<td class="ldroite cbleu">' . number_format($ligne['prix_vente'], 0, ' ', ' ') . '<sup>F</sup></td>';
                    if ($_SESSION['gid'] == 1000) {
                        echo '<td><a href="mod_ar.php?lib_ar=' . $ligne['lib_ar'] .
                            '&type_ar=' . $ligne['type_ar'] .
                            //'&stoc_ar='.$ligne['stoc_ar'].
                            '&id_ar=' . $ligne['id_ar'] .
                            '&prix_vente=' . $ligne['prix_vente'] .
                            '&info=' . $ligne['info'] .
                            '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
                        //if($_SESSION['privilege'] == "admin") {
                        echo '<td><a href="sup_ar.php?lib_ar=' . $ligne['lib_ar'] .
                            '&type_ar=' . $ligne['type_ar'] .
                            '&id_ar=' . $ligne['id_ar'] .
                            '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
                    }
                    echo '</tr>';
                    $i++;
                }

                echo '<tr class="header3 bw">
			<td colspan="8">';
                if ($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000) {
                    echo '<a href="ajo_ar.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un article</button></a>';
                }
                echo '</td>
			</tr>';
                echo '</table>';
            } else {
                echo '<table align="center">
<tr>
<tr></tr>
<td align="center" class="titre00"><blink>Vous n\'avez pas le droit</blink></td>
</tr>

<tr><td align="center" class="titre00"><blink>pour acceder le contenu!!!</blink></td></tr>

</table>';
            }
        } else {
            echo '<table align="center">
<tr>
<tr></tr>
<td align="center" class="titre00"><blink>Vous n\'avez pas le droit</blink></td>
</tr>

<tr><td align="center" class="titre00"><blink>pour acceder le contenu!!!</blink></td></tr>

</table>';
        }
        ?>

    </div>
    <div style="clear: both;">&nbsp;</div>
</div>

<!-- <?php
include_once('footer.php');
?> -->

