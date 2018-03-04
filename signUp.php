<?php
	include("db_conn.php");

	$submit = $_POST['submit'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$email = $_POST['email'];
	$access = 2; //the default access level 
	$md5Password = md5($password);
	
	// If form is received successfully then insert user infomation to database
	if($submit != null){
		$sql = "";
		$name = $firstname . $lastname;
		if($year != null && $email != null){ 
			$birth = $year . "-" . $month . "-" . $day;
			$sql = "INSERT INTO users(Username, Password, Name, DOB, Email, Access) VALUES 
					('$username', '$md5Password', '$name', '$birth', '$email', '$access')";
		} else if($year != null) {
			$birth = $year . "-" . $month . "-" . $day;
			$sql = "INSERT INTO users(Username, Password, Name, DOB, Access) VALUES 
					('$username', '$md5Password', '$name', '$birth', '$access')";
		} else if($email != null) {
			$sql = "INSERT INTO users(Username, Password, Name, Email, Access) VALUES 
			('$username', '$md5Password', '$name', '$email', '$access')";
		} else {
			$sql = "INSERT INTO users(Username, Password, Name, Access) VALUES 
			('$username', '$md5Password', '$name', '$access')";
		}
		//if insert user information successfully
		if($mysqli->query($sql)){

?>
<html>

<head>
	<title></title>
	<style type="text/css">
		body{background-color: /*#C4C4C4*/ #FAF9DE; font-family: Tahoma;}
		#show_info{position: relative;width: 250px; height: 200px; text-align: center; 
		background-color: #e7e7e7;top:35%;margin: 0px auto;border-radius:12px;border: 20px #555555 solid;}
		#text{width: 250px;height: 120px;font-family: Tahoma;font-size: 25px;color: #EE4000;}
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
		<div id="text">Sign up <br>successfully!</div>
		<input id="button" type="button" value="OK">
	</div>
</body>

</html>

<?php //if sign up unsuccessfully
	} else {
?>
	
<html>

<head>
	<title></title>
	<style type="text/css">
		body{background-color: /*#C4C4C4*/ #FAF9DE; font-family: Tahoma;}
		#show_info{position: relative;width: 250px; height: 200px; text-align: center; 
		background-color: #e7e7e7;top:35%;margin: 0px auto;border-radius:12px;border: 20px #555555 solid;}
		#text{width: 250px;height: 120px;font-family: Tahoma;font-size: 25px;color: #EE4000;}
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
		<div id="text">Sign up <br>unsuccessfully!</div>
		<input id="button" type="button" value="OK">
	</div>
</body>

</html>

<?php 
} 
?>	

<?php // if user havent submit then 
} else { ?>

<html>
	<head>
		<title>Sign up</title> <!--The tile of page-->
		<link rel="stylesheet" type="text/css" href="./css/signup.css"/>
		<script type="text/javascript" src="./js/jquery-1.12.1.min.js"></script>
		<script type="text/javascript" src="./js/signup.js"></script>
		
	</head>
	
	<body>
		<div id="div_head">Sign Up Page</div>
		<div id = 'div1'>
			<div id = "div_Navigation"> <!--Link to all the pages-->
				<a href="./index.php">Home</a>
				<a href="./myarea.php">My area</a>
				<?php //if current user is student or adminstrator then student feedback will display
					if($_COOKIE['access'] == 1 || $_COOKIE['access'] == 2){
						echo "<a href='./studentFeedback.php'>Student feedback</a>";
					}
				?>
				<a href="./signUp.php">Sign up</a>
				<?php  //if current user's access is 1(administrator) then show this link
					if($_COOKIE['access'] == 1){
						echo "<a href='./admin.php'>Admin</a>"	;
					}
				?>
				<a href="contactus.php">Contact us</a>
			</div>
			
			<div id="div_userShow">
				<?php if(isset($_COOKIE['username'])){
					echo "<img id='img_user' src='./imgs/user_icon.png'/>";
					echo "HI " . $_COOKIE['username'] ."  " . "<a id='a_login' href='./logout.php'>Log out</a>";
				}else{
					echo "<a id='a_login' href='./myarea.php'>Log in</a>";		
				}
				?></div>			
			
			<div id="user_info">
				<form action="" method="POST">
					<ul id="ul_form">
						* Username:<li><input type="text" name="username"><a id="a_username"></a></li>
						* Password:<li><input type="password" name="password"><a id="a_password"></a></li>
						* Retype Password:<li><input type="password" name="repassword"><a id="a_repassword"></a></li>
						* First Name:<li><input type="text" name="firstname"><a id="a_firstname"></a></li>
						* Last Name:<li><input type="text" name="lastname"><a id="a_lastname"></a></li>
						* Date Of Birth:<li>
							<select name="year" id="year">
							<option value=""></option>
							</select>
							- <select name="month" id="month">
							<option value=""></option>
							</select>
							- <select name="day" id="day">
							<option value=""></option>
							</select><a id="a_birth"></a>
						</li>
						Email:<li><input type="email" name="email"/><a id="a_email"></a></li><br>
						<li><input type="submit" value="Sign Up" name="submit" disabled>&nbsp&nbsp<input type="reset" name="reset" value="Reset"></li>
						<br><br>Notice:<li style='color: green;'>Please type for each details with *</li>
					</ul>
				</form>
			</div>
			<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>&nbsp&nbsp&nbsp The student number	of the developer: 200906</div>
		</div>
	</body>
</html>

<?php
	}
?>