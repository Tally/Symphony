$(document).ready(function () {

    $('#login_form').on('submit', function (e) {
	e.stopPropagation();
	e.preventDefault();
	$.ajax('pwCheck.php',
	       {type: 'POST',
		data: $('#login_form').serialize(),
		cache: false,
		success: function () {
		    alert('Login Successful'); 
			window.location.replace("http://wwwp.cs.unc.edu/Courses/comp426-f13/lassitet/final/symphony.php");
			},
			
			
		error: function () {
		    alert('Login Failed');}
	       });
    });
	
 });	
