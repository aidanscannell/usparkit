function slideOpen(el){
	var elem = document.getElementById(el);
	elem.style.transition = "height 0.2s linear 0s";
	elem.style.height = "200px";
}
function slideClosed(el){
	var elem = document.getElementById(el);
	elem.style.transition = "height 0.2s linear 0s";
	elem.style.height = "0px";
}
function slideIn(el){
	var elem = document.getElementById(el);
	elem.style.transition = "left 0.5s ease-in 0s";
	elem.style.left = "0px";
}
function slideOut(el){
	var elem = document.getElementById(el);
	elem.style.transition = "left 0.5s ease-out 0s";
	elem.style.left = "-400px";
}