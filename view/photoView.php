<?php
    print "<p>\n";
    print "<a href=\"index.php?controller=Photo&action=prev&imgId=$data->prevId&size=$data->size\">Prev</a>\n";
    print "<a href=\"index.php?controller=Photo&action=next&imgId=$data->nextId&size=$size\">Next</a>\n";
    print "</p>\n";
    print "<img src=\"$data->imgURl\" width=\"$data->size\">\n";
?>