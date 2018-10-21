<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>测试</title>

</head>
<body>
<?php
header("Content-type: text/html; charset=utf-8"); 
include_once("database.php");
getConnection();
mysql_query("SET NAMES UTF8");
mysql_query("INSERT INTO users (`user_id`, `username`, `password`, `user_group`) VALUES (NULL, '小狗', 'bfd59291e825b5f2bbf1eb76569f8fe7', '0')");

closeConnection();
?>
</body>
</html>