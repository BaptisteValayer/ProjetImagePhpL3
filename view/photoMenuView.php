<?php 
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