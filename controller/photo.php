<?php
    require_once("model/image.php");
    require_once("model/imageDAO.php");
    require_once("controller/photoMenu.php");
    require_once("view/data.php");

    class Photo {
        
        protected $image;
        protected $imageDAO;
        
        function __construct(){
            global $data, $menu;
            $this->image = new Image();
            $this->imageDAO = new ImageDAO();
            $data = new Data();
            $menu = new PhotoMenu();

            
        }
        
        // Recupere les parametres de maniÃ¨re globale
        // Pour toutes les actions de ce contrÃ´leur
        protected function getParam() {
            // Recupère l'id de l'image
            global $imgId,$size,$img;
            if (isset($_GET["imgId"])) {
                $imgId = $_GET["imgId"];
                $imgId = $_GET["imgId"];
                $img = $this->imageDAO->getImage($imgId);
            } else {
                $img = $this->imageDAO->getFirstImage();
                // Conserve son id pour dÃ©finir l'Ã©tat de l'interface
                $imgId = $img->getId();
            }
            // Recupere le mode delete de l'interface
            if (isset($_GET["size"])) {
                $size = $_GET["size"];
            } else {
                $size = 480;
            }
        }
        
        // LISTE DES ACTIONS DE CE CONTROLEUR
        
        // Action par dÃ©faut
        function index() {
            global $data, $menu;
            $this->first();
        }
        
        function first(){
            global $data, $menu, $size, $img, $imgId;
            $this->getParam();
            //récupération de l'image à partir de l'id
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->size = $size;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->getNextImage($img)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->getPrevImage($img)->getId();
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function next(){
            global $data, $menu, $size, $imgId, $img;
            $this->getParam();
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->size = $size;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            /*
            $this->image = $this->imageDAO->getNextImage($img);
            $imgURL = $this->image->getURL();
            $data->imgId = $this->image->getId();;
            $data->imgURl = $this->image->getURL();*/
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->getNextImage($img)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->getPrevImage($img)->getId();
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function prev(){
            global $data, $menu, $size, $imgId, $img;
            $this->getParam();
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->size = $size;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            /*
             $this->image = $this->imageDAO->getNextImage($img);
             $imgURL = $this->image->getURL();
             $data->imgId = $this->image->getId();;
             $data->imgURl = $this->image->getURL();*/
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->getNextImage($img)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->getPrevImage($img)->getId();
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function random(){
            global $size, $menu, $data;
            $this->getParam();
            $data->size = $size;
            $this->image = $this->imageDAO->getRandomImage();
            $data->imgURL = $this->image->getURL();
            
            $imgId = $this->image->getId();
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->getNextImage($this->image)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->getPrevImage($this->image)->getId();
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function zoom(){
            global $size, $img, $data, $imgId, $menu;
            $this->getParam();
            $data->imgId = $imgId;
            $data->size = $size*1.25;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$data->size");
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->getNextImage($this->image)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->getPrevImage($this->image)->getId();
            $data->content = "view/photoView.php";
            
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
         
    }
?>