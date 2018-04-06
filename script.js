$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });


  return false;

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
})

