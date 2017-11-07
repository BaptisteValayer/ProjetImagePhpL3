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
            else {
                $nb=$_GET["nb"];
            }
            if ((isset($_GET["action"]) && $_GET["action"]=="more")){
                $nb = $nb*2;
            }
            if (isset($_GET["action"]) && $_GET["action"]=="less"){
                if($nb>2) { $nb = $nb/2;}
            }
            if (isset($_GET["imgId"])) {
                $imgId = $_GET["imgId"];
                $imgList = $this->imageDAO->getImageList($this->imageDAO->getImage($imgId),$nb);
                
            } else {
                $imgList = $this->imageDAO->getImageList($this->imageDAO->getFirstImage(),$nb);
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
            global $data, $menu, $nb, $imgId, $imgList, $img;
            
            $this->getParam();
            foreach ($imgList as $img) {
                $data->imgId[] = array($img->getId());
                $data->imgURL[] = array($img->getURL());
            }
            $data->nb = $nb; 
            $img=$imgList[0];
            $data->imgList = $imgList;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $menu->setParam("index.php?controller=PhotoMatrix&action=more&nb=".$nb,"index.php?controller=PhotoMatrix&action=less&nb=".$nb);
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function next(){
            global $data, $menu, $nb, $imgId, $imgList, $img;
        
            $this->getParam();
            foreach ($imgList as $img) {
                $data->imgId[] = array($img->getId());
                $data->imgURL[] = array($img->getURL());
            }
            $data->nb = $nb;
            $img=$imgList[0];
            $data->imgList = $imgList;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function prev(){
            global $data, $menu, $nb, $imgId, $imgList, $img;
            
            $this->getParam();
            foreach ($imgList as $img) {
                $data->imgId[] = array($img->getId());
                $data->imgURL[] = array($img->getURL());
            }
            $data->nb = $nb;
            $img=$imgList[0];
            $data->imgList = $imgList;
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
            global $data, $menu, $nb, $imgId, $imgList, $img;
            $this->getParam();
            foreach ($imgList as $img) {
                $data->imgId[] = array($img->getId());
                $data->imgURL[] = array($img->getURL());
            }
            $data->nb = $nb;
            $img=$imgList[0];
            $data->imgList = $imgList;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $menu->setParam("index.php?controller=PhotoMatrix&action=more&nb=".$nb,"index.php?controller=PhotoMatrix&action=less&nb=".$nb);
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function less(){
            global $data, $menu, $nb, $imgId, $imgList, $img;
            
            $this->getParam();
            foreach ($imgList as $img) {
                $data->imgId[] = array($img->getId());
                $data->imgURL[] = array($img->getURL());
            }
            $data->nb = $nb;
            $img=$imgList[0];
            $data->imgList = $imgList;
            //Récupération de l'id de l'image suivante
            $data->nextId = $this->imageDAO->jumpToImage($img,$nb)->getId();
            //Récupération de l'id de l'image précédente
            $data->prevId = $this->imageDAO->jumpToImage($img,-$nb)->getId();
            $data->content = "view/photoMatrixView.php";
            $menu->setParam("index.php?controller=PhotoMatrix&action=more&nb=".$nb,"index.php?controller=PhotoMatrix&action=less&nb=".$nb);
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
    }
?>