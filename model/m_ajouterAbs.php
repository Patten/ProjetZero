<?php
		//requete appelée plusieurs fois pour ajouter les absence de tout les étudiants

	/*connection pour Windows --> WAMP */
	$serveur="localhost";
	$utilisateur="root";
	$mdp="";
	$connect=mysql_connect($serveur, $utilisateur, $mdp);
	
	/*connection pour Mac --> MAMP */
	if ($connect== "")
	{
		$serveur="localhost";
		$utilisateur="root";
		$mdp="root";
		$connect=mysql_connect($serveur, $utilisateur, $mdp);
	}
	
	mysql_select_db("projet_appel") or die("echec à la connection");
	
	

		$req="INSERT INTO `absence`(
		`idAbs`,
		`idUti`, 
		`idEtu`,
		`jourAbs`,
		`hDebAbs`,
		`hFinAbs`)
		VALUES (
		NULL,
		'".$_POST['idUti']."',
		'".$_POST['unAbs']."',
		'".date("Ymd")."',
		'".$_POST['heureDeb']."',
		'".$_POST['heureFin']."'
		);";

		$exereq = mysql_query($req) or die(mysql_error());
		
	
		 if (mail('Ligeret_julien@yahoo.fr', 'sujet', 'message test') ) echo "Envoi du mail réussi."
		//header("location:index.php?lien=gestion");

	
?>