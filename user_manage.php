<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
<?php
session_start();
if(!isset($_SESSION["code"])){header("location:login.php");} 
?>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>用户管理</title>
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/modernizr.js"></script>
	<script> 

	function del(_uid,_pageNum){ 
		if(window.confirm("确定要删除用户[ID："+_uid+"]吗？")){ 
		var data = "action=checkUID&uid="+_uid; 
        $.getJSON("server.php",data, function(data){
		 if(data.status!==0)
			{
				var hrefurl = "user_manage.php?pageNum="+_pageNum+"&status=delete&uid="+_uid;
				window.location.href=hrefurl;
				alert("数据删除成功");
				return true;
			}else{
				alert("这个用户[ID："+_uid+"]不存在哦~");
				return false;
			}
       });   
		}else{ 
			return false; 
		} 
	} 
	</script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>

<?php
//error_reporting(0);

@$allNum = allPage();//全部数据条数 
@$pageSize = 7; //每页显示的信息条数
@$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
@$endPage = ceil($allNum/$pageSize); //总页数
@$array = page($pageNum,$pageSize);
//@$siteurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];//获取当前url
$siteurl = 'user_manage.php?pageNum='.$pageNum;//获取当前url+当前页数

if(isset($_GET["status"])){
	if(checkUID($_GET["uid"])){
		switch($_GET["status"]){
			case 'delete':
				include_once("database.php");
				getConnection();
				mysql_query("SET NAMES UTF8");
				$sql = "delete from users where user_id=".$_GET["uid"];
				$result = mysql_query($sql);
				if($result){
					header("location:user_manage.php?pageNum=".$pageNum);  //删除成功，则跳转回显示页面
				}else{
					echo '<span style="color:#6cf;">发生错误！</span>';
				}
			break;
			case 'dmodify':
				echo '修改操作成功，';
				echo '用户ID是：'.$_GET["uid"];
			break;
		}
	}else{
		echo '用户ID：'.$_GET["uid"].' 不存在哦';
	} 
} 

function checkUID($uid){//检测有没有这个UID存在
	//include_once("database.php");
	//getConnection();
	mysql_query("SET NAMES UTF8");
	$array = array();
	$rs = mysql_query("select user_id from users where user_id=".$uid);
	if(mysql_num_rows($rs) < 1){
		return false;//检测到不存在，输出false
	}
	//closeConnection();
	return true;//存在
}

function wd_search(){
	if(isset($_GET["search"])){
		return "WHERE username LIKE '%".$_GET["search"]."%'";
	}else{
		return null;
	}
}

function page($pageNum = 1, $pageSize = 10){//该页的数据
	include_once("database.php");
	getConnection();
	mysql_query("SET NAMES UTF8");
	$array = array();
	//$wd_search = "WHERE username LIKE '%".$_GET["search"]."%'";
	if(wd_search()!==null){$wd_search=wd_search();}
	$rs = mysql_query("select * from users ".$wd_search."ORDER BY user_id ASC limit ".(($pageNum - 1) * $pageSize).",".$pageSize);
	//添加ORDER BY user_id ASC之后ID就不会以乱的顺序显示出来
	while($obj=mysql_fetch_assoc($rs)){
		$array[]=$obj;//接受结果集
	}
	//closeConnection();
	return $array;
}

function allPage(){
	include_once("database.php");
	getConnection();
	mysql_query("SET NAMES UTF8");
	//$wd_search = "WHERE username LIKE '%".$_GET["search"]."%'";
	if(wd_search()!==null){$wd_search=wd_search();}
	$rs = mysql_query("select count(*) num from users ".$wd_search); //可以显示出总页数
    $obj = mysql_fetch_assoc($rs);
	//closeConnection();
    return $obj['num'];
}
?>

<body style="background: #f6f5fa;">

	<!--content S-->
	<div class="super-content RightMain" id="RightMain">
		
		<!--header-->
		<div class="superCtab">
			<div class="ctab-title clearfix"><h3>用户管理</h3><a href="javascript:;" class="sp-column"><i class="ico-mng"></i>栏目管理</a></div>
			
			<div class="ctab-Main">
				<div class="ctab-Main-title">
					<ul class="clearfix">
						<li class="cur"><a href="user_manage.php">用户管理</a></li>
						<li><a href="user_manage.php">测试页面</a></li>
					</ul>
				</div>
				
				<div class="ctab-Mian-cont">
					<div class="Mian-cont-btn clearfix">
						<div class="operateBtn">
							<a href="user_add.php" class="greenbtn add sp-add">添加用户</a>
						</div>
						<div class="searchBar">
							<input type="text" id="" value="" class="form-control srhTxt" placeholder="输入标题关键字搜索">
							<input type="button" class="srhBtn" value="">
						</div>
					</div>
					
					<div class="Mian-cont-wrap">
						<div class="defaultTab-T">
							<table border="0" cellspacing="0" cellpadding="0" class="defaultTable">
								<tbody><tr><th class="t_1">用户ID</th><th class="t_2">用户名字</th><th class="t_3">用户所属部门</th><th class="t_4">操作</th></tr>
							</tbody></table>
						</div>
						<table border="0" cellspacing="0" cellpadding="0" class="defaultTable defaultTable2">
							<tbody>
                            <?php					
							foreach($array as $key=>$values){
							if($values['user_group']==0){
							$user_group = "管理员";
							}elseif($values['user_group']==1){
							$user_group = "哲学部";
							}elseif($values['user_group']==2){
							$user_group = "文学部";
							}
							echo "<tr>";
							echo "<td class='t_1'>".$values['user_id']."</td>";
							echo "<td class='t_2'>".$values['username']."</td>";
							echo "<td class='t_3'>".$user_group."</td>";
							echo '<td class="t_4"><div class="btn"><a href="'.$siteurl.'&status=dmodify&uid='.$values['user_id'].'" class="modify">修改</a><a onclick="del('.$values['user_id'].','.$pageNum.')" href="#" class="delete">删除</a></div></td>';
							echo "</tr>";
							}
							?>
						</tbody></table>
						<!--pages S-->
						<div class="pageSelect">
							<?php
							/*
							if(count($rows)/10<1){
								$paper=1;
								}else{
								$paper=ceil(count($rows)/10);
								}
                            echo '<span>共 <b>'.count($rows).'</b> 条 每页 <b>10 </b>条   1/'.$paper.'</span>';
							*/
							?>
							<div class="pageWrap">
                            <a href="?pageNum=1">首页</a>
							<a  class="pagePre" href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>"><i class="ico-pre">&nbsp;</i></a>
                            <a class="pagenext" href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>"><i class="ico-next">&nbsp;</i></a>
                            <a href="?pageNum=<?php echo $endPage?>">尾页</a>
                            	<?php
								/*
								echo '<a class="pagePre"><i class="ico-pre">&nbsp;</i></a>';
								for ($x=1; $x<=$paper; $x++) {
								if($x==1){
									echo '<a href="#" class="pagenumb cur">1</a>';
									}else{
									echo '<a href="#" class="pagenumb">'.$x.'</a>';
									}
								} 
								echo '<a href="#" class="pagenext"><i class="ico-next">&nbsp;</i></a>';
								*/
								?>
							</div>
						</div>
						<!--pages E-->
					</div>
				
				</div>
			</div>
		</div>
		<!--main-->
		
	</div>
	<!--content E-->

</body></html>