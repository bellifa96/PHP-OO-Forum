<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__ . './../src/Controller/PostController.php');

list ('id' => $id) = $_GET;

if (isset($id) ) {
    if((new PostController)->deleteCategory($id)) header("location:index.php");
    else echo "erreur lors de la suppression du catégorie";

}
