<?php
    print "<p>\n";
    print "<a href=\"index.php?controller=Photo&action=prev&imgId=$data->imgId&size=$data->size\">Prev</a>\n";
    print "<a href=\"index.php?controller=Photo&action=next&imgId=$data->imgId&size=$size\">Next</a>\n";
    print "</p>\n";
    print "<img src=\"$data->imgURl\" width=\"\">\n";
?>