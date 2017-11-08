<?php
    $Nfile = strtolower(  substr(  strrchr($_POST['url'], '/')  ,1)  );
    $resultat = copy($_POST['url'],"model/IMG/jons/external/".$Nfile);
    if ($resultat) {
        $db = new SQLite3('BD/BD.db');
        $nbrow = $db->query("select MAX(id)+1 from image;");
        $res = $nbrow->fetchArray();
        $query = "INSERT INTO image(id,path,category) VALUES(".$res[0].",'jons/external/".$Nfile."','".$_POST['categorie']."');";
        $res = $db->exec($query);
        header('Location: index.php?controller=Home&action=index');
        exit();
    }
?>