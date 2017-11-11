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
        
        // Recupere les parametres de manière globale
        // Pour toutes les actions de ce controleur
        protected function getParam() {
            global $imgId,$size,$img, $listCategory, $data, $menu;
            //Création du menu approprié
            $menu = new PhotoMenu();
            
            //récupération de l'id de l'image
            if (isset($_GET["imgId"])) {
                $imgId = $_GET["imgId"];
                $img = $this->imageDAO->getImage($imgId);
            } else {
                $img = $this->imageDAO->getFirstImage();
                // Conserve son id pour dÃ©finir l'Ã©tat de l'interface
                $imgId = $img->getId();
            }
            
            //Attribution des variables d'images
            $data->commentaire = $img->getCommentaire();
            $data->categorie = $img->getCategorie();
            $data->jugement = $img->getJugement();
            $data->imgURL = $img->getURL();
            
            // Recupère la taille
            if (isset($_GET["size"])) {
                $size = $_GET["size"];
            } else {
                $size = 480;
            }
            $data->size = $size;
            
            //Création de la variable contenant les catégories (pour la liste déroulante)
            $listCategory = $this->imageDAO->getAllCategory();
            $data->listCategory = $listCategory;
            
            //Création de la variable contenant la liste des albums (pour la liste déroulante)
            $listAlbum = $this->albumDAO->listAlbum();
            $data->listAlbum = $listAlbum;
           
            //Calcul de l'image précédente et suivante
            //On test si on est dans "random" car dans ce cas là l'image courrante doit être aléatoire
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
            
            
            // Si on a le filtre de la catégorie en cours le calcul des images précédentes et suivantes est différent
            // car on doit tenir compte de la catégorie
            if (isset($_GET["category"])){
                $category = $_GET["category"];
                // On récupère la liste des ID des images de la catégorie
                $listId = $this->imageDAO->getListId($category);
                
                //On récupère la position courante dans la liste si elle existe
                if(isset($_GET["positionListId"])){
                    $positionListId = $_GET["positionListId"];
                }else{
                    $positionListId = 0;
                }
                
                //On récupère l'image gràce à l'ID de la position courante dans la liste
                $data->img = $this->imageDAO->getImage($listId[$positionListId][0]);
                $img = $data->img;
                
                //On affecte les données dans la variable data
                $data->imgURL = $data->img->getURL();
                $data->commentaire = $data->img->getCommentaire();
                $data->categorie = $data->img->getCategorie();
                $data->jugement = $data->img->getJugement();
                $data->imgId=$img->getId();
                
                //On met à jour la poistion suivante et précédente dans la lsite
                $nextPosition = $positionListId + 1;
                $prevPosition = $positionListId - 1;
                
                //On test si on est en bout de liste(début ou fin) afin de créer une rotation dans le parcours des images
                if($nextPosition == count($listId)){
                    $nextPosition = 0;
                }
                if($prevPosition == -1){
                    $prevPosition = count($listId) - 1;
                } 
                $data->nextId = $listId[$nextPosition][0];
                $data->prevId = $listId[$prevPosition][0];
                
                //On met à jour le lien vers l'image suivante et l'image précédente
                $data->printNext = "<a href=\"index.php?controller=Photo&action=next&size=$size&imgId=$data->nextId&category=$category&positionListId=$nextPosition\">Next</a>\n";
                $data->printPrev = "<a href=\"index.php?controller=Photo&action=prev&size=$size&imgId=$data->nextId&category=$category&positionListId=$prevPosition\">Prev</a>\n";
            }else{
                $data->printNext = "<a href=\"index.php?controller=Photo&action=next&imgId=$data->nextId&size=$size\">Next</a>\n";
                $data->printPrev = "<a href=\"index.php?controller=Photo&action=prev&imgId=$data->prevId&size=$size\">Prev</a>\n";
            } 
            
            //On gère l'affichage des informations de l'album en fonction de si l'image est dans un album ou non
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
        
        
        // Action sélectionnant la première image
        function first(){
            global $data,$imgId, $menu;
            $this->getParam();
            $data->imgId = $imgId;
            // On met à jour le menu zoom afin de préserver l'image courante
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$data->imgId&size=$data->size");
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        // Action affichant l'image suivante
        function next(){
            global $data, $menu, $imgId;
            $this->getParam();
            $data->imgId = $imgId;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$data->imgId&size=$data->size");
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        // Action affichant l'image précédente
        function prev(){
            global $data, $menu, $imgId;
            $this->getParam();
            $data->imgId = $imgId;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$data->imgId&size=$data->size");
            $data->content = "view/photoView.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        
        // Action affichant une image au hasard
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
        
        // Action zoommant sur l'image courante
        function zoom(){
            global $size, $img, $data, $imgId, $menu;
            $this->getParam();
            $data->imgId = $imgId;
            $data->size = $size*1.25;
            $imgURL = $img->getURL();
            $data->imgURL = $imgURL;
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$data->size");
            $data->content = "view/photoView.php";
            
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        // Action gérant la mise à jour des données du formulaire
        function update(){
            global $data, $menu, $size, $imgId, $img;
            $this->getParam();
            $menu->setZoom("index.php?controller=Photo&action=zoom&imgId=$imgId&size=$size");
            $data->imgId = $imgId;
            
            // On met à jour le commentaire si on a une donnée
            if(isset($_GET["newComment"])){
                if(!empty($_GET["newComment"])){
                    $this->imageDAO->updateComment($imgId, $_GET["newComment"]);
                }
            }
            
            // On met à jour la catégorie si on a une donnée
            if(isset($_GET["newCategory"])){
                if(!empty($_GET["newCategory"])){
                    $this->imageDAO->updateCategory($imgId, $_GET["newCategory"]);
                }
            }
            
            // On augmente la valeur du jugement si on a une donnée
            if(isset($_GET["upJugement"])){
                $this->imageDAO->updateJugementUp($imgId);
            }
            
            // On diminue la valeur du jugement is on a une donnée
            if(isset($_GET["downJugement"])){
                $this->imageDAO->updateJugementDown($imgId);
            }
            
            // On met à jour l'album si on a une donnée
            if(isset($_GET["newAlbum"])){
                if(!empty($_GET["newAlbum"])){
                    $this->imageDAO->updateAlbum($imgId, $_GET["newAlbum"]);
                }else{
                    $this->imageDAO->updateAlbum($imgId, null);
                }
            }
            // On récupère les informations de l'image courante pour réafficher cette image
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