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
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURl = $imgURL;
            $data->size = $size;
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function next(){
            global $data, $menu, $size, $imgId, $img;
            $this->getParam();
            $this->image = $this->imageDAO->getNextImage($img);
            $imgURL = $this->image->getURL();
            $data->imgId = $this->image->getId();;
            $data->imgURl = $this->image->getURL();
            $data->size = $size;
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function prev(){
            global $data, $menu, $size, $imgId, $img;
            $this->getParam();
            $this->image = $this->imageDAO->getPrevImage($img);
            $imgURL = $this->image->getURL();
            $data->imgId = $this->image->getId();;
            $data->imgURl = $this->image->getURL();
            $data->size = $size;
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function random(){
            
        }
        
        function zoom(){
            
        }
         
    }
?>