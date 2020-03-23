<?php
session_start();
if ($_POST['username'] && $_POST['password']) {
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['password'] = $_POST['password'];
  header("Location:../edit.php");
}
?>