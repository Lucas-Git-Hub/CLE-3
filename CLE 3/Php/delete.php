<?php
session_start();
/** @var $db */
require_once "database.php";

//if not logged in send to inlog.php
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: inlog.php');
    exit;
}

$codeID = $_GET['id'];

//if yes button is clicked delete code and send user to account.php
if (isset($_POST['yes'])){
    $query = "DELETE FROM codes WHERE id = " . mysqli_escape_string($db, $codeID);
    $result = mysqli_query($db, $query);
    mysqli_close($db);
    header('Location: account.php');
    exit;
}
//if no button is clicked send user back to account.php
if (isset($_POST['no'])){
    mysqli_close($db);
    header('Location: account.php');
    exit;
}
?>

<!--begin html-->
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
<h1>Weet je zeker dat je dit wilt verwijderen?</h1>
<form action="" method="post">
    <!--stores id in variable-->
    <input type="hidden" name="id" value="<?= $codeID['id']?>"/>
    <div>
        <input type="submit" name="yes" value="ja"/>
    </div>
    <div>
        <input type="submit" name="no" value="nee"/>
    </div>
</form>
</body>
</html>
