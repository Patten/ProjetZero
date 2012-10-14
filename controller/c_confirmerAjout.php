<?php
/************************************************************* Definition des constantes / tableaux et variables *************************************************************/
	
	// Constantes
	define('TARGET', 'images/'); // Repertoire cible
	define('MAX_SIZE', 10000000); // Taille max en octets du fichier
	define('WIDTH_MAX', 8000); // Largeur max de l'image en pixels
	define('HEIGHT_MAX', 8000); // Hauteur max de l'image en pixels
						 
	// Tableaux de donnees
	$tabExt = array('jpg','gif','png','jpeg'); // Extensions autorisees
	$infosImg = array();
								 
	// Variables
	$extension = '';
	$message = '';
	$nomImage = '';
								 
/************************************************************ * Creation du repertoire cible si inexistant*************************************************************/
	if( !is_dir(TARGET) ) {
		if( !mkdir(TARGET, 0755) ) {
			exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
		}
	}
							 
/************************************************************* Script d'upload *************************************************************/
	if(!empty($_POST)){
	// On verifie si le champ est rempli
		if( !empty($_FILES['fichier']['name']) ){
			// Recuperation de l'extension du fichier
			$extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
									 
			// On verifie l'extension du fichier
			if(in_array(strtolower($extension),$tabExt))
			{
				// On recupere les dimensions du fichier
				$infosImg = getimagesize($_FILES['fichier']['tmp_name']);
											 
				// On verifie le type de l'image
				if($infosImg[2] >= 1 && $infosImg[2] <= 14)
				{
					// On verifie les dimensions et taille de l'image
					if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
					{
						// Parcours du tableau d'erreurs
						if(isset($_FILES['fichier']['error'])&& UPLOAD_ERR_OK === $_FILES['fichier']['error'])
						{
							// On renomme le fichier
							$nomImage = md5(uniqid()) .'.'. $extension;
													 
							// Si c'est OK, on teste l'upload
							if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage)){
								$message = 'Upload réussi !';
							}
							else{
								// Sinon on affiche une erreur systeme
								$message = 'Problème lors de l\'upload !';
							}
						}
						else{
							$message = 'Une erreur interne a empêché l\'uplaod de l\'image';
						}
					}
					else{
						// Sinon erreur sur les dimensions et taille de l'image
						$message = 'Erreur dans les dimensions de l\'image !';
					}
				}
				else{
					// Sinon erreur sur le type de l'image
					$message = 'Le fichier à uploader n\'est pas une image !';
				}
			}
			else{
				// Sinon on affiche une erreur pour l'extension
				$message = 'L\'extension du fichier est incorrecte !';
			}
			}
			else{
				// Sinon on affiche une erreur pour le champ vide
				$message = 'Veuillez remplir le formulaire svp !';
			}
			}	
							
			//include ("model/m_g_etudiant.php");
								
			// $image=$nomImage;
			// if ($image!="") // Si une image a été choisis
			// {
				// $effectue = ajouterImage($image, $_POST['categorie']);
				// echo "<br>";
				// if ($effectue != 0) // Si le poster a bien été ajouté
				// {
					// echo "<font color='green'><b><center>Ajout de l'image $effectue effectué</center></b></font>";
					// imageChecked($effectue);
				// }
				// else
					// echo "<font color='red'><b><center>Ajout non effectué</center></b></font>";
			// }
			// else{
				// echo "</br>";
				// echo "<font color='red'><center><b>Veuillez choisir une image avant de cliquer sur ajouter.</b></center></font>";
				// echo "</br></br></br></br></br></br>";
				// echo "<a href='index.php?lien=compte&action=ajouterProduit' class='lien2'>Retour à la page d'ajout de produit</a>";
			// }

			include("vues/v_g_etudiant.php");
?>