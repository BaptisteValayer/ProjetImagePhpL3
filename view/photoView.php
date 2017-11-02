<form action="index.php" method="get">
<input type="hidden" name="controller" value="Photo">
<input type="hidden" name="action" value="first">
<select name="category">
	<?php 
	   $i=0;
	   while(isset($data->listCategory[$i])){
	       print "<option>";
	       print $data->listCategory[$i][0];
	       print "</option>";
	       $i++;
	   }
	?>
</select>
<button type="submit" name="filtrer" value="filtrer">Filtrer</button>
</form>

<?php
    //TODO: faire de la mise en page pour la catégorie et le commentaire
    print "<p>\n";
    print "<a href=\"index.php?controller=Photo&action=prev&imgId=$data->prevId&size=$data->size\">Prev</a>\n";
    print "<a href=\"index.php?controller=Photo&action=next&imgId=$data->nextId&size=$size\">Next</a>\n";
    print "</p>\n";
    print "<img src=\"$data->imgURL\" width=\"$data->size\">\n";
    print "<p>\n";
    print "categorie de l'image: $data->categorie</br>\n";
    print "commentaire de l'image: $data->commentaire\n";
    print "</p>\n";
?>