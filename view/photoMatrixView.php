<?php
    print "<p>\n";
    print "<a href=\"index.php?controller=PhotoMatrix&action=prev&imgId=$data->prevId&nb=$data->nb\">Prev</a>\n";
    print "<a href=\"index.php?controller=PhotoMatrix&action=next&imgId=$data->nextId&nb=$data->nb\">Next</a>\n";
    print "</p>\n";
    /*foreach ($data->imgURL as $value) {
        print "<img src=\"$value\" nb=\"$data->nb\">\n";
    }*/
    var_dump($img);
?>