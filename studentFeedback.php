<?php
	include("db_conn.php");

	//get value from cookies
	$id = $_COOKIE['id'];
	$username = $_COOKIE['username'];

	//get value from form
	$Gender = $_POST['gender'];
	$State = $_POST['state'];
	$city = $_POST['city'];
	$satisfaction = $_POST['satisfaction'];

	if(isset($_POST['submit'])){
		//insert data to table called feedback 
		$sql = "INSERT INTO feedback (Gender, State, City, Satisfaction) VALUES 
					('$Gender', '$State', '$city', '$satisfaction') ";
		if($mysqli->query($sql)){
			echo "<script>alert('Upload the feedback successfully!');</script>";
		}else{
			echo "<script>alert('Upload the feedback unsuccessfully!');</script>";
		}		
	}
?>

<html>
<head>
	<title>
		Student Feedback
	</title>
	<link rel="stylesheet" type="text/css" href="./css/studentfb.css"/>
	<script type="text/javascript" src="./js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript" src="./js/student.js"></script>
	
</head>

<body>
	<div id = 'div_outline'>
		<div id="div_head">Student Feedback Page</div>
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

		<div id = 'div1'><img id='img1' src = './imgs/sms.jpg'/>
		</div>
		
		<div id = 'div_form'>
			<form id = 'form1' action = "" method="post">
				<span>*Gender: </span><input class="input" type = 'radio' name = 'gender' value="male" checked>Male
								<input class="input" type = 'radio' name = 'gender' value="female">Female<br>
								
				<span>*State: </span><select name="state">
										<option value=""></option>
										<option value="ACT" >ACT</option>
										<option value="NSW" >NSW</option>
										<option value="NT">NT</option>
										<option value="QLD" >QLD</option>
										<option value="SA" >SA</option>
										<option value="TAS">TAS</option>
										<option value="VIC" >VIC</option>
										<option value="WA" >WA</option></select>
									<select name="city" disabled>
										<option value=""></option>
									</select><a id="a_state">Choose one!</a><br><br>

				<span>*Satisfaction: </span><input type="radio" name="satisfaction" value="satisfied" checked/>satisfied
											<input type="radio" name="satisfaction" value="notsatisfied"/>not satisfied<br>						
				<input class="input" type="submit" name="submit" disabled><br>
				<input id="reset" class="input"  name = "reset" type="reset" value="Reset"><br>
			</form>
		</div>
		
		<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>&nbsp&nbsp&nbsp The student number	of the developer: 200906</div>
	</div>
</body>
</html>


<script>
	
	window.onload = function(){
		var o_state = document.getElementsByName('state')[0];
		var o_city = document.getElementsByName('city')[0];
		var o_reset = document.getElementsByName('reset')[0];
		var a_state = document.getElementById('a_state');
		var o_submit = document.getElementsByName('submit')[0];

		o_reset.onclick = function(){
			o_city.innerHTML = "<option value=''></option>";
			o_city.disabled =true;
			o_submit.disabled = true;
			a_state.style.color = "red";
			a_state.innerHTML = "Choose one!";
		}

		//add a onclick event for state
		o_state.onchange = function() {
			//clear the city option firsly
			o_city.innerHTML = "";

			switch (this.value){
				case "ACT": 
						//Canberra
						addNode("Canberra");
						break;
				case "NSW": 
						addNode("Sydney");
						break;
				case "NT": 
						addNode("Darwin");
						break;
				case "QLD": 
						addNode("Brisbane");
						break;
				case "SA": 
						addNode("Adelaide");
						break;
				case "TAS": 
						addNode("Hobart");
						break;
				case "VIC": 
						addNode("Melbourne");
						break;
				case "WA": 
						addNode("Perth");
						break;
				default: 
						addNode("");
			}
		};

		function addNode(name){
			var temp_option = document.createElement("OPTION");
			var temp_textNode = document.createTextNode(name);
			temp_option.value = name;
			temp_option.appendChild(temp_textNode);
			o_city.appendChild(temp_option);
			if(name == ""){
				o_city.disabled = true;
				o_submit.disabled = true;
				a_state.style.color = "red";
				a_state.innerHTML = "Choose one!";
			}else{
				o_city.disabled = false;	
				o_submit.disabled = false;
				a_state.style.color = "green";
				a_state.innerHTML = "Correct!";
			}
		};

	}


</script>