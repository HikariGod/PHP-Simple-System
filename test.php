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
$query=mysql_query("select * from user");
while($row=mysql_fetch_assoc($query)){
$rows[]=$row;//接受结果集
}
closeConnection();
 

//遍历数组
echo "<table>";
foreach($rows as $key=>$v){
	if($v['user_group']==0){
		$user_group = "管理员";
		}elseif($v['user_group']==1){
		$user_group = "普通用户";
		}
	echo "<tr>";
	//echo $v['user_id']."---".$v['username']."---".$v['password']."---".$v['user_group']."<br>";
    echo "<td>".$v['user_id']."</td><td>".$v['username']."</td><td>".$user_group."</td>";
	echo "</tr>";
}
echo "</table>";
?>
</body>
</html>