<?php
    print "<p>\n";
    print "<a href=\"index.php?controller=PhotoMatrix&action=prev&imgId=$data->prevId&nb=$data->nb\">Prev</a>\n";
    print "<a href=\"index.php?controller=PhotoMatrix&action=next&imgId=$data->nextId&nb=$data->nb\">Next</a>\n";
    print "</p>\n";
    foreach ($data->imgList as $value) {
        $src = $value->getURL();
        print "<img src=\"$src\" nb=\"$data->nb\">\n";
    }
    var_dump($data->imgURL);
?>