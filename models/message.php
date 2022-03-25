<?php 
class Message { 


    private $className="message";
    private $id;
    private $message; 
    private $author_id; 
    private $date;
    
    
    /* a revoir pour la gestion switcher automatqiue
    public function manage($data){ 
        global $db; 
        require_once 'connexion.php' ; //$database=new Database; //$db=$database->getPDO();
        extract($data);
        // verifier que les 2 mails en comparaisons existe deja
        var_dump($this->isIn(strtolower($_POST['email'])));
        if (isset($email) && (($this->isIn(strtolower($email))) > 0)) {
            echo "Email trouvé <br>";
                var_dump($data);
            $oldUser = $this->select("*", $email);
            $oldPassword = $oldUser['password'];
            if ((@$update) && (password_verify($password, $oldPassword))) {
                echo "Email trouvé -> redefinition du mot de pass";
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE $this->classname SET username=?, password=? WHERE email=?";
                $db->prepare($sql)->execute([$username, $email, $password]);
            } else {
                echo "mot de pass invalide";
            }
        } else {
            echo "insert->email non trouvé";
            $password = password_hash($password, PASSWORD_DEFAULT);
            $email = strtolower($email);
            $sql = "INSERT INTO $this->classname(id,username,email,password) VALUES (NULL,?,?,?)";
            $db->prepare($sql)->execute([$username, $email, $password]);
        }
    }*/

    public function manage($data)
    {
        //insertion seulement
        global $db;
        require_once 'connexion.php';
        extract($data);
        error_log(print_r(($_SESSION),1));
        error_log(print_r(($data),1));
        $date =date("Y-m-d");
        var_dump($data);
        
        $sql="INSERT INTO $this->className (id,message,,date) VALUES (null,?,(SELECT id FROM user WHERE id = ?),?)";
        $db->prepare($sql)->execute([$message, $author_id, $date]);
    }

    public function up($id, $data)
    {
        global $db;
        require_once 'connexion.php'; 
        extract($data);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->className SET message=?, id_user=? WHERE id=$id";
        $db->prepare($sql)->execute([$message, $author_id]);
        
    }

    public function del($id){
        global $db;
        require_once 'connexion.php';
        $sql = "DELETE FROM $this->className WHERE id=?";
        $db->prepare($sql)->execute([$id]);
    }

    public function isIn($id)
    {
        global $db;
        require 'connexion.php';
        $sql = "SELECT * FROM $this->classname WHERE id_user=$id";
   
        error_log($sql);
        error_log(print_r($check, 1));
        error_log($check->rowCount());
        return (count($db->query($sql)->fetchAll()) > 0) ? true : false;
       }
    
    public function numberMessage($element){
        global $db;
        require_once 'connexion.php';
        $sql="SELECT * FROM $this->className WHERE message IS NOT NULL AND id_user=$element";
        $result = $db->query($sql)->fetchAll();
        return (count($result)> 0) ? count($result):0;
    }

    public function select($id=null,$slug=null){
        global $db;
        require_once 'connexion.php';
        $email=$slug;
        //comment selectionner
        if (isset($slug)) {
            $sql = "SELECT id,password,username FROM $this->classname WHERE id_user ='$email'";
            return $db->query($sql)->fetch();
        } else {
            if ($id == null){
                    $sql = "SELECT * FROM $this->className";
                    return $db->query($sql)->fetchAll();
                }else{
                    $sql = "SELECT * FROM $this->className WHERE id=$id";
                     return $db->query($sql)->fetchAll();
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