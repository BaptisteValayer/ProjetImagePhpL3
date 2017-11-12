<?php
require_once("model/downloadDAO.php");
require_once("controller/homeMenu.php");
require_once("view/data.php");

    class Download {
        protected $downloadDAO;
        
        function __construct(){
            global $data, $menu;
            $data = new Data();
            $menu = new HomeMenu();
            $this->downloadDAO = new DownloadDAO();
        }
        
        protected function getParam(){
            global $data, $menu;
            $menu = new HomeMenu();
        }
        
        //Action affichant la page d'accueil des albums
        function index(){
            global $menu, $data;
            $data->content = "view/download.php";
            $data->menu = $menu->affiche();
            require_once("view/mainView.php");
        }
        
        function upload() {
            //test si le fichier existe
            if ($_FILES['icone']['error'] > 0){ $erreur = "Erreur lors du transfert"; print $erreur; exit(0);}
            
            //test de l'extension du fichier
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
            if ( in_array($extension_upload,$extensions_valides) ) echo "Extension valide";
            else { $erreur = "Erreur lors du transfert"; print $erreur; exit(0); }
            
            //upload
            $nom = "model/IMG/jons/external/{$_FILES['icone']['name']}.jpg";
            $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
            
            //insert in BD
            $this->downloadDAO->insert($_FILES['icone']['name'],$_POST['categorie']);
            $this->goToHome();
        }
        
        function download() {
            //download
            $Nfile = strtolower(  substr(  strrchr($_POST['url'], '/')  ,1)  );
            $resultat = copy($_POST['url'],"model/IMG/jons/external/".$Nfile);
            
            //insert in BD
            $this->downloadDAO->insert($Nfile,$_POST['categorie']);
            $this->goToHome();
        }
        
        function goToHome() {
            header('Location: index.php?controller=Home&action=index');
            exit();
        }
    }