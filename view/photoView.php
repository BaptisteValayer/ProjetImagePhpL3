<?php
    //TODO: faire de la mise en page pour la catégorie et le commentaire
    print "<p>\n";
    print "<a href=\"index.php?controller=Photo&action=prev&imgId=$data->prevId&size=$data->size\">Prev</a>\n";
    print "<a href=\"index.php?controller=Photo&action=next&imgId=$data->nextId&size=$size\">Next</a>\n";
    print "</p>\n";
    print "<img src=\"$data->imgURL\" width=\"$data->size\">\n";
    print "<p>\n";
    print "categorie de l'image: $data->categorie</br>\n";
    print "commentaire de l'image: $data->commentaire\n";
    print "</p>\n";
?>