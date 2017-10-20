<?php
    require_once("model/image.php");
    require_once("view/menu.php");
    require_once("view/data.php");

    class Photo {
        
        protected $image;
        
        function __construct(){
            $this->image = new Image();
        }
        
        // Recupere les parametres de maniÃ¨re globale
        // Pour toutes les actions de ce contrÃ´leur
        protected function getParam() {
            // RecupÃ¨re un Ã©ventuel no de dÃ©part
            global $from,$mode;
            if (isset($_GET["from"])) {
                $from = $_GET["from"];
            } else {
                $from = 1;
            }
            // Recupere le mode delete de l'interface
            if (isset($_GET["mode"])) {
                $mode = $_GET["mode"];
            } else {
                $mode = "normal";
            }
        }
        
        // LISTE DES ACTIONS DE CE CONTROLEUR
        
        // Action par dÃ©faut
        function index() {
            global $from,$mode,$data;
            $this->getParam();
            // Selectionne et charge la vue
            require_once("view/main.php");
        }
        
        function first(){
            global $data;
            $data->content = "view/photoView.php";
            require_once("view/mainView.php");
        }
        
        function next(){
            
        }
        
        function prev(){
            
        }
        
        function random(){
            
        }
        
        function zoom(){
            
        }
         
    }
?>