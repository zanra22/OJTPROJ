console.log("Hello World");

var div = document.createElement('div');
div.innerHTML = "hello Gideon";
div.className = "divClass";
div.id        = "divId";
// document.body.appendChild(div);


var clickButton = document.getElementById("clickButton");
clickButton.addEventListener("click", function() {
	console.log("click");
	var contentDiv = document.getElementById("insertContentHere");
contentDiv.appendChild(div);
});

// alert("hello there");

// var input = parseInt(prompt("input1"));
// var input2 = parseInt(prompt("input2"));

// var result = input + input2;
// alert(result);