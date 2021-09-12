<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__ . './../src/Controller/PostController.php');
require_once(__DIR__ . './nav.html');

if (!isset($_SESSION['login'])) {
    header("location:index.php");
}


if (
    isset($_POST['name'])
) {

    list (
        'name' => $name,
    ) = $_POST;

    $postController = new PostController;

    if ($postController->newCategory($name)) {
        header("location:forum.php");
    } else echo "erreur lors de la création du catégorie";

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
            <h1 style="text-align: center"> Ajout d'une catégorie </h1>
            <input type="text" placeholder="Gestion de projet" name="name"/>
            <button>Valider</button>
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
