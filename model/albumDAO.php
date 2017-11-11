<?php
    require_once("album.php");
    
    class AlbumDAO{
        
        function __construct() {
            $dsn = 'sqlite:BD/BD.db'; // Data source name
            $user= ''; // Utilisateur
            $pass= ''; // Mot de passe
            try {
                $this->db = new PDO($dsn, $user, $pass); //$db est un attribut prive d'AlbumDAO
            } catch (PDOException $e) {
                die ("Erreur : ".$e->getMessage());
            }
        }
        
        // Récupération d'un album gràce a son id
        function getAlbum($id){
            $requete = "select * from album where id=$id";
            $s= $this->db->query($requete);
            if($s){
                $data = $s->fetchAll(PDO::FETCH_CLASS, 'Album');
                return $data[0];
            }else{
                print "Error in getAlbum <br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
            
        }
        
        // Création d'un nouvel album avec son nom en paramètre
        function createAlbum($nom){
            $requete = $this->db->prepare('insert into album (nom) values(:nom)');
            if($requete){
                $requete->execute(array(
                   'nom' => $nom 
                ));
            }else{
                print "Error in updateCreerAlbum<br/>";
		        $err= $this->db->errorInfo();
		        print $err[2]."<br/>";
            }
        
        }
        
        // Requête récupérant la liste des albums
        function listAlbum(){
            $requete = 'select * from album';
            $s = $this->db->query($requete);
            if($s){
                $data = $s->fetchAll(PDO::FETCH_CLASS, 'Album');
                return $data;
            }else{
                print "Error in updateCreerAlbum<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
        }
        
        // Reqûete permettant de supprimer un album grâce à son id
        // On met à jour également les images contenus dans cet album, l'album de l'image devient null
        function deleteAlbum($id){
            $requeteDeleteAlbum = $this->db->prepare('delete from album where id=:id');
            if($requeteDeleteAlbum){
                $requeteDeleteAlbum->execute(array(
                    'id' => $id
                ));
            }else{
                print "Error in deleteAlbum - requeteDeleteAlbum<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
            $requeteUpdatePhoto = $this->db->prepare('update image set album=null where album=:id');
            if($requeteUpdatePhoto){
                $requeteUpdatePhoto->execute(array(
                    'id' => $id
                ));
            }else{
                print "Error in updateCreerAlbum - requeteUpdatePhoto<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
                }
        }
    }
?>