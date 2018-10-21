<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>进销存管理系统</title>
</head>
<?php
session_start();
if(!isset($_SESSION["code"])){header("location:login.php");} 
?>

<body>

<?php
if($_SERVER['REMOTE_ADDR']=="::1"){
		$addr="127.0.0.1";
	}else{
		$addr=$_SERVER['REMOTE_ADDR'];
	}
echo "欢迎登录！".$_SESSION["username"];
echo "<br>你的IP：".$addr;
echo "<br>你的系统语言：".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
echo "<br>你的浏览器为：".$_SERVER['HTTP_USER_AGENT'];
echo '<br><a href="logout.php">退出登录</a>';
?>
</body>
</html>