<?php 
class Message extends Database{ 

   
    private $className="message";
    
    
    /*private $id;
    private $message; 
    private $author_id; 
    private $date;*/
    
    public function manage($data){
    
        $db= new Message;
        $connection =$db->getPDO();
        
        extract($data);
                
        /**Test si l'utilisateur est enrgistré */
        if (!(isset($author_id))) {
            $author_id=$_SESSION['user_id'];
        }
        /**Test si un id a ete transmis */
        if (!(isset($id))){
            // l'id n'existe pas -> creation
            $sql="INSERT INTO $this->className (id,message,date_msg) VALUES (null,?,(SELECT id FROM user WHERE id = ?),?)";
            $connection->prepare($sql)->execute([$message, $author_id, $date_msg]);
        } else {
            // l'id existe -> update du message
            $sql="UPDATE $this->className SET date=?,message=?, id_user=? where= id=?";
            $connection->prepare($sql)->execute([$date_msg,$message,$auth_id,$id]);
        }            

    }
    /**Fonction deprecier au profit de manage */
    public function up($id, $data)
    {
        $db= new Message;
        $connection =$db->getPDO();
        extract($data);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->className SET message=?, id_user=? WHERE id=$id";
        $connection->prepare($sql)->execute([$message, $author_id]);
        
    }
    /**Suppression d'un message dans la table */
    public function del($id){
        $db= new Message;
        $connection =$db->getPDO();    
        $sql = "DELETE FROM $this->className WHERE id=?";
        $connection->prepare($sql)->execute([$id]);
    }
    /**Recherche d'un slug dans un message et 
     * retourne un liste de message/date/username
     */
    public function search($slug) {
        $db= new Message;
        $connection =$db->getPDO();
        
        /**
         * 
         * Requete a executer si l'index de la colonne message 
         * pour la table  MESSAGE n'a pas d'index en FULLTEXT 
         *
         * $sql="ALTER TABLE message FULLTEXT(message)";
        */
        $sql="SELECT date_msg,message,username FROM $this->className INNER JOIN ampoule ON message.id_user= ampoule.id_user inner join user ON message.id_user = user.id WHERE MATCH(message) AGAINST (:slug);";
        $request=$connection->prepare($sql);
        $request->bindParam(':slug',$slug, PDO::PARAM_STR);
        $request->execute();
        $result= $request->fetchAll();
        //on supprime les doublons 
         return array_map('unserialize', array_unique(array_map('serialize', $result)));
         
        
    }
    /*Test si l'objet dana table
    * 
    * */
    public function isIn($id)
    {
        $db= new Message;
        $connection =$db->getPDO();
        $sql = "SELECT * FROM $this->classname WHERE id_user=$id";
        return (count($connection->query($sql)->fetchAll()) > 0) ? true : false;
       }
    /** 
     * Test si le message est vide
     * */   
    public function info($id_message){
        $db= new Message;
        $connection =$db->getPDO();
        $sql="SELECT message FROM $this->className WHERE message IS NOT NULL AND id=$id_message";
        $result= $connection->query($sql)->fetchAll();
        return (count($result)> 0) ? 1:0;
    }   
    /* 
     *Renvoie le nombre de message
    */
    public function numberMessage($element){
        $db= new Ampoule;
        $connection =$db->getPDO();
        $sql="SELECT * FROM $this->className WHERE message IS NOT NULL AND id_user=$element";
        $result = $connection->query($sql)->fetchAll();
        return (count($result)> 0) ? count($result):0;
    }

    /*
     * Renvoie les messages selon la pagination 
    */
    public function  selectM($first,$nbdepage){
        $db= new Message;
        $connection =$db->getPDO();
        $sql = "SELECT * FROM $this->classname limit $first OFFSET $nbdepage"; 

        return $connection->query($sql)->fetchAll();
    }
    
    /** 
     * Renvoie la selection
    */
    public function select($id=null,$slug=null){
        $db= new Message;
        $connection =$db->getPDO();
        $email=$slug;
        //comment selectionner
        if (isset($slug)) {
            $sql = "SELECT id,password,username FROM $this->classname WHERE id_user ='$email'";
            return $connection->query($sql)->fetch();
        } else {
            if ($id == null){
                    $sql = "SELECT * FROM $this->className";
                    return $connection->query($sql)->fetchAll();
                }else{
                    $sql = "SELECT * FROM $this->className WHERE id=$id";
                     return $connection->query($sql)->fetchAll();
                }
            }
        }
    
    public function __contruct(array $data)
    {
    $this->hydrate($data);
    //$this->manage($data);

    }
    
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }
}