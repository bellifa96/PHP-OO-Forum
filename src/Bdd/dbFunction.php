<?php
session_start();

class dbFunction
{

    private $pdo;

    function __construct()
    {
        require_once('Config.php');
        try{
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
        // connecting to database
     //   $this->pdo = new dbConnect();;

    }


    public function UserRegister($firstname,$lastname, $email, $password)
    {
        $password = md5($password);
        $sql = "INSERT INTO user (firstname,lastname, email, password) VALUES ( :firstname,:lastname,:email,:password)";

        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return 'votre compte a été crée avec success';
            } else {
                return 'erreur lors de la création de votre compte';
            }
        }

    }

    public function Login($email, $password)
    {
        $password = md5($password);
        $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            if ($stmt->execute()) {
                if($stmt->rowCount() == 1){
                    $stmt = $stmt->fetch();
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $stmt['id'];
                    $_SESSION['firstname'] = $stmt['firstname'];
                    $_SESSION['lastname'] = $stmt['lastname'];
                    $_SESSION['email'] = $stmt['email'];
                    return TRUE;
                } else {
                    return FALSE;
                }

            } else {
                return 'erreur lors de la connexion à compte';
            }
        }



    }

    public
    function isUserExist($email)
    {
        $sql ="SELECT * FROM user WHERE email = :email";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":password", $email, PDO::PARAM_STR);
            if($stmt->rowCount() == 1){
                return $email;
            } else{
                return false;
            }
        }
    }

    public function newArticle(){

    }
}

