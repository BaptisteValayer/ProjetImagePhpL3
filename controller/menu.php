<?php 
    
    class Menu{
        
        protected $menu;
        
        function __construct(){

        }
        
        function getHomePageMenu(){
            return $this->menu;
        }
        
        function affiche() {
            foreach ($data->menu as $item => $act) {
                print "<li><a href=\"$act\">$item</a></li>\n";
            }
        }
    }
?>