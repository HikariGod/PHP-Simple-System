<html>
    <head>
        <meta charset="UTF-8">
        <title>MD5加密</title>
    </head>
    <body>
        <form action="" method="post">
            输入要加密的内容：<input type="text" name="pwd" />
            <input type="submit" name="submit" />
        </form>
    </body>
</html>
<?php
    if( isset($_POST['submit']) && $_POST['pwd'] !=''){
        echo '加密前：'.$_POST['pwd'].'<br />';
        echo '加密后：'.md5($_POST['pwd']);
    }
?>