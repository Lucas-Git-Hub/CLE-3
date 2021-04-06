<?php
/** @var  $db */
session_start();
require_once 'database.php';
$onjuist = false;

//checks if submit is clicked
if (isset($_POST['submit'])){
    //stores variables
    $email = mysqli_escape_string($db,$_POST['email']);
    $password = $_POST['password'];
    $errors = [];

    //checks if empty, then adds to errors
    if ($email == "") {
        $errors['email'] = "verplicht veld";
    }

    if ($password == "") {
        $errors['password'] = "verplicht veld";
    }

    //if no errors found
    if (empty($errors)){
        //looks for email in the database and returns array
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            //verifies password with hash and stores email and password in cookies
            if (password_verify($password, $user['password'])){
                $_SESSION['loggedInUser'] = [
                    'userMail' => $user['email'],
                    'password' => $user['password'],

                ];
            } else{
                $onjuist = true;
            }
        } else{
            $onjuist = true;
        }

    }

}
//if user logged in, send to account page
if (isset($_SESSION['loggedInUser'])){
    header('Location: account.php');
    exit;
}


?>

<!--begin html -->
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
<link rel="stylesheet" type="text/css" href="../Css/form.css"/>
<section>
    <h1>Login</h1>
    <form id="inlog" action= "" method="post" enctype="multipart/form-data">
        <div>
            <!--protect against html inputs-->
            <label for="email"></label>
            <input id="email" type="text" name="email" value = "<?= isset($email) ? htmlentities($email) : '' ?>" placeholder="Email"/>
            <!--shows errors from errors array-->
            <span><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
        </div>
        <div>
            <!--protect against html inputs-->
            <label for="password"></label>
            <input id="password" type="password" name="password" value = "<?= isset($password) ? htmlentities($password) : '' ?>" placeholder="Password"/>
            <!--shows errors from errors array-->
            <span><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <div>
            <input type="submit" name="submit" value="login">
        </div>
    </form>
    <!--gives error when email/password is wrong-->
    <?php if ($onjuist) { ?>
    <p>Email/Wachtwoord onjuist</p>
    <?php } ?>
</section>
</body>