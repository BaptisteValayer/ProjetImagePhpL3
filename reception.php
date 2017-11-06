<?php
if ($_FILES['icone']['error'] > 0){ $erreur = "Erreur lors du transfert"; print $erreur; exit(0);}

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
$extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension valide";
else { $erreur = "Erreur lors du transfert"; print $erreur; exit(0); }

$nom = "model/IMG/jons/external/{$_FILES['icone']['name']}.jpg";
$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
if ($resultat) {
    require_once("model/imageDAO.php");
    $dbhandle = new SQLiteDatabase('BD/BD.db');
    $requete = "INSERT INTO image(path,category) VALUES('{$_FILES['icone']['name']}','{$_POST['categorie']}'";
    $query = $dbhandle->queryExec($requete,$error);
    if (!$query) {
        exit("Erreur dans la requête : '$error'");
    } else {
        echo 'Nombre de lignes modifiées : ', $dbhandle->changes();
    }
}