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
    isset($_POST['title'])
    && isset($_POST['content'])
    && isset($_POST['category_id'])
) {

    list (
        'title' => $title,
        'content' => $content,
        'category_id' => $category_id,
        ) = $_POST;

    $postController = new PostController;

    if ($postController->newPost($title, $content, $category_id)) {
        header("location:forum.php");
    } else echo "erreur lors de la création";

}

$categories = Category::all();
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
            <h1 style="text-align: center"> Créer un nouvel article </h1>
            <input type="text" placeholder="title" name="title" value="article 1"/>
            <textarea placeholder="content" name="content" rows="10" cols="80"></textarea>
            <select name="category_id">
                <option selected disabled> Veuillez choisir une catégorie</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->ID ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
            <button>Créer un Article</button>
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
