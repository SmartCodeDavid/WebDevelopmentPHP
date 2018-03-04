<?php 
	$arrayUser = array();

	class User{
		var $name;
		var $birth;
		var $email;
		
		
		function __construct($name, $birth, $email){
			$this->name = $name;
			$this->birth = $birth;
			$this->email = $email;
		}
	}
	
	include("db_conn.php");
	$sql = "SELECT * FROM users WHERE Access = 1";
	$results = $mysqli->query($sql);
	if($results->num_rows > 0){
		while($row = $results->fetch_assoc()){
			$user = new User($row['Name'], $row['DOB'], $row['Email']);
			array_push($arrayUser, $user);
		}
	}
?>


<html>
	<head>
		<title>Home Page</title> <!--The tile of page-->
		<link rel="stylesheet" type="text/css" href="./css/assign1.css"/>
		<script type="text/javascript" src="./js/jquery-1.12.1.min.js"></script>
		<script type="text/javascript" src="./js/home.js"></script>
		
		<script>
			<!--The function shows references-->
			function show_ref(){
				var references = ["https://www.google.com.au/search?sa=G&hl=en-AU&q=%E5%8B%95%E6%BC%AB+%E8%B2%93+%E8%80%B3+%E7%94%B7&tbm=isch&tbs=simg:CAQSigEahwELEKjU2AQaAAwLELCMpwgaYgpgCAMSKOID6xLjA9oJ6hKqCeQDxAKNB_1MR1iPHI_1854zWKN9cj2COoLLwn0yMaMD-AQyFgdgkRkmSF6pHtzO-VU5u2OzMf0eNp7gqriA4GBWOxKADrpJOHcwcIxTyCaSADDAsQjq7-CBoKCggIARIEYrrPPAw&ved=0ahUKEwjllvfmofzLAhVC6aYKHcbeDfsQwg4IGSgA&biw=1920&bih=979#imgrc=gpfEJQIpMO11dM%3A",
								  "https://www.google.com.au/search?sa=G&hl=en-AU&q=pandora+hearts+oz&tbm=isch&tbs=simg:CAQSiwEaiAELEKjU2AQaAggKDAsQsIynCBphCl8IAxIn6xKsCtoJ5ANexAL8E6oJ8hHzEeM1qz7QI58srSiKN6AsySGAOok3GjBlRGtVDBHwoD5c6ekxBzQgBXOOY-eg4mv7XZrdOSPJsC_1QNp4kDp6vTbKgOJufWoUgAwwLEI6u_1ggaCgoICAESBF1Acz4M&ved=0ahUKEwiOiOOcovzLAhVGYqYKHfVHAiMQwg4IGSgA&biw=929&bih=931#imgrc=C5Wg1RvEaBHZlM%3A",
								  "https://www.google.com.au/search?sa=G&hl=en-AU&q=anime+tumblr+boy&tbm=isch&tbs=simg:CAQSjAEaiQELEKjU2AQaAggHDAsQsIynCBpiCmAIAxIopxzkA8QCrAqrCqgcoRykAtsSqwmhLKIs_1zmgLJ8srSirPv45wiPKIxowdh8YL-hqdMqkEPLqHlwYUCScmaMj9duo4-jrCvfx5xWXmcCSwVIPt7lSE8Xw9wNoIAMMCxCOrv4IGgoKCAgBEgT4n6slDA&ved=0ahUKEwih_oDjovzLAhXEIaYKHRneAowQwg4IGSgA&biw=929&bih=931#imgrc=56wLTEMmF_65OM%3A",
								  "https://www.google.com.au/search?sa=G&hl=en-AU&q=school+management+system&tbm=isch&tbs=simg:CAQSjAEaiQELEKjU2AQaAggFDAsQsIynCBpiCmAIAxIomwqaCrQKzBSDCp0KmhTQErcC9gOIKso3rz2tPZQnsj3JN7E6uTSZNBowI_1dWOVkgPN8o5_1Btd25ROYMeMfXtGfZb73wnmOSmRKXx2tDQsSkk7F5tjWVtlsU-IAMMCxCOrv4IGgoKCAgBEgTDfqDrDA&ved=0ahUKEwi01JCQpfzLAhWlqqYKHe9ZAFEQwg4IGSgA&biw=1920&bih=979#imgrc=8Bmp3Yu_uaBq2M%3A"
									];
									
				for(var i = 0; i < references.length; i++){
					if(i < 3){
						alert("The reference of image " + (i+1) + " in home page: " + references[i]);
					}else{
						alert("The reference of image " + (i+1) + " in student feedback page: " + references[i]);
					}

				}
			}
		</script>
	</head>
	
	<body>
		<div id="div_head">Home Page</div>
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
			
			<div id = 'div_Info'> <!--Brief info about website-->
                <div id="div_about">
                    <img id="about_img" src="imgs/about.png"/>
                </div>

				<div id = 'div_Description'>
					<p class = 'p_description'>
						Welcome to IT learning Online. Here is the network development department. 
						Through our teaching you will acquire knowledge of network development from us.
						 Our curriculum start from the most basic language HTML. <br/>
						 When student can understand clearly 
						 we will go into JavaScript and jquery which is very useful programming language on web design 
						 platform.Finally, there is PHP language also will be introduced to our student. 
						 I hope we can assist you be a web programmer successfully
					</p>
				</div>

                <div id = 'div_t_about'>
                        <img id="img_t_abut" src="imgs/teacher.png"/>
                </div>
				
				<div id = 'div_image'>
					<div class = "img"><img id="img1" src="./imgs/lecture.png"/></div>
					<div class = "img"><img id="img2" src="./imgs/tutor1.png"/></div>
					<div class = "img"><img id="img3" src="./imgs/tutor2.jpg"/></div>
					
					<div id = "div_teacher">
						<p class = 'p_description' id = 'p1'>
							Hi, my name is David. My main responsibility is to teach
							web front-end development have 10 year experience in developing web field. 
							If you have any questions about front-end development, you can email me.
						</p>
						<p class = 'p_description' id = 'p2'>
							Hi, my name is Jenny, I am a graphic designer. 
							In web front-end development we usually need to make a web structure though Photoshop or some 
							graphics software. So it is also necessary to learn the graphic manipulation technique. 
							In addition, I will be bother the tutor and lecturer on the Photoshop, AI course. 
							I hope that I can help you all. Email me if you have any query. 
						</p>
						<p class = 'p_description' id = 'p3'>
							Hello, my name is master C, the main responsibility I do is to teach 
							student background development. In my course, I will introduce how the PHP and SQL work on the 
							server does and how to set up an environment of LAMP. The PHP will become as the basic language 
							I will teach on the background development. Hope you all learn the more from me. 
						</p>
					</div>
				</div>	
				
				<div id="div_user">
					<div>
						<h2 id='staff_info'>Staff information</h2>
						<ul id="ul_staff">
							<?php 
								for($i = 0; $i < count($arrayUser); $i++){
									$temp = "<li><a>" . $arrayUser[$i]->name ."</a></li>";
									echo $temp;
								}
							?>
						</ul>
							<?php
								for($i = 0; $i < count($arrayUser); $i++){
								
							?>
							
							<div class="detail_staff" id="name<?php echo $i;?>" >
								<ul><li>Name : <?php echo $arrayUser[$i]->name;?></li></br>
								<li>Email: <?php echo $arrayUser[$i]->email;?></li></br>
								<li>Date of  birth: <?php echo $arrayUser[$i]->birth;?></li></ul>
							</div>
							<?php
								}
							?>
					</div>
				</div>
				
				<div id = 'div_Time'>
					<a id = "c_date">Cureent date:</a><br/>
					<a id = "c_time">time is :</a><br><br>	
					<input type='button' onclick="show_ref()" value="show images references">
				</div>
				
				<div id='footer'>The University	of Tasmania	username of	the developer: tblan <br>&nbsp&nbsp&nbsp The student number	of the developer: 200906</div>
				</div>
				
			</div>
		</div>
	</body>
