<?php
require_once("model/image.php");
require_once("model/imageDAO.php");
$imgDAO = new ImageDAO();
$imgId = $_GET["imgId"];
$img = $imgDAO->getImage($imgId);
var_dump($img);
?>