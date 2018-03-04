$(document).ready(function(){
	//when mouse enter navigation then change the color
	$("div#div_Navigation a").mouseenter(function() {
		$(this).css("color", "red");
	});
	
	$("div#div_Navigation a").mouseleave(function() {
		$(this).css("color", "white");
	});
});

			var check = new Array(0,0,0,0,0,0,1); //array check is uesd to whether user input correctly for every text area
			var USERNAMAE = 0;
			var PASSWORD = 1;
			var REPASSWORD = 2;
			var FIRSTNAME = 3;
			var LASTNAME = 4;
			var BIRTH = 5;
			var EMAIL = 6;
			//----------------------------------------------------------
			
			window.onload = function(){
				//init the year, month and day
				var o_year = document.getElementById("year");
				var o_month = document.getElementById("month");
				var o_day = document.getElementById("day");
				//year
				for(var i = 1100; i <= 2016; i++){
					var temp_option = document.createElement("OPTION");
					var temp_textNode = document.createTextNode(i.toString());
					temp_option.appendChild(temp_textNode);
					temp_option.value = i.toString();
					o_year.appendChild(temp_option);
					
				}
				//month
				for(var i = 1; i <= 12; i++){
					var temp_option = document.createElement("OPTION");
					if(i < 10){
						var temp_textNode = document.createTextNode("0" + i);
						temp_option.value = "0" + i;
					}else{
						var temp_textNode = document.createTextNode(i.toString());
						temp_option.value = i.toString();
					}
					temp_option.appendChild(temp_textNode);
					o_month.appendChild(temp_option);
				}
				
				//Disable select except year
				o_month.disabled = true;
				o_day.disabled = true;
				
				//add event for each select node
				o_year.onchange = function(){
					if(this.value == ""){
						o_month.disabled = true;
						o_day.disabled = true;
						o_month.selectedIndex = 0;
						check[BIRTH] = 0;
						o_day.innerHTML = "<option value=''></option>";
					} else {
						o_month.disabled = false;	
						check[BIRTH] = 0;
					}
					checkALLInfo();
				};
				
				o_month.onchange = function(){
					o_day.innerHTML = "<option value=''></option>";
					o_day.disabled = false;
					if(this.value == "02"){ //if user select Feb as month
						addNode(29);
					} else if(this.value == "04" || this.value == "06" || this.value == "09" 
								|| this.value == "11") {
						addNode(30);
					} else if(this.value == ""){
						o_day.disabled = true;
					} else {
						addNode(31);
					}
					check[BIRTH] = 0;
					checkALLInfo();
				};
				
				o_day.onchange = function(){
					if(this.value == ""){
						check[BIRTH] = 0;
					}else{
						check[BIRTH] = 1;	
					}
					checkALLInfo();
				};
				
				//add options for select automatically
				function addNode(num){
					for(var i = 1; i <= num; i++){
						var temp_option = document.createElement("OPTION");
						if(i < 10){
							var temp_textNode = document.createTextNode("0" + i);
							temp_option.value = "0" + i;
						}else{
							var temp_textNode = document.createTextNode(i.toString());
							temp_option.value = i.toString();
						}
						temp_option.appendChild(temp_textNode);
						o_day.appendChild(temp_option);
					}					
				};
				
				var o_input = document.getElementsByTagName("input");
				for(var i = 0; i < o_input.length; i++){
					if(o_input[i].name != "submit" && o_input[i].name != "reset"){
						o_input[i].onfocus = function(){this.style.background = "yellow";};
						o_input[i].onblur = function(){this.style.background = "white";};
						o_input[i].onchange = input_change;
						o_input[i].onkeyup = input_change;
					}
				}
				
				// add event for reset button
				var o_reset = document.getElementsByName("reset")[0];
				
				//when reset press down clear all <a> descriptions of checking
				o_reset.onclick = function(){
					var o_li = document.getElementsByTagName("li");
					for(var i = 0; i < o_li.length; i++){
						var o_a = o_li[i].getElementsByTagName("a")[0];
						if(o_a != null){
							o_a.innerHTML = "";
						}
					}
				};
				
			};
			
			//when user type on text area this function will check the format of input and show result to user
			function input_change(){
				//alert(this.value);
				switch (this.name){
					case "username":
						if(this.value == ""){
							document.getElementById("a_username").innerHTML = "";
							check[USERNAMAE] = 1;
						}else{
							var reg = /^[a-zA-Z0-9]+$/;
							if(reg.test(this.value) == true){
								var temp;
								var xmlhttp = new XMLHttpRequest();
								xmlhttp.onreadystatechange=function(){
									if(xmlhttp.readyState==4 && xmlhttp.status==200){
										temp = xmlhttp.responseText;
										if(temp == "true"){
											document.getElementById("a_username").innerHTML = "This username have be used.";
											document.getElementById("a_username").style.color = "red";
											check[USERNAMAE] = 0;
										}else{
											document.getElementById("a_username").innerHTML = "This username have not be used.";
											document.getElementById("a_username").style.color = "green";
											check[USERNAMAE] = 1;
										}
										checkALLInfo();
									}
								}
															
								xmlhttp.open("POST", "checkuser.php", true);
								xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								xmlhttp.send("user="+this.value);
							}else{
								document.getElementById("a_username").innerHTML = "Username contains illegel character";
								document.getElementById("a_username").style.color = "red";
								check[USERNAMAE] = 0;
							}
							
													
						}
						checkALLInfo();
						break; 

					case "password": 
						if(this.value == ""){
							document.getElementById("a_password").innerHTML = "";	
							check[PASSWORD] = 0;
						} else if(this.value.length < 8){
							document.getElementById("a_password").innerHTML = "Password do not enough 8 characters";
							document.getElementById("a_password").style.color = "red";
							check[PASSWORD] = 0;
						}else{
							var reg = /^[^ ]{8,}$/;
							if(reg.test(this.value) == true){
								document.getElementById("a_password").innerHTML = "Password correct";
								document.getElementById("a_password").style.color = "green";
								check[PASSWORD] = 1;
							}else{
								document.getElementById("a_password").innerHTML = "Password can not contain space";
								document.getElementById("a_password").style.color = "red";
								check[PASSWORD] = 0;
							}
						}
						
						//also we should check the re-type password as well
						if(document.getElementsByName("repassword")[0].value != this.value){
							document.getElementById("a_repassword").innerHTML = "Re-type password not correct";
							document.getElementById("a_repassword").style.color = "red";
							check[REPASSWORD] = 0;
						} else if( document.getElementsByName("repassword")[0].value == ''){
							check[REPASSWORD] = 0;
						} else{
							document.getElementById("a_repassword").innerHTML = "Re-type password correct";
							document.getElementById("a_repassword").style.color = "green";
							check[REPASSWORD] = 1;
						}
						checkALLInfo();
						break;
									
					case "repassword": 
						if(this.value == ""){
							document.getElementById("a_repassword").innerHTML = "";
							check[REPASSWORD] = 0;
						}else{
							var o_password = document.getElementsByName("password")[0];
							if(this.value == o_password.value){
								document.getElementById("a_repassword").innerHTML = "Re-type password correct";
								document.getElementById("a_repassword").style.color = "green";
								check[REPASSWORD] = 1;
							} else {
								document.getElementById("a_repassword").innerHTML = "Re-type password not correct";
								document.getElementById("a_repassword").style.color = "red";
								
								check[REPASSWORD] = 0;
							}
						}
						checkALLInfo();
						break;
						
					case "firstname": 
						if(this.value == ""){
							document.getElementById("a_firstname").innerHTML = "";
							check[FIRSTNAME] = 0;
						}else{
							var reg = /^[a-zA-z]+$/;
							if(reg.test(this.value) == true){
								document.getElementById("a_firstname").innerHTML = "Correct format of firstname";
								document.getElementById("a_firstname").style.color = "green";
								check[FIRSTNAME] = 1;
							}else{
								document.getElementById("a_firstname").innerHTML = "Incorrect format of firstname";
								document.getElementById("a_firstname").style.color = "red";
								check[FIRSTNAME] = 0;
							}
						}
						checkALLInfo();
						break;
						
					case "lastname":
						if(this.value == ""){
							document.getElementById("a_lastname").innerHTML = "";
							check[LASTNAME] = 0;
						}else{
							var reg = /^[a-zA-z]+$/;
							if(reg.test(this.value) == true){
								check[LASTNAME] = 1;
								document.getElementById("a_lastname").innerHTML = "Correct format of firstname";
								document.getElementById("a_lastname").style.color = "green";
							}else{
								check[LASTNAME] = 0;
								document.getElementById("a_lastname").innerHTML = "Incorrect format of firstname";
								document.getElementById("a_lastname").style.color = "red";
							}
						}	
						checkALLInfo();									
						break;
						
					case "email": 
						if(this.value == ""){
							document.getElementById("a_email").innerHTML = "";
							check[EMAIL] = 1;
						}else{
							var reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; 
							if(reg.test(this.value) == true){
								document.getElementById("a_email").innerHTML = "Correct format of email";
								document.getElementById("a_email").style.color = "green";
								check[EMAIL] = 1;
							} else {
								document.getElementById("a_email").innerHTML = "Incorrect format of email";
								document.getElementById("a_email").style.color = "red";
								check[EMAIL] = 0;
							}
						}
						checkALLInfo();
						break;
				}
			}
			
			function checkALLInfo(){
				var flag = 0;
				for(var i = 0; i < check.length; i++){
					if(check[i] == 1){
						flag = 1;
					}else{
						flag = 0;
						break;
					}
				}
				if(flag == 1){
					document.getElementsByName("submit")[0].disabled = false;
				}else{
					document.getElementsByName("submit")[0].disabled = true;
				}
			}