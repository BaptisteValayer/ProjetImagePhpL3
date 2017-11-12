<h1> Ajouter vos photos !</h1>
<h2>Upload depuis vos fichiers</h2>
<form action="index.php?controller=Download&action=upload" method="post" enctype="multipart/form-data">
	<label for="icone">Fichier Image :</label>
	<input type="file" name="icone" id="icone" /><br />
	<label for="categorie">Categorie</label>
	<input type="text" name="categorie" id="categorie"/><br/>
	<input type="submit" name="submit" value="Transferer" />
</form>
<h2>Download depuis un lien</h2>
<form action="index.php?controller=Download&action=download" method="post" enctype="multipart/form-data">
	<label for="url">Fichier Image :</label>
	<input type="text" name="url" id="url" /><br />
	<label for="categorie">Categorie</label>
	<input type="text" name="categorie" id="categorie"/><br/>
	<input type="submit" name="submit" value="Transferer" />
</form>