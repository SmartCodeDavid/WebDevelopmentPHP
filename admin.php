<html>
<head>
	<title>
		Admin
	</title>
	<link rel="stylesheet" type="text/css" href="./css/admin.css"/>
	<script type="text/javascript" src="./js/jquery-1.12.1.min.js"></script>
	<!-- <script type="text/javascript" src="./js/student.js"></script> -->
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
	
	<div id="div1">
			<div id= "div2">Admin Page</div>
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


			<?php
				$id = '';
				$username = '';
				$name = '';
				$dob = '';
				$email = '';
				$access = '';
				$i = 0;
				if(($_POST['check_submit'] != null && md5($_POST['password']) == $_COOKIE['password']) || $_POST['submit'] != null){
					//connect database
					include("db_conn.php");
					
					if($_POST['submit'] != null){ //if user already check the password then this action is to update all users detail.
						//update all users details.
						$j = 1; // j is used to circle
						$flag = 0; //when update successfully flag = 1 otherwise 0
						while($_POST['id'.$j] != null){
							
							$id = $_POST['id'.$j];
							$username = $_POST['username'.$j];
							$name = $_POST['name'.$j];
							$dob = $_POST['dob'.$j];
							$email = $_POST['email'.$j];
							$access = $_POST['access'.$j];
							$sql = "UPDATE users SET Username='$username', Name='$name', DOB='$dob', Email='$email', Access='$access' WHERE ID=$id";
							if($mysqli->query($sql)){ //identify if the command excute successfully
								$flag = 1;
							}else{
								$flag = 0;
							}
							
							$j += 1; //j++ for next circle
						}
						if($flag == 1){ //if flag = 1 then update successfully
							echo "<script>alert('update successfully!');</script>";
						}else{ //otherwise unsuccessfully
							echo "<script>alert('update unsuccessfully!');</script>";
						}

					}else{  //if user's password havent  be checked 
						echo "<script>alert('correct password!');</script>";
					}
					
					$sql = "SELECT * FROM users";
					//get all users's detail from database
					$results = $mysqli->query($sql);
					echo"<form action='' method='post' name='edit'><table id = 'table_alluser'>";
					
					echo "<a id='a_head'>Users Table</a>";
					
					echo "<tr>
							<th>ID<th>
							<th>Username<th>
							<th>Name<th>
							<th>Date Of Birth<th>
							<th>Email<th>
							<th>Access<th>
							<tr>"	;
					//get all users detail from the results which already gain data from database
					while($row = $results->fetch_assoc()){ 
						$i += 1;
						$id = $row['ID'];
						$username = $row['Username'];
						$name = $row['Name'];
						$dob = $row['DOB'];
						$email = $row['Email'];
						$access = $row['Access'];
						
					
			?>
				<!--when adminstrator type a correct password then show all user's detail-->
					<tr>
						<th><input type='text' name=<?php echo "id".$i?> value=<?php echo $id; ?> Readonly/><th>
						<th><input type='text' name=<?php echo "username".$i;?> value=<?php echo $username;?> /><th>
						<th><input type='text' name=<?php echo "name".$i;?> value=<?php echo $name;?> /><th>
						<th><input type='text' name=<?php echo "dob".$i;?> value=<?php echo $dob;?> /><th>
						<th><input type='text' name=<?php echo "email".$i;?> value=<?php echo $email;?> /><th>
						<th>
							<select name=<?php echo "access".$i;?>>
								<?php
									if($access == 1){
										echo "<option value=1>admin</option>";
										echo "<option value=2>general</option>";
									}else{
										echo "<option value=2>general</option>";				
										echo "<option value=1>admin</option>";
									}
								?>			
							</select>
						<th>
					</tr>
				
			<?php
				 } echo "</table><br>"; echo "<input id='submit' name='submit' type='submit'><br><input id='reset' type='reset'>";echo "</form>";
					echo "<div id='footer2'>The University	of Tasmania	username of	the developer: tblan<br> The student number	of the developer: 200906</div>";			
				 } 

				 else { //if password is incorrect
				 	if($_POST['password'] != null) {
				 		echo "<script>alert('you have entered the wrong password.');</script>";
				 	}
			?>
			<div id="div_admin">
			<form name='check_password' method='post' action=''>
				</ul id="ul_admin">
					<li>Username: <input style='display:block; margin: 0px 30px;' type='text' value=<?php echo $_COOKIE['username'];?> disabled /></li>
					<li>Password: <input style='display:block; margin: 0px 30px;' type='password' name='password'></li>
					<li><input type='submit' style='display:block; margin: 0px 30px;' value='submit' name='check_submit'></li> <li><input type='reset'></li>
				</ul>
			</form>
			<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>The student number	of the developer: 200906</div>
			</div>
			<?php 
				}
			?>
	</div>

</body>

</html>