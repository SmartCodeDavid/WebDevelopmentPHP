var sec = 0;
var min = 0;
var hour = 0;

$(document).ready(function(){
	//set the date and time
	var date = new Date();
	$("#c_date").text("Current date is : " + date.toLocaleDateString());
	timeCount();
	
	//initialise image and detail about teacher
	$("div#div_teacher p").hide();
	$("#img2").parent().css({
		"border":"3px blue solid"
	});
	$("#p2").fadeIn();
	
	//when mouse enter navigation then change the color
	$("div#div_Navigation a").mouseenter(function() {
		$(this).css("color", "red");
	});
	
	$("div#div_Navigation a").mouseleave(function() {
		$(this).css("color", "white");
	});

	//create the click event for images
	$("div.img img").click(function() {
		$(".img").css({
			"border" : "1px solid #cccccc"
		});
		
		$(this).parent().css({
			"border":"3px blue solid"
		});
	
		$("div#div_teacher p").hide();
		
		switch($(this).attr("id")) {
			case "img1": $("#p1").fadeIn(500); break;
			case "img2": $("#p2").fadeIn(500); break;
			case "img3": $("#p3").fadeIn(500); break;
		}
		
	});
	
});

function timeCount(){
	sec += 1;
	if((sec / 60) == 1) { 
		min++;
		sec = 0;
	}
	if((min / 60) == 1) {
		hour++;
		min = 0;
	}
	$("#c_time").text("Time as the home page is loaded: " + hour.toString() + ": " + min.toString() + ": " + sec.toString());
	t = setTimeout("timeCount()", 1000);
}