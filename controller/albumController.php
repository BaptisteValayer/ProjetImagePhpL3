<?php
    require_once("model/image.php");
    require_once("model/imageDAO.php");
    require_once("model/albumDAO.php");
    require_once("model/album.php");
    require_once("controller/homeMenu.php");
    require_once("view/data.php");
    
    class AlbumController {
        
        protected $album;
        protected $albumDAO;
        protected $imageDAO;
        
        function __construct(){
            global $data, $menu;
            $data = new Data();
            
            $this->album = new Album();
            $this->albumDAO = new AlbumDAO();
            $this->imageDAO = new ImageDAO();
        }
        
        protected function getParam(){
            global $data, $menu;
            
            $menu = new HomeMenu();
            
            $listAlbum = $this->albumDAO->listAlbum();
            $data->listAlbum = $listAlbum;
            
            if(isset($_GET["albumId"])){
                $data->albumId = $_GET["albumId"];
            }
        }
        
        
        //Action affichant la page d'accueil des albums
        function index(){
            global $menu, $data;
            $this->getParam();
            $data->content = "view/albumView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        
        //Action gérant la création d'un album
        function createAlbum(){
            global $menu, $data;    
            if(isset($_GET['creerAlbum'])){
                if(isset($_GET['nomAlbum'])){
                    $this->albumDAO->createAlbum($_GET['nomAlbum']);
                }
            }
            
           
            $this->getParam();
            $data->content = "view/albumView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        // Action permettant l'affichage d'un album
        function afficherAlbum(){
            global $menu, $data;
            $this->getParam();
            $data->content = "view/photoAlbumView.php";
            $data->listPhotoAlbum = $this->imageDAO->getListImageAlbum($data->albumId);
            //var_dump($data->listPhotoAlbum);
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        // Action gérant la suppression d'un album
        function deleteAlbum(){
            global $data;
            $this->getParam();
            $this->albumDAO->deleteAlbum($data->albumId);
            $this->index();
        }
    }
?>