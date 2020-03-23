<?php
session_start();
if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'admin') {
}else {
  header("Location:../login.php");
}
?>
<?php
	$id = $_POST["id"];
	$keyword = $_POST["keyword"];
	$url = $_POST["url"];

	$db_user_utf8 = "root";
	$db_pwd_utf8 = "EG4U8888";
	$driver_options = array(PDO::ATTR_PERSISTENT=>true);
	unset($mydata_db);
	$mydata_db = new PDO("mysql:host=localhost;dbname=formurl;charset=utf8",$db_user_utf8,$db_pwd_utf8,$driver_options);

	$sql= "update formurl set keyword = :keyword,url = :url where id = :id";
	$data = $mydata_db -> prepare($sql);
	$data -> bindParam(":id",$id);
	$data -> bindParam(":keyword",$keyword);
	$data -> bindParam(":url",$url);
	$data -> execute();
	
  header("Location:../edit.php");
?>