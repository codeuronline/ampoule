<?php 
class User { 
    // use Database; private $classname="ampoule" ; private const PAGINATION="pagination" ; private const WITHOUT="*" ; 
    private $classname ="user";
    private $username; 
    private $password; 
    private $icone; 
    
    
    public function manage($data){ 
        global $db; 
        require_once 'connexion.php' ; //$database=new Database; //$db=$database->getPDO();
        extract($data);
        if (isset($_POST['id'])){
        $sql = "UPDATE $this->classname SET username=?, password=?, icone=? WHERE id=?";
        $db->prepare($sql)->execute([$username, $password,$icone, @$_POST['id']]);
    } else {
        $sql = "INSERT INTO $this->classname(id,username,password,icone) VALUES (NULL,?,?,?)";
        $db->prepare($sql)->execute([$username, $password, $icone]);
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