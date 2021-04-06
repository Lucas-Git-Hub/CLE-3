<?php
//clears cookies
session_start();

session_unset();

session_destroy();

header("Location: inlog.php");

exit;