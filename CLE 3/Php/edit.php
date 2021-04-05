<?php
session_start();
/** @var $db */
require_once "database.php";
$codeID = $_GET['id'];

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: inlog.php');
    exit;
}
if (isset($_POST['submit'])){
    $code = mysqli_escape_string($db, $_POST['code']);
    $errors = [];
    if ($code==""){
        $errors['code'] = 'verplicht veld';
    }
    if (empty($errors)){
        $query = "UPDATE codes SET code = '$code' WHERE id='$codeID'";
        $result = mysqli_query($db, $query)
            or die('error: '.$query);

        if ($result){
            mysqli_close($db);
            header('Location: account.php');
            exit;
        }
    }
}
if (isset($_POST['cancel'])){
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
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <h1>code</h1>
    <div>
        <label for="code">code</label>
        <input id="code" type="text" name="code" value = "<?= isset($code) ? htmlentities($code) : '' ?>"/>
        <span><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
    </div>
    <input type="submit" name="submit" value="confirm"/>
    <input type="submit" name="cancel" value="cancel"/>
</form>
</body>
</html>
