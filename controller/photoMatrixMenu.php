<?php
require_once("menu.php");

class PhotoMatrixMenu extends Menu {
    
    function __construct() {
        $this->menu['Home']="index.php?controller=Home&action=index";
        $this->menu['A propos']="index.php?controller=Home&action=aPropos";
        $this->menu['First']="index.php?controller=Photo&action=first&imgId=1&size=480";
        $this->menu['Random']="index.php?controller=Photo&action=random";
        # Pour afficher plus d'image passe Ã  une autre page
        $this->menu['More']="index.php?controller=PhotoMatrix&action=more";
        $this->menu['Less']="index.php?controller=PhotoMatrix&action=less";
        // Affichage du menu
    }
}
?>