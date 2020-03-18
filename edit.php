<?php
session_start();
if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'admin') {
}else {
  header("Location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Edit</title>
    <style>
      *{
        outline:none;
      }
      .wrapper{
        width: 1000px;
        margin: 0 auto;
      }
      h4{
        margin: 30px auto;
        text-align: center;
        font-size: 30px;
      }
      .addTable{
        margin-bottom: 50px;
      }
      .addTableOff{
        margin-bottom: 50px;
        display: none;
      }
      table{
        width: 100%;
        text-align: center;
      }
      tr{
      }
      th{
        font-size: 18px;
        letter-spacing: 2px;
        font-weight: bold;
        border-bottom: 1px solid #333;
      }
      td{
        border-bottom: 1px solid #333;
        padding: 5px 0;
      }
      input{
        width:80%;
      }
      .addbtn{
        width: 77px;
        float: right;
        margin-bottom: 30px;
      }
      .btn{
        font-size: 16px;
        border: #333 2px solid;
        border-radius: 24px;
        color: #333;
        padding: 4px 30px;
        background: transparent;
        cursor: pointer;
        text-align: center;
      }
      .btn:hover{
        border: #333 2px solid;
        background: #333;
        color:#fff;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <h4>搜尋關鍵字編輯</h4>
      <div class="btn addbtn" id="add">新增</div>

      <form action="../addToDB.php" method="post">
        <table class="addTableOff" id="addTable">
          <tr>
            <th>關鍵字</th>
            <th>網址連結</th>
            <th>編輯</th>
          </tr>
          <tr>
            <td><input type="text" name="keyword"></td>
            <td><input type="text" name="url"></td>
            <td>
              <input type="submit" value="確認新增" class="btn">
            </td>
          </tr>
        </table>
      </form>


        <table>
          <tr>
            <th>關鍵字</th>
            <th>網址連結</th>
            <th>編輯</th>
            <th>刪除</th>
          </tr>
        <?php
          $db_user_utf8 = "root";
          $db_pwd_utf8 = "EG4U8888";
          $driver_options = array(PDO::ATTR_PERSISTENT=>true);
          unset($mydata_db);
          $mydata_db = new PDO("mysql:host=localhost;dbname=formurl;charset=utf8",$db_user_utf8,$db_pwd_utf8,$driver_options);
          $mydata_db->query("SET NAMES utf8");
          $mydata_db->setAttribute(PDO::ATTR_EMULATE_PREPARES,true);
          $mydata_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = "select * from formurl";

          $statement = $mydata_db->prepare($sql);
          $statement->setFetchMode(PDO::FETCH_ASSOC);
          $statement->execute();
          while ($row = $statement->fetchObject()) {
        ?>
          <tr>
            <form action="../updateToDB.php" method="post">
              <input type="hidden" name="id" value="<?php echo $row->id;?>">
              <td><input type="text" name="keyword" value="<?php echo $row->keyword;?>"></td>
              <td><input type="text" name="url" value="<?php echo $row->url;?>"></td>
              <td>
                <input type="submit" value="異動" class="btn">
              </td>
            </form>
            <td>
              <form action="../deleteToDB.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row->id;?>">
                <input type="submit" value="刪除" class="btn">
              </form>  
            </td>
          </tr>
        <?php
          }
        ?>
        </table>
      <?php
        $mydata_db = null;//關閉連接
      ?>
    </div>
    <script>
      const add = document.getElementById('add')
      add.addEventListener('click', function () {
        const addTable = document.getElementById('addTable')
        if (addTable.className.match('addTableOff')) {
          addTable.className =
              addTable.className.replace
                  ('addTableOff', 'addTable')
          add.innerText = '取消新增'
        } else {
          addTable.className =
              addTable.className.replace
                  ('addTable', 'addTableOff')
          add.innerText = '新增'
        }
      });
    </script>
  </body>
</html>
