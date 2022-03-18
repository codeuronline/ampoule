<?php

class Ampoule {
    // use Database;
    
    private $classname="ampoule";
    private const PAGINATION="pagination";
    private const WITHOUT="*";
    private $id;
    private $date;
    private $etage;
    private $position;
    private $prix;
        
    public function manage($data){
        global $db;
        require_once 'connexion.php';
        //$database= new Database;
        //$db= $database->getPDO();
        extract($data);
        if (isset($_POST['id'])){
            $sql = "UPDATE $this->classname SET  date=?, etage=?, position=?, prix=? WHERE id=?";
                $db->prepare($sql)->execute([$date, $etage, $position, $prix, @$_POST['id']]);
        } else {
            $sql = "INSERT INTO $this->classname(id,date,etage,position,prix) VALUES (NULL,?,?,?,?)";
            $db->prepare($sql)->execute([$date, $etage, $position, $prix]);    
        }
        
        }
    
    
      
    public function del($id){
        global $db;
        require_once 'connexion.php';
        $sql = "DELETE FROM $this->classname WHERE id=?";  
        $db->prepare($sql)->execute([$id]);
    }

    public function select($id = "*", $nbdepage = "", $first = "",$col="*")
    {
        
       // error_log("id=".$id." limit=".$limit." first=".$first." col=".$col);
        global $db;
        require_once 'connexion.php';
         if (!(empty($first))) {
            $sql = "SELECT * FROM $this->classname limit $first OFFSET $nbdepage"; 
            return $db->query($sql)->fetchAll();
         }else{
            if (!($col == "*")) {
            $sql = "SELECT $col FROM $this->classname WHERE id=$id";
            return $db->query($sql)->fetch();
        } else {
            if ($id == "*"){
                $sql = "SELECT * FROM $this->classname";
                return $db->query($sql)->fetchAll();
            }else{
                $sql = "SELECT * FROM $this->classname WHERE id=$id";
                return $db->query($sql)->fetchAll();
            }
        }
    }
    }

    public function __contruct(array $data)
    {
        $this->hydrate($data);
        $this->manage($data);
        
    } 
    
    public function hydrate(array $data)
    {
    foreach ($data as $key => $value){
        $method = 'set'.ucfirst($key);
        if (method_exists($this,$method)){
            $this->$method($value);
        }
    }
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of url_github
     */ 
    public function getUrl_github()
    {
        return $this->url_github;
    }

    /**
     * Set the value of url_github
     *
     * @return  self
     */ 
    public function setUrl_github($url_github)
    {
        $this->url_github = $url_github;

        return $this;
    }

    /**
     * Get the value of url_web
     */ 
    public function getUrl_web()
    {
        return $this->url_web;
    }

    /**
     * Set the value of url_web
     *
     * @return  self
     */ 
    public function setUrl_web($url_web)
    {
        $this->url_web = $url_web;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}
?>