<html>
<head>
	<title>
		Contact Us
	</title>
	<link rel="stylesheet" type="text/css" href="./css/contactus.css"/>
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
			<div id= "div2">Contact Us</div>
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
	

		
		<div id="div3">
			<ul>
				<li>ACT &nbsp&nbsp&nbsp phone:  0468x398x7</li><br>
				<li>NSW &nbsp&nbsp&nbsp phone:  0468x498x7</li><br>
				<li>NT  &nbsp&nbsp&nbsp phone:  0468x598x7</li><br>
				<li>QLD &nbsp&nbsp&nbsp phone: 0468x698x7</li><br>
				<li>SA  &nbsp&nbsp&nbsp phone:  0468x798x7</li><br>
				<li>TAS &nbsp&nbsp&nbsp phone: 0468x898x7</li><br>
				<li>VIC &nbsp&nbsp&nbsp phone:  0468x998x7</li><br>
				<li>WA  &nbsp&nbsp&nbsp phone:  0468x098x7</li><br>
			</ul>
		</div>
		<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>&nbsp&nbsp&nbsp The student number	of the developer: 200906</div>
	</div>

</body>

</html>