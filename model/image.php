<?php
  
  # Notion d'image
  class Image {
    private $url=""; 
    private $id=0;
    
    function __construct($u = null ,$id = null) {
      if($u !=null){
        $this->url = $u;
        $this->id = $id;
      }
    }
    
    # Retourne l'URL de cette image
    function getURL() {
		return $this->url;
    }
    
    function getId() {
      var_dump($this);
      return $this->id;
    }
  }
  
  
?>