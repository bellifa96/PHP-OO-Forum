<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('./../src/Controller/CommentController.php');
include_once('./nav.html');

if (!isset($_SESSION['login']) || !isset($_GET['id'])) {
    header("location:index.php");
}


if (isset($_POST['content'])) {

    $id = $_GET['id'];

    $content = $_POST['content'];
    $commentController = new CommentController();
    if ($commentController->newComment($content, $id)) {
        header("location:forum.php");
    } else {
        echo "erreur lors de la création";
    };

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
            <h1 style="text-align: center"> Créer un nouveau commentaire </h1>
            <textarea placeholder="content" name="content" rows="10" cols="80"></textarea>
            <button>Créer un commentaire</button>
        </form>
    </div>

</div>

</body>
<style>
    #container {
        width: 100%;
        justify-content: center;
    }

    .form-container {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }

    textarea, select, input, button {
        margin: 5px;
        display: block;
    }

</style>
</html>
