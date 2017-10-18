<?php 
# Mise en place du menu par un parcours de la table associative
                   /* $menu['Home']="index.php?controller=Home&action=index";
                    $menu['A propos']="index.php?controller=Home&action=aPropos";
					$menu['Voir photos']="viewPhoto.php";
					*/
					foreach ($data->menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
?>