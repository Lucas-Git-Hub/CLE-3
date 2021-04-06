<?php
//checks if user has logged in cookies otherwise send to inlog.php
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: inlog.php');
    exit;
}