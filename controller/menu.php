<?php 
    
    class Menu{
        
        protected $menu;
        protected $menuPage;
        
        function __construct(){

        }
        
        function getHomePageMenu(){
            return $this->menu;
        }
        
        function affiche() {
            foreach ($this->menu as $item => $act) {
                $this->menuPage.="<li><a href=\"$act\">$item</a></li>\n";
            }
            return $this->menuPage;
        }
    }
?>