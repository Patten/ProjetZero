﻿<?php
function getAllSpe() //Récupere la liste des spécialisations
{
	$tab = array();
	
	$requete="select idSpe, libSpe from Specialisation";
	$resultat=mysql_query($requete);
	
	while($ligne=mysql_fetch_array($resultat))
	{
		$tab[]=$ligne;
	}
	
	return $tab;
}

function showTrombi($spe, $annee) //Récupere les photos noms et prénoms des étudiants
{
	$tab = array();
	
	$requete="select idEtu, nomEtu, prenomEtu, photoEtu from etudiant WHERE anneeEtudeEtu='".$annee."'"; 
	
	// si spe <> de "toutes"
	if ($spe <> 1 )$requete .= "AND idSpe='$spe'"; 
	
	$resultat=mysql_query($requete);
	
	while($ligne=mysql_fetch_array($resultat))
	{
		$tab[]=$ligne;
	}

	return $tab;
}

?>