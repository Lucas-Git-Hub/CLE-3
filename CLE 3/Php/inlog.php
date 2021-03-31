<?php
/** @var  $db */
session_start();
require_once 'database.php';

if (isset($_SESSION['loggedInUser'])){
    header('Location: account.php');
    exit;
}

if (isset($_POST['submit'])){

    $email = mysqli_escape_string($db,$_POST['email']);
    $password = $_POST['password'];

    $errors = [];
    if ($email == "") {
        $errors['email'] = "verplicht veld";
    }

    if ($password == "") {
        $errors['password'] = "verplicht veld";
    }

    if (empty($errors)){
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])){
                $_SESSION['loggedInUser'] = [
                    'userMail' => $user['email'],
                    'password' => $user['password'],

                ];
            }

        }

    }

}

$db -> close();

?>

<!doctype html>
<html lang = "en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inlogpagina</title>
</head>
<link rel="stylesheet" type="text/css" href="../Css/menubar.css"/>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="account.php">Account</a></li>
    </ul>
</nav>
<link rel="stylesheet" type="text/css" href="../Css/style.css"/>
<body>
<section>
    <h1>login</h1>
    <form id="inlog" action= "" method="post" enctype="multipart/form-data">
        <div>
            <label for="email">email</label>
            <input id="email" type="text" name="email" value = "<?= isset($email) ? htmlentities($email) : '' ?>"/>
            <span><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
        </div>
        <div>
            <label for="password">password</label>
            <input id="password" type="password" name="password" value = "<?= isset($password) ? htmlentities($password) : '' ?>"/>
            <span><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <div>
            <input type="submit" name="submit" value="login">
        </div>
    </form>
</section>
</body>