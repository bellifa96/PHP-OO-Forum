<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('./../src/Controller/PostController.php');
include_once('./nav.html');

if(!isset($_SESSION['login'])){
    header("location:index.php");
}


if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['categories']) ) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $categories = $_POST['categories'];
    $postController = new PostController();
    if($postController->newPost($title,$content,$categories)){
        header("location:forum.php");
    }else{
        echo "erreur lors de la création";
    } ;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>

<h2> Bienvenue <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?> </h2>


<div class="container" id="container">
    <div class="form-container ">
        <form action="" method="post">
            <h1 style="text-align: center"> Créer un nouvel article  </h1>
            <input type="text" placeholder="title" name="title" value="article 1"/>
            <textarea  placeholder="content" name="content"  rows="10" cols="80"></textarea>
            <select name="categories" >
                <option disabled> Veuillez choisir une catégorie</option>
                <option> PHP </option>
                <option> HTML </option>
                <option> CSS </option>
                <option> C# </option>
            </select>
            <button>Créer un Article</button>
        </form>
    </div>

</div>

</body>
<style>
    #container{
        width: 100%;
        justify-content: center;
    }
    .form-container{
        width: fit-content;
        margin-right: auto;
        margin-left:auto;
    }
    textarea, select, input, button{
        margin: 5px;
        display: block;
    }

</style>
</html>
