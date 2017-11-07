<?php
require_once("menu.php");

class PhotoMenu extends Menu {
    
    function __construct($category=null) {
        $this->menu['Home']="index.php?controller=Home&action=index";
        $this->menu['A propos']="index.php?controller=Home&action=aPropos";
        if($category==null){
            $this->menu['First']="index.php?controller=Photo&action=first&imgId=1&size=480";
            $this->menu['Random']="index.php?controller=Photo&action=random";
            # Pour afficher plus d'image passe Ã  une autre page
            $this->menu['More']="index.php?controller=PhotoMatrix&action=index&nb=2";
            // Demande Ã  calculer un zoom sur l'image
            $this->menu['Zoom +']="index.php?controller=Photo&action=zoom";
            // Demande Ã  calculer un zoom sur l'image
            //$this->$menu['Zoom -']="nonRealise.php";
            // Affichage du menu
            $this->menu['Upload']="index.php?controller=Upload&action=index";
        }else{
            $this->menu['First']="index.php?controller=Photo&action=first&imgId=1&size=480&category=$category";
            $this->menu['Random']="index.php?controller=Photo&action=random&category=$category";
            # Pour afficher plus d'image passe Ã  une autre page
            $this->menu['More']="index.php?controller=PhotoMatrix&action=more&nb=2";
            // Demande Ã  calculer un zoom sur l'image
            $this->menu['Zoom +']="index.php?controller=Photo&action=zoom";
            $this->menu['Upload']="index.php?controller=Upload&action=index";
        }
    }
    
    function setZoom($newLink){
        $this->menu['Zoom +']=$newLink;
    }
        
}