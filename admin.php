<?php require_once('connection.php'); 

// ------ AJOUT D'UN UTILISATEUR --------
if(isset($_POST['login'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	if(($_POST['login'] == "") || ($_POST['pass'] == "")){ // si login ou mot de passe non spécifiés >> message d'erreur
		header("Location:admin.php?erreur=empty");
	}
	else if($_POST['pass'] == $_POST['pass2']){ // on vérifie si le mot de passe et le mot de passe confirmé ont la même valeur
		// on passe toutes les variables $POST en variables
		$login = $_POST['login'];
		$pass = md5($_POST['pass']); // ici, on crypte le mot de passe à l'aide de MD5 (c'est tout simple non ? :)
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$gecos = $_POST['gecos'];
		$gid = $_POST['gid'];
		$id_bo = $_POST['id_bo'];
		$privilege = $_POST['privilege'];
		// on fait l'INSERT dans la base de données
		pg_select($database_dbquin1, $dbquin1);
		$add_users= pg_query($connexion, "INSERT INTO utilisateurs (login, pass, nom, prenom, privilege, gecos,gid,id_bo) 
		VALUES ('$login', '$pass', '$nom', '$prenom', '$privilege', '$gecos',$gid,$id_bo)");
		//$add_user = sprintf("INSERT INTO utilisateurs (login, pass, nom, prenom, privilege) VALUES ('$login', '$pass', '$nom', '$prenom', '$privilege')");
  		//pg_select($database_dbquin1, $dbquin1);
  		//$result = pg_query($add_user, $dbquin1) or die(pg_last_error());
		header("Location:admin.php?add=ok"); // redirection si création réussie
	}
	else{
		header("Location:admin.php?erreur=pass"); // redirection si le pass1 est différent du pass2
	}
}

// ------ SUPPRESSION D'UN UTILISATEUR --------
// on fait la requête sur tous les utilisateurs de la base pour alimenter notre sélecteur (on fait un tri par nom)
//pg_select($database_dbquin1, $dbquin1);
$resultat=pg_query($connexion, "SELECT * from boutiques");
$users=pg_query($connexion, "SELECT * FROM utilisateurs ORDER BY nom ASC");
//$query_users = "SELECT * FROM utilisateurs ORDER BY nom ASC"; // ORDER BY renvoi les données triées (ici par nom croissant)
//$users = pg_query($query_users, $dbquin1) or die(pg_last_error());
$row_users = pg_fetch_assoc($users);

if(isset($_POST['suppr']) && ($_POST['suppr'] != "1")){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	$id = $_POST['suppr'];
    $delete_user = pg_query($connexion,"DELETE FROM utilisateurs WHERE id_user='$id'");

  //pg_select($database_dbquin1, $dbquin1);
  //$result = pg_query($delete_user, $dbquin1) or die(pg_last_error());
  header("Location:admin.php?delete=ok"); // url qui servira pour afficher le message de réussite
}

include_once('header.php');

	include_once('sidebar.php');
	

echo '<div id="colTwo">';

echo '<form action="" method="post" name="add">';
echo '<div align="center" ><img src="images/kate.png" width="100" height="100" alt="" /><h1>- : : : ESPACE ADMINISTRATION : : : -</h1></div>'; 
 echo '<p align="center">';
 
     if(isset($_GET['erreur']) && ($_GET['erreur'] == "pass")) { // Affiche l'erreur  
    echo '<span class="erreur">Veuillez entrer deux fois votre mot de passe SVP</span>';
    } 
    if(isset($_GET['add']) && ($_GET['add'] == "ok")) { // Affiche l'erreur 
    echo '<span class="reussite">L\'utilisateur a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s !</span>';
    } 
  	if(isset($_GET['erreur']) && ($_GET['erreur'] == "empty")) { // Affiche l'erreur 
    echo '<span class="erreur">Un petit oubli non ? Veuillez renseigner au moins un login et un mot de passe SVP</span>';
     } 
echo '</p>';
  echo '<p align="center"><strong><u>Cr&eacute;er un utilisateur</u></strong></p>';
  echo '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    echo '<tr class="header2 bw">
      <td width="40" >Login</td>
      <td width="144"><input name="login" type="text" id="login" class="text header1 ui-corner-all"></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>Mot de passe </td>
      <td><input name="pass" type="password" id="pass" class="text header1 ui-corner-all"></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>R&eacute;p&eacute;ter mot de passe </td>
      <td><input name="pass2" type="password" id="pass2" class="text header1 ui-corner-all"></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>NOM</td>
      <td><input name="nom" type="text" id="nom" class="text header1 ui-corner-all"></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>Pr&eacute;nom</td>
      <td><input name="prenom" type="text" id="prenom" class="text header1 ui-corner-all"></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>statu</td>
      <td><input name="gecos" type="text" id="gecos" class="text header1 ui-corner-all"></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>Agence</td>
     <td>
						<select name="id_bo" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_bo'].'">'.$ligne['nom_bo'].'</option>';
 								}
   					echo '</select>
   				</td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>Privil&egrave;ge</td>
      <td><select name="privilege" id="privilege" size="0" class="ui-state-active ui-corner-all boutons">
          <option value="user">Utilisateur</option>
          <option value="admin">Administrateur</option>
        </select></td>
    </tr>';
    echo '<tr class="header2 bw">
      <td>Groups</td>
      <td><select name="gid" id="gid" size="0" class="ui-state-active ui-corner-all boutons">
          <option value="1">Administrateur</option>
          <option value="2">Directeur Générale</option>
          <option value="3">Vendeur(se)</option>
          <option value="4">Caissiere</option>
          <option value="5">Visiteurs</option>
        </select></td>
    </tr>';
    echo '<tr>
      <td height="50" colspan="2"><div align="center">
      		<button id="myb"  class="ui-state-active ui-corner-all boutons">
          <input type="submit" name="Submit" value="Cr&eacute;er cet utilisateur"  class="ui-state-active ui-corner-all boutons">
          	</button>
        </div></td>
    </tr>';
  echo '</table>';
echo '</form>';
echo '<p align="center"><strong>';
  
if(isset($_GET['delete']) && ($_GET['delete'] == "ok")) { // Affiche l'erreur 
  echo '<span class="reussite cnoire">L\'utilisateur a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s</span>';
   } 
  
if(isset($_POST['verif']) && (!isset($_POST['suppr']))) { // Affiche l'erreur  
echo '</strong><span class="erreur cnoire">Veuillez s&eacute;lectionner un utilisateur &agrave; supprimer </span><strong>';
 } 
if(isset($_POST['suppr']) && ($_POST['suppr'] == "1")) { // Affiche l'erreur  
echo '</strong><span class="erreur cnoire">Vous ne pouvez pas supprimer l\'utilisateur par d&eacute;faut imidsac.<br>
Pour tester la fonction de supression, ajoutez un utilisateur.<br>
Pour s&eacute;curiser votre script, il est fortement recommand&eacute; de le supprimer manuellement dans votre BDD ... </span><strong>
  </strong></p>';
  }
echo '<form action="" method="post" name="suppr">';
  echo '<p align="center">';
  echo '<strong><u>Supprimer un utilisateur</u></strong>';
	  echo '</p>';
  echo '<div align="center">'; 
    echo '<table width="500" border="0" cellpadding="5" cellspacing="0" class="tableaux">';
      echo '<tr>
        <td width="240"><div align="center">';
            echo '<select name="suppr" size="5" id="select2">';
              
	do {  

              echo '<option value="'.$row_users['id_user'].'">';
               if($row_users['privilege']== "admin")  echo ">> "; echo $row_users['nom']." ".$row_users['prenom']." (".$row_users['login'].")"; if($row_users['privilege']== "admin") echo  " <<";
              echo '</option>';
             
	} while ($row_users = pg_fetch_assoc($users));
 		$rows = pg_num_rows($users);
  		if($rows > 0) {
      		pg_result_seek($users, 0);
	  		$row_users = pg_fetch_assoc($users);
		}

            echo '</select>';
            echo '<input name="verif" type="hidden" id="verif">';
        echo '</div></td>';
        echo '<td width="157"><input type="submit" name="Submit2" value="Supprimer cet utilisateur" id="myb"  class="ui-state-active ui-corner-all boutons"></td>';
      echo '</tr>';
    echo '</table>';
    echo '<p><a href="accueil.php"><strong>&lt; Retour accueil</strong></a></p>';
  echo '</div>';
echo '</form>';
echo '</div>';

include_once('footer.php');
?>
