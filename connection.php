<?php
//session_start();
if ($http_response_header  || isset($_SESSION['nom']) == true)
{
$connexion=pg_connect("dbname=baramusso host=localhost user=imidsac password=MOImeme") or die("Error de connexion.". pg_last_error());

//$connexion=pg_connect("dbname=test host=localhost user=imidsac password=MOImeme");
}