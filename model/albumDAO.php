<?php

    class AlbumDAO{
        
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
    }
?>