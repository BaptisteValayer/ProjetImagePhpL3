<?php
    require_once("view/data.php");
    require_once("view/menu.php");
    
    class Home {
        
        function __construct(){
            global $data;
            global $menu;
            $menu = new Menu();
            $data = new Data();
            //$data->menu['Home'] = "index.php";
            $data->menu = $menu->getHomePageMenu();
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
            $data->content = "view/homeView.php";
            require_once("view/mainView.php");
        }
        
        function aPropos(){
            global $from,$mode,$data;
            $m = new HomeMenu();
            $this->getParam();
            // Selectionne et charge la vue
            $data->content = "view/aProposView.php";
            $data->menu = $m->affiche();
            require_once("view/mainView.php");
        }
    }


?>