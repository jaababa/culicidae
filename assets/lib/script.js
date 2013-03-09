$(function() {
	
var popup = false;

$("#button").click(function(){
	if(popup == false){
		$("#overlayEffect").fadeIn("slow");
		$("#popupContainer").fadeIn("slow");
		$("#close").fadeIn("slow");
	    center();
		popup = true;
	}	
	});
$("#legend").click(function(){
	if(popup == false){
		$("#legendcontainer").fadeIn("slow");
		$("#closed").fadeIn("slow");
	    center();
		popup = true;
	}	
	});
	$("#closed").click(function(){
		hidePopup();
	});
	$("#close").click(function(){
		hidePopup();
	});
	
	$("#overlayEffect").click(function(){
		hidePopup();
	});
	
function center(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContainer").height();
	var popupWidth = $("#popupContainer").width();
	$("#popupContainer").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});$("#legendcontainer").css({
		"position": "fixed",
	});
	
	}
function hidePopup(){
	if(popup==true){
		$("#overlayEffect").fadeOut("slow");
		$("#popupContainer").fadeOut("slow");
		$("#legendcontainer").fadeOut("slow");
		$("#close").fadeOut("slow");
		popup = false;
	}
}

} ,jQuery);


