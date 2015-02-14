<?php
class DB 
{
  private  $host = "localhost";
  private  $user = "imidsac";
  private  $pass = "MOImeme";
  private  $db = "baramusso";
  private  $dbh;


  public function __construct($host = null, $user = null, $pass = null, $db = null)
	{
		if ($host != null) {
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->db = $db;
		}
 try
{
$this-> dbh = new PDO('pgsql:host='.$this->host.';dbname='.$this->db.';user='.$this->user.';password='.$this->pass);
//echo 'Connexion OK';
}
catch(PDOException $e) {
 
echo 'ERREUR DB: ' . $e->getMessage();
}

	}
	
   public function pg_query($sql)
   {
   	$req=$this->dbh->prepare($sql);
    $req->execute();
    return   $req->fetchAll();
   }

}

?>