<?php
    require_once("model/image.php");
    require_once("model/album.php");
    require_once("model/imageDAO.php");
    require_once("model/albumDAO.php");
    require_once("controller/photoMenu.php");
    require_once("view/data.php");

    class Photo {
        
        protected $image;
        protected $imageDAO;
        protected $album;
        protected $albumDAO;
        
        function __construct(){
            global $data, $menu;
            $this->image = new Image();
            $this->imageDAO = new ImageDAO();
            $this->album = new Album();
            $this->albumDAO = new AlbumDAO();
            $data = new Data();
            //$menu = new PhotoMenu();

            
        }
        
        // Recupere les parametres de maniÃ¨re globale
        // Pour toutes les actions de ce contrÃ´leur
        protected function getParam() {
            // Recupère l'id de l'image
            global $imgId,$size,$img, $listCategory, $data, $menu;
            
            $menu = new PhotoMenu();
            
            if (isset($_GET["imgId"])) {
                $imgId = $_GET["imgId"];
                $img = $this->imageDAO->getImage($imgId);
            } else {
                $img = $this->imageDAO->getFirstImage();
                // Conserve son id pour dÃ©finir l'Ã©tat de l'interface
                $imgId = $img->getId();
            }
            
            // Recupère la taille
            if (isset($_GET["size"])) {
                $size = $_GET["size"];
            } else {
                $size = 480;
            }
            $listCategory = $this->imageDAO->getAllCategory();
            $data->listCategory = $listCategory;
            
            $listAlbum = $this->albumDAO->listAlbum();
            $data->listAlbum = $listAlbum;
           
            
            if(isset($_GET["action"])){
                if($_GET["action"] == "random"){
                    //Récupération de l'id de l'image suivante
                    $this->image = $this->imageDAO->getRandomImage();
                    $data->nextId = $this->imageDAO->getNextImage($this->image)->getId();
                    
                    //Récupération de l'id de l'image précédente
                    $data->prevId = $this->imageDAO->getPrevImage($this->image)->getId();
                }else{
                    //Récupération de l'id de l'image suivante
                    $data->nextId = $this->imageDAO->getNextImage($img)->getId();
                    
                    //Récupération de l'id de l'image précédente
                    $data->prevId = $this->imageDAO->getPrevImage($img)->getId();
                }
                
            }
            
            if (isset($_GET["category"])){
                $category = $_GET["category"];
                $listId = $this->imageDAO->getListId($category);
                if(isset($_GET["positionListId"])){
                    $positionListId = $_GET["positionListId"];
                }else{
                    $positionListId = 0;
                }
                $img = $this->imageDAO->getImage($listId[$positionListId][0]);
                $data->imgId=$img->getId();
                $nextPosition = $positionListId + 1;
                $prevPosition = $positionListId - 1;
                
                if($nextPosition == count($listId)){
                    $nextPosition = 0;
                }
                if($prevPosition == -1){
                    $prevPosition = count($listId) - 1;
                } 
                $data->nextId = $listId[$nextPosition][0];
                $data->prevId = $listId[$prevPosition][0];
                $data->printNext = "<a href=\"index.php?controller=Photo&action=next&size=$size&imgId=$data->nextId&category=$category&positionListId=$nextPosition\">Next</a>\n";
                $data->printPrev = "<a href=\"index.php?controller=Photo&action=prev&size=$size&imgId=$data->nextId&category=$category&positionListId=$prevPosition\">Prev</a>\n";
            }else{
                $data->printNext = "<a href=\"index.php?controller=Photo&action=next&imgId=$data->nextId&size=$size\">Next</a>\n";
                $data->printPrev = "<a href=\"index.php?controller=Photo&action=prev&imgId=$data->prevId&size=$size\">Prev</a>\n";
            } 
            
            if($img->getIdAlbum() != null){
                $id = $img->getIdAlbum();
                $currentAlbum = $this->albumDAO->getAlbum($id);
                $data->nomAlbum = $currentAlbum->getNom();
                $data->imgAlbumId = $id;
            }else{
                $data->nomAlbum = "pas d'album";
                $data->imgAlbumId = -1;
            }
        }
        
        // LISTE DES ACTIONS DE CE CONTROLEUR
        
        // Action par dÃ©faut
        function index() {
            global $data, $menu;
            $this->first();
        }
        
        function first(){
            global $data, $menu, $size, $img, $imgId, $listCategory;
            $this->getParam();
            //récupération de l'image à partir de l'id
            $data->imgId = $imgId;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->size = $size;

            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            $data->commentaire = $img->getCommentaire();
            $data->categorie = $img->getCategorie();
            $data->jugement = $img->getJugement();
            
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
            $data->jugement = $img->getJugement();
            
            $data->commentaire = $img->getCommentaire();
            $data->categorie = $img->getCategorie();
            
            
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
            $data->jugement = $img->getJugement();
            
            $data->commentaire = $img->getCommentaire();
            $data->categorie = $img->getCategorie();
            
            
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function random(){
            global $size, $menu, $data;
            $this->getParam();
            $data->size = $size;
            $data->imgURL = $this->image->getURL();
            
            $imgId = $this->image->getId();
            $data->imgId = $imgId;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            $data->jugement = $this->image->getJugement();
            
            $data->commentaire = $this->image->getCommentaire();
            $data->categorie = $this->image->getCategorie();
            
            if($this->image->getIdAlbum() != null){
                $id = $this->image->getIdAlbum();
                $currentAlbum = $this->albumDAO->getAlbum($id);
                $data->nomAlbum = $currentAlbum->getNom();
                $data->imgAlbumId = $id;
            }else{
                $data->nomAlbum = "pas d'album";
                $data->imgAlbumId = -1;
            }
            
            
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
            
            $data->commentaire = $img->getCommentaire();
            $data->categorie = $img->getCategorie();
            $data->jugement = $img->getJugement();
            
            $data->content = "view/photoView.php";
            
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function update(){
            global $data, $menu, $size, $imgId, $img;
            $this->getParam();
            
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $data->size = $size;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            $data->imgId = $imgId;
            if(isset($_GET["newComment"])){
                if(!empty($_GET["newComment"])){
                    $this->imageDAO->updateComment($imgId, $_GET["newComment"]);
                }
            }
            
            if(isset($_GET["newCategory"])){
                if(!empty($_GET["newCategory"])){
                    $this->imageDAO->updateCategory($imgId, $_GET["newCategory"]);
                }
            }
            
            if(isset($_GET["upJugement"])){
                $this->imageDAO->updateJugementUp($imgId);
            }
            
            if(isset($_GET["downJugement"])){
                $this->imageDAO->updateJugementDown($imgId);
            }
            
            if(isset($_GET["newAlbum"])){
                if(!empty($_GET["newAlbum"])){
                    $this->imageDAO->updateAlbum($imgId, $_GET["newAlbum"]);
                }else{
                    $this->imageDAO->updateAlbum($imgId, null);
                }
            }
            $img = $this->imageDAO->getImage($imgId);
            $data->commentaire = $img->getCommentaire();
            $data->categorie = $img->getCategorie();
            $data->jugement = $img->getJugement();
            
            if($img->getIdAlbum() != null){
                $id = $img->getIdAlbum();
                $currentAlbum = $this->albumDAO->getAlbum($id);
                $data->nomAlbum = $currentAlbum->getNom();
                $data->imgAlbumId = $id;
            }else{
                $data->nomAlbum = "pas d'album";
                $data->imgAlbumId = -1;
            }
            
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
         
    }
?>