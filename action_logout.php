<?php
session_start();

if ($_SESSION['csrf'] !== $_POST['csrf']) {
    echo "<script>";
    echo "alert('Request does not appear to be legitimate');";
    echo "window.location = '../profile.php';"; // redirect with javascript, after page loads
    echo "</script>";
  }

if (isset($_SESSION)) {
    session_destroy();
    }

    header('Location: login.php');
?>
