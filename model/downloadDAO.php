<?php
   class DownloadDAO{
    
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
    
    function insert($nom,$categ) {
        $nbrow = $this->db->query("select MAX(id)+1 AS id from image;");
        $res = $nbrow->fetch(PDO::FETCH_ASSOC);
        if($res) {
            $requete = $this->db->exec("INSERT INTO image(id,path,category) VALUES(".$res['id'].",'jons/external/".$nom."','".$categ."');");
        }
    }
}