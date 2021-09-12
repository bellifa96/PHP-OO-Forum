<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('./../src/Controller/PostController.php');
include_once('./nav.html');

if(!isset($_SESSION['login']) or !isset($_GET['id']) ){
    header("location:index.php");
}

$article = new PostController();
$data = $article->show($_GET['id']);


if(empty($data)){
    header("location:index.php");
}
if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['categories']) ) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $categories = $_POST['categories'];
    $postController = new PostController();
    if($postController->edit($title,$content,$categories,$_GET['id'])){
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
            <h1 style="text-align: center"> modifier un article  </h1>


            <input type="text" placeholder="title" name="title" value="<?php echo $data['post'][0]['title']; ?>"/>
            <textarea  placeholder="content" name="content"  rows="10" cols="80"><?php echo $data['post'][0]['content']; ?>> </textarea>
            <select name="categories" >
                <option disabled> Veuillez choisir une catégorie</option>
                <option <?php  $data['post'][0]['categories']== "PHP" ? "selected":null; ?> > PHP </option>
                <option <?php  $data['post'][0]['categories']== "HTML" ? "selected":null; ?>> HTML </option>
                <option <?php  $data['post'][0]['categories']== "CSS" ? "selected":null; ?>> CSS </option>
                <option <?php  $data['post'][0]['categories']== "C#" ? "selected":null; ?>> C# </option>
            </select>
            <button>modifier un Article</button>
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
