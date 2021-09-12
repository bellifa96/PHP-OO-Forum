<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once(__DIR__ . './../src/Bdd/dbFunction.php');

if (isset($_SESSION['login'])) {
    header("location:./forum.php");
}

$funObj = new dbFunction();
if (isset($_POST['login'])) {

    $email = $_POST['lEmail'];
    $password = $_POST['lPassword'];
    $user = $funObj->Login($email, $password);
    if ($user) {
        header("location:forum.php");
    } else {
        echo " veuillez vérifier votre mot de passe ou email";
    }
}
if (isset($_POST['register'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password == $confirmPassword) {
        $emailExist = $funObj->isUserExist($email);
        if (!$emailExist) {
            $register = $funObj->UserRegister($firstname, $lastname, $email, $password);
            if ($register) {
                echo "<script>alert('Registration Successful')</script>";
            } else {
                echo "<script>alert('Registration Not Successful')</script>";
            }
        } else {
            echo "<script>alert('Email Already Exist')</script>";
        }
    } else {
        echo "<script>alert('Password Not Match')</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../Style/login.css"/>
</head>
<body>
<h2> Se connecter </h2>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="" method="post">
            <h1>Créer un compte </h1>
            <input hidden name="register">
            <input type="text" placeholder="firstname" name="firstname" value="firstname"/>
            <input type="text" placeholder="lastname" name="lastname" value="firstname"/>
            <input type="email" placeholder="Email" name="email" value="cc@live.fr"/>
            <input type="password" placeholder="Password" name="password" value="1234"/>
            <input type="password" placeholder="confirmez le password" name="confirmPassword" value="1234"/>
            <button>Créer un compte</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form name="login" method="post" action="">
            <h1>Se connecter </h1>
            <input hidden name="login">
            <input type="email" placeholder="Email" name="lEmail"/>
            <input type="password" placeholder="Password" name="lPassword"/>
            <a href="#">Forgot your password?</a>
            <button>Se connecter</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Bienvenue !</h1>
                <p>Veuillez vous connecter pour accéder au forum </p>
                <button class="ghost" id="signIn">se connecter</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Bonjour !</h1>
                <p>créez un compte et rejoingnez nous </p>
                <button class="ghost" id="signUp">Créer un compte</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>