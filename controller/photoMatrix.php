<?php

    require_once("model/image.php");
    require_once("model/imageDAO.php");
    require_once("controller/photoMatrixMenu.php");
    require_once("view/data.php");
    
    class PhotoMatrix{
        
        protected $image;
        protected $imageDAO;
        
        function __construct(){
            global $data, $menu;
            $this->image = new Image();
            $this->imageDAO = new ImageDAO();
            $data = new Data();
            $menu = new PhotoMatrixMenu();
        }
        
        protected function getParam() {
            // RecupÃ¨re un Ã©ventuel no de dÃ©part
            global $imgId,$nb,$imgList;
            if (!isset($_GET["nb"])) {
                $nb=2;
            }
            if (isset($_GET["imgId"])) {
                $imgId = $_GET["imgId"];
                $imgId = $_GET["imgId"];
                $imgList = $this->imageDAO->getImageList($imgId,$nb);
                
            } else {
                $imgList = $this->imageDAO->getImageList($this->imageDAO->getFirstImage(),$nb);
                // Conserve son id pour dÃ©finir l'Ã©tat de l'interface
                $imgId = $imgList[0]->getId();
            }
        }
        
        // LISTE DES ACTIONS DE CE CONTROLEUR
        
        // Action par dÃ©faut
        function index() {
            global $data, $menu;
            $this->first();
        }
        
        function first(){
            global $data, $menu, $nb, $imgId, $imgList;
            $this->getParam();
            foreach ($imgList as $img) {
                $data->imgId[] = array($img->getId());
                console.log($img);
                $data->imgURL[] = array($img->getURL());
            }
                //$data->imgId += $img[$i];
                //$data->imgURL += $img[$i];
            $data->nb = $nb;
            $img=$imgList[0];
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function next(){
            global $data, $menu, $nb, $imgId, $img;
            $this->getParam();
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->nb = $nb;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function prev(){
            global $data, $menu, $nb, $imgId, $img;
            $this->getParam();
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->nb = $nb;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function random(){
            global $nb, $menu, $data;
            $this->getParam();
            $data->size = $size;
            $this->image = $this->imageDAO->getRandomImage();
            $data->imgURL = $this->image->getURL();
            
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($this->image,$nb)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($this->image,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function more(){
            global $data, $menu, $nb, $imgId, $img;
            $this->getParam();
            $data->imgId = $imgId;
            $imgURL = $img[0]->getURL();
            $data->imgURL = $imgURL;
            $data->nb = $nb*2;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img[0],$nb)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img[0],-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function less(){
            global $data, $menu, $nb, $imgId, $img;
            $this->getParam();
            $data->imgId = $imgId;
            $imgURL = $img[0]->getURL();
            $data->imgURL = $imgURL;
            $data->nb = $nb/2;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
    }
?>