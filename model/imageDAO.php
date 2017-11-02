<?php
	require_once("image.php");
	# Le 'Data Access Object' d'un ensemble images
	class ImageDAO {
		
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# A MODIFIER EN FONCTION DE VOTRE INSTALLATION
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# Chemin LOCAL où se trouvent les images
		private $path="model/IMG";
		# Chemin URL où se trouvent les images
		const urlPath="http://localhost/L3_Pro/Prog_PHP/Workspace/ProjetImagePhpL3/model/IMG/";
		
		# Tableau pour stocker tous les chemins des images
		private $imgEntry;
		
		# Lecture récursive d'un répertoire d'images
		# Ce ne sont pas des objets qui sont stockes mais juste
		# des chemins vers les images.
		/*private function readDir($dir) {
			# build the full path using location of the image base
			$fdir=$this->path.$dir;
			if (is_dir($fdir)) {
				$d = opendir($fdir);
				while (($file = readdir($d)) !== false) {
					if (is_dir($fdir."/".$file)) {
						# This entry is a directory, just have to avoid . and .. or anything starts with '.'
						if (($file[0] != '.')) {
							# a recursive call
							$this->readDir($dir."/".$file);
						}
					} else {
						# a simple file, store it in the file list
						if (($file[0] != '.')) {
							$this->imgEntry[]="$dir/$file";
						}
					}
				}
			}
		}*/
		
	
		
		function __construct() {
		    $dsn = 'sqlite:BD/BD.db'; // Data source name
		    $user= ''; // Utilisateur
		    $pass= ''; // Mot de passe
		    try {
		        $this->db = new PDO($dsn, $user, $pass); //$db est un attribut prive d'ImageDAO
		    } catch (PDOException $e) {
		        die ("Erreur : ".$e->getMessage());
		    }
		}
		
		# Retourne le nombre d'images référencées dans le DAO
		function size() {
			$s = $this->db->query('SELECT COUNT(*) FROM image');
			if($s){
			    $data = $s->fetch();
			    return $data[0];
			}
		}
		
		# Retourne un objet image correspondant à l'identifiant
		function getImage($id, $category=null) {
		    $requete = 'SELECT * FROM image WHERE id='.$id;
		    if($category != null){
		        $requete.= 'and category='.$category;
		    }
		    var_dump($requete);
		    $s = $this->db->query($requete);
		    if ($s) {
		        $data = $s->fetchAll(PDO::FETCH_CLASS, 'Image');
		        //var_dump($data);
		        //exit(0);
		       // $img = new Image(self::urlPath.$data['path'], $data['id']) ;    
		        return $data[0];
		    } else {
		        print "Error in getImage. id=".$id."<br/>";
		        $err= $this->db->errorInfo();
		        print $err[2]."<br/>";
		    }
		}
		
		# Retourne une image au hazard
		function getRandomImage() {
		    //trigger_error("Non réalisé");
		    return $this->getImage(rand(1, $this->size()));
		}
		
		# Retourne l'objet de la premiere image
		function getFirstImage() {
			return $this->getImage(1);
		}
		
		# Retourne l'image suivante d'une image
		function getNextImage(Image $img) {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
			}else{
			    $img = $this->getImage(1);
			}
			return $img;
		}
		
		# Retourne l'image précédente d'une image
		function getPrevImage(Image $img) {
		    $id = $img->getId();
		    if ($id > 1 ) {
		        $img = $this->getImage($id-1);
		    }else{
		        $img = $this->getImage($this->size());
		    }
		    return $img;
		}
		
		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(image $img,$nb) {
			$idCurrentImg = $img->getId();
			if ($idCurrentImg+$nb >= $this->size()) {
			    $newImg = $this->getImage(1);
			}
			else if ($idCurrentImg+$nb < 1) {
			    $newImg = $this->getImage($this->size()+$nb);
			}
			else {
			    $newImg = $this->getImage($idCurrentImg+$nb);
			}
			return $newImg;
		}
		
		# Retourne la liste des images consécutives à partir d'une image
		function getImageList(image $img,$nb) {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			while ($id < $this->size() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}
		
		function getAllCategory(){
		    $s = $this->db->query('SELECT Distinct(category) FROM image');
		    if ($s) {
		        $data = $s->fetchAll(PDO::FETCH_NUM);
		        //var_dump($data);
		        return $data;
		    }else{
		        print "Error in getAllCatergory<br/>";
		        $err= $this->db->errorInfo();
		        print $err[2]."<br/>";
		    }
		}
	}
	
	# Test unitaire
	# Appeler le code PHP depuis le navigateur avec la variable test
	# Exemple : http://localhost/image/model/imageDAO.php?test
	if (isset($_GET["test"])) {
		echo "<H1>Test de la classe ImageDAO</H1>";
		$imgDAO = new ImageDAO();
		echo "<p>Creation de l'objet ImageDAO.</p>\n";
		echo "<p>La base contient ".$imgDAO->size()." images.</p>\n";
		$img = $imgDAO->getFirstImage("");
		echo "La premiere image est : ".$img->getURL()."</p>\n";
		# Affiche l'image
		echo "<img src=\"".$img->getURL()."\"/>\n";
	}
	
	
	?>