<?php
session_start();
/** @var $db */
require_once "database.php";
$codeID = $_GET['id'];

//if not logged in send user to inlog.php
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: inlog.php');
    exit;
}

//checks if submit button is clicked
if (isset($_POST['submit'])){
    //stores codes in variable
    $code = mysqli_escape_string($db, $_POST['code']);
    $errors = [];
    //checks if empty, otherwise shows error
    if ($code==""){
        $errors['code'] = 'verplicht veld';
    }
    //checks if there are no errors, then updats code in new variable in database
    if (empty($errors)){
        $query = "UPDATE codes SET code = '$code' WHERE id='$codeID'";
        $result = mysqli_query($db, $query)
            or die('error: '.$query);
        //when completed, close database and send user back to account.php
        if ($result){
            mysqli_close($db);
            header('Location: account.php');
            exit;
        }
    }
}
//checks if cancel button is clicked, then sends user back to account.php
if (isset($_POST['cancel'])){
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
    <title>Edit</title>
</head>
<link rel="stylesheet" type="text/css" href="../Css/style.css">
<body>
<link rel="stylesheet" type="text/css" href="../Css/form.css">
<form action="" method="post">
    <h1>Voer nieuwe code in:</h1>
    <!--html entities, protects from html inputs-->
    <div>
        <label for="code"></label>
        <input id="code" type="text" name="code" value = "<?= isset($code) ? htmlentities($code) : '' ?>" placeholder="Code"/>
        <!--shows error from errors array-->
        <span><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
    </div>
    <div>
        <input type="submit" name="submit" value="confirm"/>
    </div>
    <div>
        <input type="submit" name="cancel" value="cancel"/>
    </div>
</form>
</body>
</html>
