<?php
session_start();
/** @var $db  */
//checks if user has logged in cookies otherwise send to inlog.php
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: inlog.php');
    exit;
} else {
    //selects all codes from database
    require_once "database.php";
    $query = "SELECT * FROM codes";
    $result = $db -> query($query);
}
?>
<!--begin html-->
<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
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
<h1>Codes</h1>
<!--puts codes from database into a table with link to edit and delete page-->
<table id="codes">
    <thead>
    <tbody>
    <?php if ($result->num_rows > 0) { ?>
        <?php while($row = $result->fetch_assoc()) {?>
                <tr>
                    <td><?= $row["code"]?></td>
                    <td><a href="edit.php?id=<?= $row['id']?>">Edit</a></td>
                    <td><a href="delete.php?id=<?= $row['id']?>">Verwijder</a></td>
                </tr>
            <?php
        }
    } ?>
    </tbody>
</table>

<!--logs user out, clears session-->
<a href="logout.php">uitloggen</a>
</body>

