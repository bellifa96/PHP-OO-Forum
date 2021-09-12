<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('./../src/Controller/PostController.php');
if(!isset($_SESSION['login'])){
    header("location:index.php");
}
$posts = new PostController();
$data = $posts->index();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>forum </title>
    <link rel="stylesheet" type="text/css" href="../Style/table.css"/>
    <link rel="stylesheet" type="text/css" href="../Style/nav.css"/>

</head>
<style>
    body {
        margin: 0;
    }
</style>
<body>
<nav>

    <ul>
        <li><a href="forum.php">Accueil</a></li>
        <li><a href="user.php">mon profil</a></li>
        <li><a href="userArticle.php">mes articles</a></li>
        <li style="float:right"><a class="active" href="logout.php">Se déconnecter</a></li>
    </ul>
</nav>
<h2> Bienvenue <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?> </h2>

<a href="article.php"><h2> Créer un article </h2></a>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Sujet</th>
            <th>Catégories</th>
            <th>Crée le </th>
            <th>Modifié le</th>

            <th>Auteur</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $val) {
            echo "
                      <tr>
                        <td>".$val['ID']."</td>
                        <td>".$val['title']."</td>
                        <td>".$val['content']."</td>
                        <td>".$val['categories']."</td>
                        <td>".$val['createdAt']."</td>
                        <td>".$val['updatedAt']."</td>
                        <td>".$val['userId']."</td>
                        <td> <a href='showArticle.php?id=".$val['ID']."'> regarder </a> </td>
                       </tr>
                     
                     ";

        }

        ?>

        <tbody>
    </table>
</div>

</body>
</html>


