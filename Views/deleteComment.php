<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('./../src/Controller/CommentController.php');




if (isset($_GET['id']) ) {

    $id = $_GET['id'];

    $commentController = new CommentController();
    if($commentController->delete($id)){
        header("location:index.php");
    }else{
        echo "erreur lors de la suppression";
    }

}
