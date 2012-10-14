<?php
//vérification des champs concernants le cours et appel de trombi pour selectionner les absents

//unclude des models
include_once("model/m_g_etudiant.php");
include_once("model/m_g_utilisateur.php");
include_once("model/m_gestion.php");

//include des vues
include("vues/v_menu.php");
if (!($_GET['idEtu'] >= -1) && !($_GET['idUti'] >= -1))
	include("vues/v_gestion.php");
else
{
	if ($_GET['idEtu'] >= -1)
		include("vues/v_g_etudiant.php");
	else
		include("vues/v_g_utilisateur.php");
}


if(!isset($_POST['do'])) 	{$_POST['do']='';}
if(!isset($_POST['button'])) {$_POST['button']='';}
if(!isset($_POST['qui'])) 	{$_POST['qui']='';}

if($_POST['qui']=='etudiant')
{
	if($_POST['do']=='create' && $_POST['button']=='Enregistrer'){
		ajouterImage();
		ajouterEtudiant();
	}

	if($_POST['do']=='modif' && $_POST['button']=='Enregistrer'){
		ajouterImage();
		modifierEtudiant();
	}

	if($_POST['do']=='modif' && $_POST['button']=='Supprimer'){ //ajouter contrôles
		supprimerEtudiant();
	}
}
else if($_POST['qui']=='utilisateur')//si utilisateur
{

	if($_POST['do']=='create' && $_POST['button']=='Enregistrer'){
		ajouterImage();
		ajouterUtilisateur();
	}

	if($_POST['do']=='modif' && $_POST['button']=='Enregistrer'){
		ajouterImage();
		modifierUtilisateur();
	}

	if($_POST['do']=='modif' && $_POST['button']=='Supprimer'){ //ajouter contrôles
		supprimerUtilisateur();
	}
}

if($_POST['qui']=='spe')
{
	if($_POST['button']=='Ajouter')
		ajouterSpe();
}

?>