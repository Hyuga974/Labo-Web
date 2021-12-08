<?php

session_start();

if (!isset($_SESSION['name'])) {
    header('Location: connection.php');
    exit();
}