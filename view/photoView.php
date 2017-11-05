<form action="index.php" method="get">
<input type="hidden" name="controller" value="Photo">
<input type="hidden" name="action" value="first">
<select name="category">
	<?php 
	   $i=0;
	   while(isset($data->listCategory[$i])){
	       print "<option";
	       if(isset($_GET["category"])){
	           if($data->listCategory[$i][0] == $_GET["category"]){
	               print " selected";
	           }
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
    //TODO: faire de la mise en page pour la catégorie et le commentaire
    print "<p>\n";
    print $data->printPrev;
    print $data->printNext;
    print "</p>\n";
    print "<img src=\"$data->imgURL\" width=\"$data->size\">\n";
    print "<p>\n";
    print "categorie de l'image: $data->categorie\n";
    print "commentaire de l'image: $data->commentaire\n";
    print "</p>\n";
?>

<form action="index.php" method="get">
	<input type="hidden" name="controller" value="photo">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="imgId" value="<?php print $data->imgId?>">
	<label for="newCategory">Nouvelle catégorie: </label><input type="text" name="newCategory"><br>
	<label for="newComment">Nouveau commentaire: </label><input type="text" name="newComment">
	<button type="submit" name="valider" value="valider">Valider</button>
</form>