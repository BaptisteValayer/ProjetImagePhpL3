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
    print "categorie de l'image: $data->categorie</br>\n";
    print "commentaire de l'image: $data->commentaire\n";
    print "</p>\n";
?>