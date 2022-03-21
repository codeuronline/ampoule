<?php 
class User { 
    // use Database; private $classname="ampoule" ; private const PAGINATION="pagination" ; private const WITHOUT="*" ; 
    public const NULL_VALUE = null;
    private $classname ="user";
    private $email;
    private $username; 
    private $password; 
    private $icone; 
    
    
    public function manage($data){ 
        global $db; 
        require_once 'connexion.php' ; //$database=new Database; //$db=$database->getPDO();
        extract($data);
       
        if (isset($email)&& isset($password)&&(isset($username))) {
            // verifier que les 2 mails en comparaisons existe deja
            if (count($this->select("*",$email))>0){
                var_dump($data);
                
                $sql = "UPDATE $this->classname SET username=?, password=? WHERE email=?";
                $db->prepare($sql)->execute([$username, $email, $password]);
            } else {echo
                "erreur d'aiguillage";}
            
        } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email= strtolower($email);
        $sql = "INSERT INTO $this->classname(id,username,email,password) VALUES (NULL,?,?,?)";
        $db->prepare($sql)->execute([$username,$email,$password]);
        }
    }

    public function del($id){
        global $db;
        require_once 'connexion.php';
        $sql = "DELETE FROM $this->classname WHERE id=?";
        $db->prepare($sql)->execute([$id]);
    }

    public function select($id =null, $slug = null){

    // error_log("id=".$id." slug=".$slug);
        global $db;
        require_once 'connexion.php';
        $email=$slug;
        if (isset($slug)) {
            $sql = "SELECT username, email, password FROM $this->classname WHERE email ='$email'"; 
            //$db->prepare($sql)->execute([$email]);
            return $db->query($sql)->fetch();
        } else {
            if ($id == null){
                    $sql = "SELECT * FROM $this->classname";
                    return $db->query($sql)->fetchAll();
                }else{
                    $sql = "SELECT * FROM $this->classname WHERE id=$id";
                     return $db->query($sql)->fetchAll();
                }
            }
        }
    

    public function __contruct(array $data)
    {
    $this->hydrate($data);
    $this->manage($data);

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
    ?>