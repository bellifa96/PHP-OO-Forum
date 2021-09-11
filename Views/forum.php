
<?php
include_once('./../src/Bdd/dbFunction.php');

$funObj = new dbFunction();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>forum </title>
    <link rel="stylesheet" type="text/css" href="./table.css"/>
    <link rel="stylesheet" type="text/css" href="./nav.css"/>

</head>
<style>
    body{
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
<h2> Bienvenue <?php  echo $_SESSION['firstname'].' '.$_SESSION['lastname']   ?> </h2>

<a href="article.php"> <h2> Créer un article </h2></a>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Sujet</th>
            <th>Catégories</th>
            <th>Auteur</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>show edit delete</td>

        </tr>
        <tbody>
    </table>
</div>

</body>
</html>


