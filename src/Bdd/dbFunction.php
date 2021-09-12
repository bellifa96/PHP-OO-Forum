<?php
session_start();

class dbFunction
{

    private $pdo;

    function __construct()
    {
        require_once('Config.php');
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTablePosts();
            $this->createTableComment();
            $this->createTableUser();


        } catch (PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }


    }

    public function createTableUser()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `user` (
                `ID` int(11) unsigned NOT NULL auto_increment,
                `firstname` varchar(255) NOT NULL default '',
                `lastname` varchar(255) NOT NULL default '',
                `email` varchar(255) NOT NULL default '',
                `password` varchar(255) NOT NULL default '',
                PRIMARY KEY  (`ID`)
        )";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function UserRegister($firstname, $lastname, $email, $password)
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
                if ($stmt->rowCount() == 1) {
                    $stmt = $stmt->fetch();
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $stmt['ID'];
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
        $sql = "SELECT * FROM user WHERE email = :email";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":password", $email, PDO::PARAM_STR);
            if ($stmt->rowCount() == 1) {
                return $email;
            } else {
                return false;
            }
        }
    }


    public function createTablePosts()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `posts` (
                `ID` int(11) unsigned NOT NULL auto_increment,
                `title` varchar(255) NOT NULL default '',
                `content` varchar(255) NOT NULL default '',
                `categories` varchar(255) NOT NULL default '',
                `createdAt` varchar(255) NOT NULL default '',
                `updatedAt` varchar(255) NOT NULL default '',
                `userId` int(11) unsigned NOT NULL ,
                PRIMARY KEY  (`ID`)
        )";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function createTableComment()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `comments` (
                `ID` int(11) unsigned NOT NULL auto_increment,
                `content` varchar(255) NOT NULL default '',
                `createdAt` varchar(255) NOT NULL default '',
                `updatedAt` varchar(255) NOT NULL default '',
                `userId` int(11) unsigned NOT NULL ,
                `postId` int(11) unsigned NOT NULL ,
                PRIMARY KEY  (`ID`)
        )";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function newPost($parameters)
    {
        $sql = "INSERT INTO posts (title,content, categories,createdAt,updatedAt, userID) VALUES ( :title,:content,:categories, :createdAt, :updatedAt,:userId)";

        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":title", $parameters['title'], PDO::PARAM_STR);
            $stmt->bindParam(":content", $parameters['content'], PDO::PARAM_STR);
            $stmt->bindParam(":categories", $parameters['categories'], PDO::PARAM_STR);
            $stmt->bindParam(":createdAt", $parameters['createdAt'], PDO::PARAM_STR);
            $stmt->bindParam(":updatedAt", $parameters['updatedAt'], PDO::PARAM_STR);
            $stmt->bindParam(":userId", $parameters['userId'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getPosts()
    {

        $sql = "SELECT * FROM posts";
        if ($stmt = $this->pdo->prepare($sql)) {
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            } else {
                return 'erreur lors de la récuperation ';
            }


        }
    }
    public function getUserPosts()
    {

        $sql = "SELECT * FROM posts WHERE userId = :id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            } else {
                return 'erreur lors de la récuperation ';
            }


        }
    }

    public function getPost($id)
    {

        $sql = "SELECT * FROM posts where ID = :id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            } else {
                return false;
            }


        }
    }

    public function updatePost($parameters)
    {

        $sql = "UPDATE posts
SET title = :title, content = :content, categories = :categories , updatedAt = :updatedAt
WHERE ID = :id";

        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":title", $parameters['title'], PDO::PARAM_STR);
            $stmt->bindParam(":content", $parameters['content'], PDO::PARAM_STR);
            $stmt->bindParam(":categories", $parameters['categories'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $parameters['id'], PDO::PARAM_STR);
            $stmt->bindParam(":updatedAt", $parameters['updatedAt'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM posts
           WHERE ID = :id AND userId = :userId";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->bindParam(":userId", $_SESSION['id'], PDO::PARAM_STR);
            if ($stmt->execute()) {

                $sql = "DELETE FROM `comments`
                  WHERE postId = :id";
                if ($stmt = $this->pdo->prepare($sql)) {
                    $stmt->bindParam(":id", $id, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        return true;
                    }
                } else {
                    return false;
                }
                return true;

            } else {
                return false;
            }
        }
    }



    public function getComments($id)
    {

        $sql = "SELECT * FROM comments where postId = :postId";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":postId", $id, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            } else {
                return 'erreur lors de la récuperation ';
            }


        }
    }

    public function getComment($id)
    {
        $this->createTablePosts();

        $sql = "SELECT * FROM comments where ID = :id";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            } else {
                return false;
            }


        }
    }

    public function newComment($parameters)
    {

        $sql = "INSERT INTO comments (content,createdAt,updatedAt, userID, postId) VALUES ( :content, :createdAt, :updatedAt,:userId,:postId)";

        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":content", $parameters['content'], PDO::PARAM_STR);
            $stmt->bindParam(":createdAt", $parameters['createdAt'], PDO::PARAM_STR);
            $stmt->bindParam(":updatedAt", $parameters['updatedAt'], PDO::PARAM_STR);
            $stmt->bindParam(":userId", $parameters['userId'], PDO::PARAM_STR);
            $stmt->bindParam(":postId", $parameters['postId'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function updateComment($parameters)
    {

        $sql = "UPDATE comments
SET  content = :content, updatedAt = :updatedAt
WHERE ID = :id";

        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":content", $parameters['content'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $parameters['id'], PDO::PARAM_STR);
            $stmt->bindParam(":updatedAt", $parameters['updatedAt'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteComment($id)
    {
        $sql = "DELETE FROM comments
           WHERE ID = :id and userId = :userId";
        if ($stmt = $this->pdo->prepare($sql)) {
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->bindParam(":userId", $_SESSION['id'], PDO::PARAM_STR);

            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }


}

