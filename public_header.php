<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
<?php
include 'config.php';
$sitename = constant("SITE_NAME");
?>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>公共头部</title>
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/modernizr.js"></script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>

<body>
<div class="super-header clearfix">
	<h2><?php echo $sitename; ?></h2>
	<div class="head-right">
		<i class="ico-user"></i>当前用户：
		<div class="userslideDown">
			<a href="javascript:;" class="superUser"><?php session_start(); echo $_SESSION["username"]; ?><i class="ico-tri"></i></a>
			<div class="slidedownBox">
				<ul>
					<li><a href="change_password.php" target="Mainindex">修改密码</a></li>
					<li><a href="logout.php" target="_parent">退出</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--header-->


</body></html>