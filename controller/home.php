<?php
    require_once("view/data.php");
    
    class Home {
        
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
            $data = new Data();
            $data->content = "homeView.php";
            $data->menu['Home'] = "index.php";
            require_once("view/mainView.php");
        }
        
        function aPropos(){
            global $from,$mode,$data;
            $this->getParam();
            // Selectionne et charge la vue
            $data = new Data();
            $data->content = "homeView.php";
            $data->menu['Home'] = "index.php";
            require_once("view/aProposView.php");
        }
    }


?>