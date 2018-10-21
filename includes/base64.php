<html>
    <head>
        <meta charset="UTF-8">
        <title>base64转码</title>
    </head>
    <body>
        <form action="" method="post">
            输入要转码的内容：<input type="text" name="pwd" />
            <input type="submit" name="submit" />
        </form>
    </body>
</html>

<?php  
    if( isset($_POST['submit']) && $_POST['pwd'] !=''){
        echo '转码前：'.$_POST['pwd'].'<br />';
        echo '转码后：'.base64_encode($_POST['pwd']);
    }
?>