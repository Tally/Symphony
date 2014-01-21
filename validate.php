var email =[ <?php echo $_POST['username']; ?> ];
alert(email);

<!DOCTYPE html>
<html lang="en"  style="background: url(logoHeadphones.gif) no-repeat center center fixed;background-size: cover;">
<head>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<style>
		#container {
			margin: 0 auto;
			width: 400px;
			position:absolute;
			left:30%;
			top:0%;
			color:white;
		}
		body {
			font-color:white;
		}

	</style>

	<script>
		$(document).ready(function() {		
				var json = {
					"transactionId":1000,
					"submitterId":0,
					"submitteeId":1111111111,
					"musicId":2000,
					"date":"2013-12-08 10:48:34",
					"artist":"Electric Guest",
					"recommendationText":"Super awesome electric pop band",
					"album/track":"Mondo",
					"coverURL":"http://www.coolURL.com/coverURL/",
					"sourceURL":"http://www.coolURL.com/sourceURL/",
					"type":"A",
					"tagID":3000,
					"tag":"coolJamz"
					}
	</script>
</head>
<body>
	<div id="container">
	<p id="paragraph">
 
		<form id="formTest1" action="recommendedBy.php" method="post">
		submitter: <input type="text" name="submitter"><br>
		<input type="submit">
		</form>
		
		<form id="formTest2" action="recommendedTo.php" method="post">
		submittee: <input type="text" name="submittee"><br>
		<input type="submit">
		</form>
		
		
		<script>
		var form=$('#formTest');
	   $('input[name=artist]',form).val('Modest Mouse');
	   $('input[name=recommendationText]',form).val('love these guys');
	   $('input[name=albumTrack]',form).val('Good News for People Who Like Bad News');
	   $('input[name=coverURL]',form).val('www.word.com');
	   $('input[name=sourceURL]',form).val('www.wordy.com');
	   $('input[name=type]',form).val('A');
	   

	 </script> 
	 
		<?php 
			date_default_timezone_set('America/New_York');
		
			$q = $_POST['username'];
			$con=mysqli_connect("classroom.cs.unc.edu","gpwclark","brennan5?@?@","gpwclarkdb");
			$sql="SELECT password,UserId FROM Users WHERE email = '".$q."'";
			
			$result = mysqli_query($con,$sql);

			while($row = mysqli_fetch_array($result)){
				if( $row['password'] == $_POST['password'] ){
					echo "success";
				}else{
				    echo "failure";
				}
			}
			mysqli_close($con);	
		  ?>
	</p>
	</div>
</body>
</html>