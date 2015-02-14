<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$EDATE=(date('Y'));
?>

<div id="content">
	<!-- <h1 align="center"><em><strong>PERIODES</strong></em></h1> -->
	<?php
	include_once('sidebar.php');
	
	?>

	<div id="colTwo">
	<?php
     echo fan();
     echo fmois_balance($annee);

	?>



	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

