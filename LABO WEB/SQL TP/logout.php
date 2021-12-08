<?php

session_start();

unset($_SESSION['name']);
unset($_SESSION['admin']);
unset($_SESSION['id']);

header('Location: index.php');
exit();