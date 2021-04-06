<?php
session_start();
/** @var $db */
require_once "database.php";

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: inlog.php');
    exit;
}

$codeID = $_GET['id'];

if (isset($_POST['yes'])){
    $query = "DELETE FROM codes WHERE id = " . mysqli_escape_string($db, $codeID);
    $result = mysqli_query($db, $query);
    mysqli_close($db);
    header('Location: account.php');
    exit;
}
if (isset($_POST['no'])){
    mysqli_close($db);
    header('Location: account.php');
    exit;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete</title>
</head>
<link rel="stylesheet" type="text/css" href="../Css/style.css">
<body>
<link rel="stylesheet" type="text/css" href="../Css/form.css">
<form action="" method="post">
    <p>Weet je zeker dat je dit wilt verwijderen?</p>
    <input type="hidden" name="id" value="<?= $codeID['id']?>"/>
    <input type="submit" name="yes" value="ja"/>
    <input type="submit" name="no" value="nee"/>
</form>
</body>
</html>
