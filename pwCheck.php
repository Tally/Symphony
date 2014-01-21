<?php



			
			
session_start();

function check_password($username, $password) {

  	
			$con=mysqli_connect("classroom.cs.unc.edu","gpwclark","brennan5?@?@","gpwclarkdb");
			$sql="SELECT password,UserId FROM Users WHERE email = '".$username."'";
			
			$result = mysqli_query($con,$sql);

			while($row = mysqli_fetch_array($result)){
				if( $row['password'] == $password ){
					return true;
				}else{
				    return false;
				}
			}
			mysqli_close($con);	
}

		$username = $_POST['username'];
		$password = $_POST['password'];

		if (check_password($username,$password)) {
		  header('Content-type: application/json');

		  // Generate authorization cookie
		  $_SESSION['username'] = $username;
		  $_SESSION['authsalt'] = time();

//		  $auth_cookie_val = md5($_SESSION['username'] . $_SERVER['REMOTE_ADDR'] . $_SESSION['authsalt']);
//		$auth_cookie_val = 1234567890;
//		  setcookie('LEC24AUTH', $auth_cookie_val, 0, '/Courses/comp426-f13/gpwclark/final/success.php', 'wwwp.cs.unc.edu', true);
		setcookie('SYMPHONY', $username ,'/Courses/comp426-f13/gpwclark/final/symphony.php','wwwp.cs.unc.edu' ,time()+86400*7);
		  
		  print(json_encode(true));

		} else {
		  unset($_SESSION['username']);
		  unset($_SESSION['authsalt']);

		  header('HTTP/1.1 401 Unauthorized');
		  header('Content-type: application/json');
		  print(json_encode(false));
}

?>