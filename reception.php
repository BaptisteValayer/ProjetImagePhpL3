<?php
    if ($_FILES['icone']['error'] > 0){ $erreur = "Erreur lors du transfert"; print $erreur; exit(0);}
    
    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    $extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
    if ( in_array($extension_upload,$extensions_valides) ) echo "Extension valide";
    else { $erreur = "Erreur lors du transfert"; print $erreur; exit(0); }
    
    $nom = "model/IMG/jons/external/{$_FILES['icone']['name']}.jpg";
    $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
    
    if ($resultat) {
        $db = new SQLite3('BD/BD.db');
        $nbrow = $db->query("select MAX(id)+1 from image;");
        $res = $nbrow->fetchArray();
        $query = "INSERT INTO image(id,path,category) VALUES(".$res[0].",'jons/external/".$_FILES['icone']['name']."','".$_POST['categorie']."');";
        $res = $db->exec($query);
        header('Location: index.php?controller=Home&action=index');
        exit();
    }
?>