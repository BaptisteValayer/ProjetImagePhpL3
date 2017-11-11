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
    // On parcourt la liste d'album afin d'en afficher le nom (avec un lien dessus permettant d'afficher le contenu)
    // Ainsi qu'un bouton de suppression (définitif)
    foreach($data->listAlbum as $album){
        print '<p><a href="index.php?controller=albumController&action=afficherAlbum&albumId='.$album->getId().'">'.$album->getNom().'</a>';
        print '  <a href="index.php?controller=albumController&action=deleteAlbum&albumId='.$album->getId().'"><button>Supprimer l\'album</button></a></p>';
    }
?>