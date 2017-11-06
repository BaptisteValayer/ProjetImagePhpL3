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
        
        function __construct(){
            global $data, $menu;
            $data = new Data();
            
            $this->album = new Album();
            $this->albumDAO = new AlbumDAO();
        }
        
        protected function getParam(){
            global $data, $menu;
            
            $menu = new HomeMenu();
            
            $listAlbum = $this->albumDAO->listAlbum();
            $data->listAlbum = $listAlbum;
        }
        
        function index(){
            global $menu, $data;
            $this->getParam();
            $data->content = "view/albumView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
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
    }
?>