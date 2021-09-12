<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__ . './../src/Controller/PostController.php');
require_once(__DIR__ . './nav.html');

list ('id' => $id) = $_GET;

if (!isset($_SESSION['login']) or !isset($id)) {
    header("location:index.php");
}

$data = (new PostController)->show($id);

if (empty($data)) header("location:index.php");
if (isset($_POST['name'])) {

    list ('name' => $name) = $_POST;

    if ((new PostController)->editCategory($name, $id)) {
        header("location:forum.php");
    } else {
        echo "erreur lors de la création du catégorie";
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
            <h1 style="text-align: center"> modifier un article </h1>


            <input type="text" placeholder="title" name="title" value="<?php echo $data['post'][0]['title']; ?>"/>
            <textarea placeholder="content" name="content" rows="10"
                      cols="80"><?php echo $data['post'][0]['content']; ?>> </textarea>
            <select name="categories">
                <option disabled> Veuillez choisir une catégorie</option>
                <option <?php $data['post'][0]['categories'] == "PHP" ? "selected" : null; ?> > PHP</option>
                <option <?php $data['post'][0]['categories'] == "HTML" ? "selected" : null; ?>> HTML</option>
                <option <?php $data['post'][0]['categories'] == "CSS" ? "selected" : null; ?>> CSS</option>
                <option <?php $data['post'][0]['categories'] == "C#" ? "selected" : null; ?>> C#</option>
            </select>
            <button>modifier un Article</button>
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
