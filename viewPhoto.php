<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" title="Normal" />
		</head>
	<body>
		<div id="entete">
			<h1>Site SIL3</h1>
			</div>
		<div id="menu">		
			<h3>Menu</h3>
			<ul>
				<?php 
					# Utilisation du modÃ¨le
					require_once("model/image.php");
					require_once("model/imageDAO.php");
					// DÃ©bute l'acces aux images
					$imgDAO = new ImageDAO();
					
					// Construit l'image courante
					// et l'ID courant 
					// NB un id peut Ãªtre toute chaine de caractÃ¨re !!
					if (isset($_GET["imgId"])) {
						$imgId = $_GET["imgId"];
						$img = $imgDAO->getImage($imgId);
					} else {
						// Pas d'image, se positionne sur la premiÃ¨re
						$img = $imgDAO->getFirstImage();
						// Conserve son id pour dÃ©finir l'Ã©tat de l'interface
						$imgId = $img->getId();
					}
					
					// Regarde si une taille pour l'image est connue
					if (isset($_GET["size"])) {
						$size = $_GET["size"];
					} else {
						# sinon place une valeur de taille par dÃ©faut
						$size = 480;
					}
					
					
					# Mise en place du menu
					$menu['Home']="index.php";
					$menu['A propos']="aPropos.php";
					// Pre-calcule la premiÃ¨re image
					$newImg = $imgDAO->getFirstImage();
					# Change l'etat pour indiquer que cette image est la nouvelle
					$newImgId=$newImg->getId();
					$menu['First']="viewPhoto.php?imgId=$newImgId&size=$size";
					# Pre-calcule une image au hasard
					$newImg = $imgDAO->getRandomImage();
					$newImgId = $newImg->getId();
					$menu['Random']="viewPhoto.php?imgId=$newImgId&size=$size";
					# Pour afficher plus d'image passe Ã  une autre page
					$menu['More']="viewPhotoMatrix.php?imgId=$imgId";    
					// Demande Ã  calculer un zoom sur l'image
					$menu['Zoom +']="zoom.php?zoom=1.25&imgId=$imgId&size=$size";
					// Demande Ã  calculer un zoom sur l'image
					$menu['Zoom -']="zoom.php?zoom=0.75&imgId=$imgId&size=$size"; 
					// Affichage du menu
					foreach ($menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>
		
		<div id="corps">
			<?php # mise en place de la vue partielle : le contenu central de la page  
				# Mise en place des deux boutons
				print "<p>\n";
				// pre-calcul de l'image prÃ©cedente
				$prevImg = $imgDAO->getPrevImage($img);
				$prevImgId=$prevImg->getId(); 
				print "<a href=\"viewPhoto.php?imgId=$prevImgId&size=$size\">Prev</a>\n";
				// pre-calcul de l'image suivante
				$newImg = $imgDAO->getNextImage($img);
				$newImgId=$newImg->getId(); 
				print "<a href=\"viewPhoto.php?imgId=$newImgId&size=$size\">Next</a>\n";
				print "</p>\n";
				# Affiche l'image avec une reaction au click
				print "<a href=\"zoom.php?zoom=1.25&imgId=$imgId&size=$size\">\n";
				// RÃ©alise l'affichage de l'image
				$imgURL = $img->getURL();
				print "<img src=\"$imgURL\" width=\"$size\">\n";
				print "</a>\n";
				?>		
			</div>
		
		<div id="pied_de_page">
		</div>	   	   	
	</body>
</html>




