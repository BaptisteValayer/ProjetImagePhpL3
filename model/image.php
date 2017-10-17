<?php

  # Notion d'image
  class Image {
    private $url=""; 
    private $id=0;
    
    const urlPath="http://localhost/L3_Pro/Prog_PHP/Workspace/ProjetImagePhpL3/model/IMG/";
    
    function __construct($u = null ,$id = null) {
      if($u !=null){
        $this->url = $u;
        $this->id = $id;
      }
    }
    
    # Retourne l'URL de cette image
    function getURL() {
        $pathUrl = self::urlPath;
        $pathUrl .= $this->path;
		return $pathUrl;
    }
    
    function getId() {
      return $this->id;
    }
  }
  
  
?>