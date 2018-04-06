console.log("Hello Ralph");

var div = document.createElement('div');
div.innerHTML = "Hello Gideon";
div.className = "text";
div.id        = "divId";

var clickButton = document.getElementById("clickButton");
clickButton.addEventListener("click", function() {
	var newDiv = prompt("Input");

	console.log("click");
	var div = document.createElement('div');
	div.innerHTML = newDiv;
	div.className = "text";
	div.id        = "divId";
	document.body.appendChild(div);
});