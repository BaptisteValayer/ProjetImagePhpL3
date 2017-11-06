<form action="index.php">
<input type="hidden" name="controller" value="AlbumController">
<input type="hidden" name="action" value="createAlbum">
<fieldset>
	<legend>Création d'un nouvel album</legend>
	<label for="nomAlbum">Nom de l'album</label><input type="text" name="nomAlbum">
	<button type="submit" name="creerAlbum" value="creerAlbum">Créer l'album</button>
</fieldset>
</form>

<?php 
    foreach($data->listAlbum as $album){
        print '<p>'.$album->getNom().'</p>';
    }
?>