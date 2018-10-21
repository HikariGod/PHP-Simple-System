<?php
include_once("database.php"); //连接数据库 
$action=$_GET["action"];  

if($action=="getUserCheck"){ //获取登录验证
	$username=$_GET["username"];
	$password=MD5(base64_decode($_GET["password"]));
	getConnection();
	mysql_query("SET NAMES UTF8");
    $query=mysql_query("select * from users where username='$username' and password='$password'");
    $row=mysql_fetch_array($query);
	if($row['user_id']!=null){
		//echo "用户名和密码输入正确！登录成功！";   
		$status=1;
		session_start(); 
		$_SESSION["username"]=$username;
		$_SESSION["code"]=mt_rand(0,100000);
	}else{   
		//echo "用户名和密码输入错误！登录失败！";   
		$status=0;
	}
    $list=array("status"=>$status);
	echo json_encode($list);
	closeConnection();
} 

if($action=="checkUID"){ //检测用户UID
	$uid=$_GET["uid"];
	include_once("database.php");
	getConnection();
	mysql_query("SET NAMES UTF8");
	$array = array();
	$rs = mysql_query("select user_id from users where user_id=".$uid);
	if(mysql_num_rows($rs) < 1){
		$status=0;//检测到不存在
	}else{
		$status=1;//存在
	}
	$list=array("status"=>$status,"uid"=>intval($uid));
	echo json_encode($list);
	closeConnection();
} 

if($action=="addUser"){ //添加用户
	session_start();
	$se_username=$_SESSION["username"];
	$username=$_GET["username"];
	$password=MD5(base64_decode($_GET["password"]));
	$group=$_GET["group"];
	getConnection();
	mysql_query("SET NAMES UTF8");
	/*
	foreach($rows as $key=>$v){
		}
	*/
	$query=mysql_query("select * from users where username='$se_username'");
	$row1=mysql_fetch_array($query);
	if($row1['user_group']==0){
		$row2=mysql_query("INSERT INTO users (`user_id`, `username`, `password`, `user_group`) VALUES (NULL, '$username','$password', '$group')");
		if($row2){
		$status=1;//添加成功输出1
		}else{
		$status=0;//添加失败输出0
		}
	}else{
		$status=2;//你不是管理员输出2
	}
	
	$list=array("status"=>$status);
	echo json_encode($list);
	closeConnection();
} 

function checkUsername($username){//检测有没有这个UID存在
	//include_once("database.php");
	//getConnection();
	mysql_query("SET NAMES UTF8");
	$array = array();
	//SELECT user_id FROM users WHERE username =  'admin'
	$rs = mysql_query("select username from user where username=".$username);
	if(mysql_num_rows($rs) < 1){
		return false;//检测到不存在，输出false
	}
	//closeConnection();
	return true;//存在
}

/* 过于危险建议禁止调用*/
if($action=="getUserData"){ //获取用户信息
	$username=$_GET["username"];
	$password=$_GET["password"];
	getConnection(); 
	mysql_query("SET NAMES UTF8");
    $query=mysql_query("select * from user where username='$username' and password='$password'");
    $row=mysql_fetch_array($query);
    $list=array("user_id"=>$row['user_id'],"username"=>$row['username'],"password"=>$row['password']); 
    echo json_encode($list); 
	closeConnection();
} 


/* 过于危险禁止调用
if($action=="addSession"){ //添加用户已登录验证
	$username=$_GET["username"];
	session_start(); 
	$_SESSION["username"]=$username;
	$_SESSION["code"]=mt_rand(0,100000);
} 
*/
?>