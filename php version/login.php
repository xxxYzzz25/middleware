<?php
session_start();
if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'admin') {
  header("Location:../edit.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>login</title>
    <style>
      .box{
        width: 400px;
        height: 300px;
        padding: 10px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        border: 1px solid #000;
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        border-radius: 10px;
      }
      h3{
        width: 100%;
        text-align: center;
      }
      input{
        box-sizing: border-box;
        width: 300px;
        outline: none;
        border: 1px solid #000;
        border-radius: 10px;
        margin-bottom: 20px;
        padding: 10px 0;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div class="box">
      <h3>編輯連結登入</h3>
      <form action="logined.php" method="post">
        <input type="text" name="username" placeholder="帳號"/>
        <input type="password" name="password" placeholder="密碼"/>
        <input type="submit" value="登入">
      </form>
    </div>
  </body>
</html>
