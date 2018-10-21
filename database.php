<?php    
$databaseConnection = null;   
function getConnection(){   
	include 'config.php';
	$hostname = constant("SQL_SERVER_NAME");           //数据库服务器主机名，可以用IP代替   
	$database = constant("SQL_DATABASE");              //数据库名   
	$userName = constant("SQL_USERNAME");              //数据库服务器用户名   
	$password = constant("SQL_PASSWORD");              //数据库服务器密码   
	global $databaseConnection;   
	$databaseConnection = @mysql_connect($hostname, $userName, $password) or die (mysql_error());	//连接数据库服务器
	mysql_query("set names 'gbk'");    //设置字符集   
	@mysql_select_db($database, $databaseConnection) or die(mysql_error());   
}   
function closeConnection(){   
	global $databaseConnection;   
	if($databaseConnection){   
		mysql_close($databaseConnection) or die(mysql_error());   
	}   
}   
?>   