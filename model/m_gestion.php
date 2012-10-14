<?php

	
	function ajouterImage(){

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
	
		// On verifie si le champ est rempli
			if($_FILES['fichier']['tmp_name'] != null){
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
								if($_POST['qui']=='etudiant')
								{
									if ( $_POST['idEtu'] == -1)		$nomFichier = "etu".mt_rand(1000,999999999);
									else							$nomFichier= "etu".$_POST['idEtu'];
								}
								else
								{
									if ( $_POST['idUti'] == -1)		$nomFichier = "uti".mt_rand(1000,999999999);
									else							$nomFichier= "uti".$_POST['idUti'];
								}
								$nomImage =  $nomFichier.'.'. $extension;//md5(uniqid()) .'.'. $extension; //Permet de crypter le nom en md5
								$_POST['photo'] = $nomImage;
														 
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
					$_POST['photo'] = $_POST['lbPhoto'];

					// Sinon on affiche une erreur pour le champ vide
					$message = 'Veuillez remplir le formulaire svp !';
				}
	
	}
	
	function ajouterSpe(){
		$req = " 	INSERT INTO  `Specialisation` (
					`idSpe` ,
					`libSpe`
					)
					VALUES (
					NULL ,  '".$_POST['newSpe']."'
					);";
		$exereq = mysql_query($req) or die(mysql_error());
		header("Location:index.php?lien=gestion&qui=spe");
	}
	
	function listerSpe(){
		$tab = array();
	
		$req = " 	SELECT * FROM `Specialisation`";
		$exereq = mysql_query($req) or die(mysql_error());
		while($ligne=mysql_fetch_array($exereq))
			$tab[$ligne['idSpe']] = $ligne['libSpe'];
			
		return $tab;
	}
	

?>