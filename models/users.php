<?php 
class User  { 
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
    }

    public function add($data)
    {
        global $db;
        require_once 'connexion.php';
        extract($data);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = strtolower($email);
        $sql = "INSERT INTO $this->classname(id,username,email,password) VALUES (NULL,?,?,?)";
        $db->prepare($sql)->execute([$username, $email, $password]);
        }

    public function up($id, $data)
    {
        global $db;
        require_once 'connexion.php'; 
        extract($data);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->classname SET username=?, password=? WHERE id=$id";
        $db->prepare($sql)->execute([$username, $password]);
        
    }

    public function del($id){
        global $db;
        require_once 'connexion.php';
        $sql = "DELETE FROM $this->classname WHERE id=?";
        $db->prepare($sql)->execute([$id]);
    }

    public function isIn($slug)
    {
        global $db;
        require 'connexion.php';
        $sql = "SELECT email FROM $this->classname WHERE email='$slug'";
        $check = $db->query($sql);
       return ($check->rowCount() > 0) ? true : false;
    }
    
    public function select($id=null,$slug=null){
        global $db;
        require_once 'connexion.php';
    
        $email=$slug;
        if (isset($slug)) {
            $sql = "SELECT id,password,username FROM $this->classname WHERE email ='$email'";
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