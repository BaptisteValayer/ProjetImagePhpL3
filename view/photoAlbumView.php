<?php
    foreach($data->listPhotoAlbum as $photo){
        print '<img src="'.$photo->getURL().'" width=200>';
        print '<p> Commentaire:'.$photo->getCommentaire().'<br>
                    Categorie:'.$photo->getCategorie().'</p>';
        
    }
?>