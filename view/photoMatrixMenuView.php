<?php
    # Mise en place du menu par un parcours de la table associative
    $menu['Home']="index.php?controller=Home&action=index";
    $menu['A propos']="index.php?controller=Home&action=aPropos";
    $menu['Voir photos']="viewPhoto.php";
    // Pre-calcule la premiÃ¨re image
    //$newImg = $imgDAO->getFirstImage();
    # Change l'etat pour indiquer que cette image est la nouvelle
    //$newImgId=$newImg->getId();
    $menu['First']="index.php?controller=Home&action=first";
    # Pre-calcule une image au hasard
    //$newImg = $imgDAO->getRandomImage();
    //$newImgId = $newImg->getId();
    $menu['Random']="index.php?controller=Home&action=random";
    # Pour afficher plus d'image passe Ã  une autre page
    $menu['More']="index.php?controller=Home&action=more&nb=2";
    // Demande Ã  calculer un zoom sur l'image
    $menu['Zoom +']="index.php?controller=Home&action=zoomI";
    // Demande Ã  calculer un zoom sur l'image
    $menu['Zoom -']="index.php?controller=Home&action=zoomD";
    foreach ($menu as $item => $act) {
        print "<li><a href=\"$act\">$item</a></li>\n";
    }
?>