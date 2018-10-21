<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>登录</title>
  
  
  <link rel='stylesheet prefetch' href='assets/css/bootstrap.min.css'>

      <link rel="stylesheet" href="assets/css/style.css">

  
</head>

<body>

    <div class="wrapper">
    <form class="form-signin"  action="loginCheck.php">       
      <h2 class="form-signin-heading">登录</h2>
      <input type="text" class="form-control" name="username" placeholder="用户名"/>
      <input type="password" class="form-control" name="password" placeholder="密码"/>      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> 记住我
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>   
    </form>
  </div>
  
  

</body>

</html>
