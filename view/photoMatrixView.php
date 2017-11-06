<?php
    print "<p>\n";
    print "<a href=\"index.php?controller=PhotoMatrix&action=prev&imgId=$data->prevId&nb=$data->nb\">Prev</a>\n";
    print "<a href=\"index.php?controller=PhotoMatrix&action=next&imgId=$data->nextId&nb=$data->nb\">Next</a>\n";
    print "</p>\n";
    /*foreach ($img as $value) {
        print "****".$value->Id;
    }*/
    var_dump($data->imgId);
?>