</html>

<script>
	var ul_staff = document.getElementById('ul_staff');
	var staff= ul_staff.getElementsByTagName('a');
	var flag = [0,0,0];
	for(var i = 0; i < staff.length; i++){
		staff[i].id =  i;
		staff[i].onclick = function(){
			//get object of the detail of staff
			var detail_staff = document.getElementById("name"+this.id);
			
			//if current staff is displayed then hide it
			if(detail_staff.style.display == "block"){
				detail_staff.style.display = "none";
				this.style.background = "#4CAF50";
				flag[this.id] = 0;
			} else {  //if not then display it
				//firstly we should ensure that we hide other staff's detail.
				for(var j = 0; j < staff.length; j++){
					var temp_detail = document.getElementById("name"+j);
					var temp_a = document.getElementById(j.toString());
					temp_detail.style.display = "none";
					temp_a.style.background = "#4CAF50";
					flag[j] = 0;
				}
				this.style.background = "#f44336";
				detail_staff.style.display = "block";
				flag[this.id] = 1;
			}
		};
		
		staff[i].onmouseover = function(){
			this.style.background = "#f44336";
		}
		staff[i].onmouseout = function(){
			if(flag[this.id] == 1){
				this.style.background = "#f44336";	
			}else{
				this.style.background = "#4CAF50";
			}
		}
	}
</script>


