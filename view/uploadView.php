<h1> Ajouter vos photos !</h1>

<form action="reception.php" method="post" enctype="multipart/form-data">
	<label for="icone">Fichier Image :</label>
	<input type="file" name="icone" id="icone" /><br />
	<label for="categorie">Categorie</label>
	<input type="text" name="categorie" id="categorie"/><br/>
	<input type="submit" name="submit" value="Transferer" />
</form>