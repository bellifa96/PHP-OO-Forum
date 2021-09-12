<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('./../src/Controller/PostController.php');
if (!isset($_SESSION['login'])) {
}

if ($_GET['id']) {
    $post = new PostController();
    $data = $post->show($_GET['id']);
} else {
    header("location:forum.php");
}

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


<div class="table-wrapper">
    <h1> Article </h1>

    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Sujet</th>
            <th>Catégories</th>
            <th>Crée le</th>
            <th>Modifié le</th>

            <th>Auteur</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['post'] as $val) {
            echo "
                      <tr>
                        <td>" . $val['ID'] . "</td>
                        <td>" . $val['title'] . "</td>
                        <td>" . $val['content'] . "</td>
                        <td>" . $val['categories'] . "</td>
                        <td>" . $val['createdAt'] . "</td>
                        <td>" . $val['updatedAt'] . "</td>
                        <td>" . $val['userId'] . "</td>";

            if ($val['userId'] == $_SESSION['id']) {
                echo "<td>
                                         <a href='deleteArticle.php?id=" . $val['ID'] . "'> supprimer </a> 
                                         <a href='updateArticle.php?id=" . $val['ID'] . "'> modifier </a>
                                    </td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";

        }

        ?>

        <tbody>
    </table>
</div>

<div class="table-wrapper">

    <a href="comment.php?id=<?php echo $_GET['id']; ?>"><h2> Créer un commentaire </h2></a>

    <h1> Commentaires </h1>
    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>commentaire</th>
            <th>Crée le</th>
            <th>Modifié le</th>
            <th>Auteur</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['comments'] as $val) {
            echo "
                      <tr>
                        <td>" . $val['ID'] . "</td>
                        <td>" . $val['content'] . "</td>
                        <td>" . $val['createdAt'] . "</td>
                        <td>" . $val['updatedAt'] . "</td>
                        <td>" . $val['userId'] . "</td>";

            if ($val['userId'] == $_SESSION['id']) {
                echo "<td>
                                 <a href='deleteComment.php?id=" . $val['ID'] . "'>Supprimer</a> 
                                 <a href='updateComment.php?id=" . $val['ID'] . "'> modifier </a>
                                 
                        </td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";


        }

        ?>

        <tbody>
    </table>
</div>

</body>
</html>


