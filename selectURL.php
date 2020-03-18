<?php
  $json = file_get_contents("php://input");
  $data = json_decode($json);
  if (isset($data->searchstr)) {
    $searchstr = $data->searchstr;
  }else{
    echo '找不到searchstr';
  }
  $db_user_utf8 = "root";
  $db_pwd_utf8 = "EG4U8888";
  $driver_options = array(PDO::ATTR_PERSISTENT=>true);
  unset($mydata_db);
  $mydata_db = new PDO("mysql:host=localhost;dbname=formurl;charset=utf8",$db_user_utf8,$db_pwd_utf8,$driver_options);
  $mydata_db->query("SET NAMES utf8");
  $mydata_db->setAttribute(PDO::ATTR_EMULATE_PREPARES,true);
  $mydata_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = "select url from formurl where keyword = :searchstr";

  $statement = $mydata_db->prepare($sql);
  $statement->execute(array(
      "searchstr" => $searchstr,
  ));
  $row = $statement->fetchAll(PDO::FETCH_ASSOC);
  $mydata_db = null;//關閉連接
  echo $row[0]['url'];
?>