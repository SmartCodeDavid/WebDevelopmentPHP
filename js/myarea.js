$(document).ready(function(){
	//when mouse enter navigation then change the color
	$("div#div_Navigation a").mouseenter(function() {
		$(this).css("color", "red");
	});
	
	$("div#div_Navigation a").mouseleave(function() {
		$(this).css("color", "white");
	});
});


window.onload = function(){
	var o_username = document.getElementsByName("username")[0];
	var o_password = document.getElementsByName("password")[0];
	var o_submit = document.getElementsByName("submit")[0];
	
	//add an event for textarea username and password
	o_username.onchange = inputChange;
	o_username.onkeyup = inputChange;
	o_password.onchange = inputChange;
	o_password.onkeyup = inputChange;
	
	//when both username and password are not empty then the log in button can be pressed
	function inputChange(){ 
		if(o_username.value != "" && o_password.value != ""){
			o_submit.disabled = false;
		}else{
			o_submit.disabled = true;
		}
		
	};
}