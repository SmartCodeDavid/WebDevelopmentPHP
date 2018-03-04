$(document).ready(function(){
	
	//focus on first name
	$("#firstname").focus();
	
	//when mouse enter navigation then change the color
	$("div#div_Navigation a").mouseenter(function() {
		$(this).css("color", "red");
	});
	
	$("div#div_Navigation a").mouseleave(function() {
		$(this).css("color", "white");
	});
	
	$("#reset").click(function(){
		for(var i = 0; i < $(":input").length; i++) {
			if($(":input")[i].type == "text" || $(":input")[i].type == "email" ){
				$(":input")[i].value = "";
			} else if($(":input")[i].value == "male" || $(":input")[i].value == "ACT"){
				$(":input")[i].checked = true;
			} else {
				continue;
			}
		}
	});
});