<?php
	//what this file do is to remove the cookie when user log out
	setcookie("username", "", time()-3600);
	setcookie("password", "", time()-3600);
	setcookie("access", "", time()-3600);
	setcookie("id", "", time()-3600);
	
?>

<html>

<head>
	<title></title>
	<style type="text/css">
		body{background-color: /*#C4C4C4*/ #FAF9DE; font-family: Tahoma;}
		#show_info{position: relative;width: 250px; height: 200px; text-align: center; 
		background-color: #e7e7e7;top:35%;margin: 0px auto;border-radius:12px;border: 20px #555555 solid;}
		#text{width: 250px;height: 120px;font-size: 25px;color: #EE4000;}
		#button{width: 250px;height: 80px;background-color:#4CAF50;border-radius:3px;font-size: 33px;}
		
	</style>
	<script>
		window.onload = function(){
			var o_button = document.getElementById("button");
			o_button.onclick = function() {
				location.href = "signUp.php";
			}
		};
	</script>
</head>

<body>
	<div id="show_info">
		<div id="text">Log out <br>successfully!</div>
		<input id="button" type="button" value="OK">
	</div>
</body>

</html>

<script>
	window.onload = function(){
		var o_btn = document.getElementById('button');
		o_btn.onclick = function () {
			location.href = "myarea.php";
		}
	}
	
</script>