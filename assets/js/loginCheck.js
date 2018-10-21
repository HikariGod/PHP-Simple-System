function check_login()
{
		var name=$("#username").val();;
		var b = new Base64();
		var pass = b.encode($("#password").val());
        var data = "action=getUserCheck&username="+name+"&password="+pass; 
        $.getJSON("server.php",data, function(data){
		 if(data.status!==0)
			{
				$("#user_name").val("");
				$("#password").val("");
				window.location.href="index.php";
			}else{
				$("#login_form").removeClass('shake_effect');
				setTimeout(function(){$("#login_form").addClass('shake_effect')},1);  
			}
       });  
}

$(function(){
	$("#login").click(function(){
		check_login();
		return false;
	})
})