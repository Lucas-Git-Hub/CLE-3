<?php

/** @var  $db */
session_start();
require_once 'database.php';
$gelukt = false;

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
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, password) VALUES ('$email','$password');";
        $result = mysqli_query($db,$query);
        if ($result){
            $gelukt = true;
        }
    }

}

$db -> close();

?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maak Account</title>
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
<link rel="stylesheet" type="text/css" href="../Css/form.css">
<?php if ($gelukt){ ?>
    <p>Account aangemaakt!</p>
<?php } else { ?>
    <h1>Maak Account</h1>
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
<?php } ?>
</body>