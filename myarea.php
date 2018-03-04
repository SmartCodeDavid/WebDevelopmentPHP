<?php
	$action = "";
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$name = "";
	$dob = "";
	$email = "";
	
	if($_POST["submit"] != null || $_POST["edit"] != null || $_COOKIE['username'] != null){
		//connect database and check the username and password
		include("db_conn.php");
		
		//if edit mode get password and username from cookies
		if($_POST["edit"] != null){ 
			if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
				$username = $_COOKIE["username"]; $password = $_COOKIE["password"];
				$name = $_POST['name'];
				$email = $_POST['email'];
				$dob = $_POST['dob'];
				
				//update the table
				$sql = "UPDATE users SET Name='$name', Email='$email', DOB='$dob' WHERE Username='$username'";
				$results = $mysqli->query($sql);
				$sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
				$results = $mysqli->query($sql);
			}
		} else if($_POST["submit"] != null) {  //if log in mode, find the data from database and set cookies
			$sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
			$results = $mysqli->query($sql);
		} else if($_COOKIE['username'] != null) { //if no any action but user alreay log in then show user's details
				$username = $_COOKIE["username"]; $password = $_COOKIE["password"];
				$name = $_POST['name'];
				$email = $_POST['email'];
				$dob = $_POST['dob'];				
				$sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
				$results = $mysqli->query($sql);
		}
		
		//if username and password are correct then show the detail of user
		if($results->num_rows > 0){ 
			if($_POST["edit"] != null) {echo "<script>alert('submit ')</script>";}
			if($_POST["submit"] != null) {
				echo "<script>alert('Log in successfully!')</script>";
				setcookie("username", $username, time()+3600);
				setcookie("password", $password, time()+3600);
			}
			while($row = $results->fetch_assoc()){
				$username = $row['Username'];
				$name = $row['Name'];
				$dob = $row['DOB'];
				$email = $row['Email']; 
				//if there is not the cookie for access then set up a cookie
				if(!isset($_COOKIE['access'])){
					setcookie("access", $row['Access'], time()+3600); 
					setcookie("id", $row['ID'], time()+3600); 
					//refesh the page once set up the cookie
					header('Location: myarea.php');
				}	
			}
?>
<!--Show the user detail-->
<html>
	<head>
		<title>Sign up</title> <!--The tile of page-->
		<link rel="stylesheet" type="text/css" href="./css/myarea.css"/>
		<script type="text/javascript" src="./js/jquery-1.12.1.min.js"></script>
		<script>
		$(document).ready(function(){
			//when mouse enter navigation then change the color
			$("div#div_Navigation a").mouseenter(function() {
				$(this).css("color", "red");
			});
			
			$("div#div_Navigation a").mouseleave(function() {
				$(this).css("color", "white");
			});
		});
		</script>
		
	</head>
	
	<body>
		<div id="div_head">My Area Page</div>
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
			
			<div id="div_userShow"><?php if(isset($_COOKIE['username'])){
					echo "<img id='img_user' src='./imgs/user_icon.png'/>";
					echo "HI " . $_COOKIE['username'] ."  " . "<a id='a_login' href='./logout.php'>Log out</a>";
				}else{
					echo "<a id='a_login' href='./myarea.php'>Log in</a>";		
				}
			?></div>
						
			<div id="user_info">
				<p id="welcome">Welcome <?php echo $username;?></p>
				<form action="" method="POST">
					<ul id="ul_form">
						  Username:<li><input type="text" name="username" value=<?php echo "$username"?> disabled></li>
						  Name:<li><input type="text" name="name" value=<?php echo "$name";?>></li><br>
						  Date of birth:<li><input type="text" name="dob" value=<?php echo "$dob";?>></li><br>
						  Email:<li><input type="text" name="email" value=<?php echo "$email";?>></li><br>
						<li><input type="submit" value="Submit" name="edit" >&nbsp&nbsp<input type="reset" name="reset" value="Reset"></li>
					</ul>
				</form>
			</div>
			<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>&nbsp&nbsp&nbsp The student number	of the developer: 200906</div>
			</div>
		</div>
	</body>
</html>

<?php  
	exit;}else{
?>

<?php  //if this username and password are incorrect
			echo "<script>alert('Log in unsuccessfully!')</script>";
		}
	} 
?>


<html>
	<head>
		<title>Sign up</title> <!--The tile of page-->
		<link rel="stylesheet" type="text/css" href="./css/myarea.css"/>
		<script type="text/javascript" src="./js/jquery-1.12.1.min.js"></script>
		<script type="text/javascript" src="./js/myarea.js"></script>
		
	</head>
	
	<body>
		<div id="div_head">My Area Page</div>
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
						echo "<a href='./page2.html'>Admin</a>"	;
					}
				?>
				<a href="contactus.php">Contact us</a>
			</div>
			<div id="div_userShow"><?php if(isset($_COOKIE['username'])){
							echo "HI " . $_COOKIE['username'] ."  " . "<a id='a_login' href='./logout.php'>Log out</a>";
						}else{
							echo "<a id='a_login' href='./myarea.php'>Log in</a>";		
						}
			?></div>			
			
			
			<div id="user_info">
				<form action="" method="POST">
					<ul id="ul_form">
						* Username:<li><input type="text" name="username"></li>
						* Password:<li><input type="password" name="password"></li><br>
						<li><input type="submit" value="Log in" name="submit" disabled>&nbsp&nbsp<input type="reset" name="reset" value="Reset"></li>
					</ul>
				</form>
			</div>
			<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>&nbsp&nbsp&nbsp The student number	of the developer: 200906</div>
			</div>
		</div>
	</body>
</html>