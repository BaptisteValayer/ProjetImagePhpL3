<?php
include 'model/imageDAO.php';

$ImageDao = new ImageDAO();

$image = $ImageDao->getImage(1);
var_dump($image);
?>