<form action="index.php" method="get">
<input type="hidden" name="controller" value="Photo">
<input type="hidden" name="action" value="first">
<select name="category">
	<?php 
	   // Affiche de la liste déroulante de la catégorie
	   $i=0;
	   while(isset($data->listCategory[$i])){
	       print "<option";
	           // cette condition permet de sélectionner la catégorie de l'image courante
	           if($data->listCategory[$i][0] == $data->categorie){
	               print " selected";
	           }
	       
           print ">";
	       print $data->listCategory[$i][0];
	       print "</option>";
	       $i++;
	   }
	?>
</select>
<button type="submit" name="filtrer" value="filtrer">Filtrer</button>
<a href="index.php?controller=Photo&action=first">Reset</a>
</form>

<?php
    //Affichage de l'image et de ses données
    print "<p>\n";
    print $data->printPrev;
    print $data->printNext;
    print "</p>\n";
    print "<img src=\"$data->imgURL\" width=\"$data->size\">\n";
    print "<p>\n";
    print "categorie de l'image: $data->categorie<br>\n";
    print "commentaire de l'image: $data->commentaire<br>\n";
    print "jugement: $data->jugement<br>\n";
    print "album:".$data->nomAlbum."</br>\n";
    print "</p>\n";
?>

<form action="index.php" method="get">
	<input type="hidden" name="controller" value="photo">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="imgId" value="<?php print $data->imgId?>">
	<label for="newCategory">Nouvelle catégorie: </label><input type="text" name="newCategory"><br>
	<label for="newComment">Nouveau commentaire: </label><input type="text" name="newComment">
	<br>
	<label for="newAlbum">Modifier l'album</label>
	<select name="newAlbum">
		<option value="">sans album</option>
	<?php 
	   // Liste déroulante pour afficher tous les albums disponbiles
	   foreach($data->listAlbum as $album){
	       print '<option value="'.$album->getId().'"';
	       if($album->getId() == $data->imgAlbumId){
	           print " selected "; 
	       }
	       print ">";
           print $album->getNom();
           print "</option>";
	   }
	?>
</select>
	<br>
	<button type="submit" name="valider" value="valider">Valider</button>
	<br>	
	<button type="submit" name="upJugement" value="upJugement">Up</button>
	<button type="submit" name="downJugement" value="downJugement">Down</button>
</form>
