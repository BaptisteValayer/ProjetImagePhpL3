<?php

    class HomeMenu extends Menu {
        
        function __construct() {
            $this->menu['Home']="index.php?controller=Home&action=index";
            $this->menu['A propos']="index.php?controller=Home&action=aPropos";
            $this->menu['Voir photos']="index.php?controller=Photo&action=first";
        }
    }