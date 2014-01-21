<html>
<head>
</head>
<body>

<?php
	//need to get jquery posting data to PHP, from there, we need to make sure PHP can successfully puy
	//it into the server, then we need the server to request information and output it as a JSON OBject
	//last on the list, validate the login page.

	date_default_timezone_set('America/New_York');
	
	$month = (string)date('m');
	$day = (string)date('d');
	$hour = (string)date('H');
	$i = (string)date('i');
	$second = (string)date('s');
	$idBase= '0' .  $month .  $day . $hour . $i . $second;
	
	$musicId = '1' . $idBase ;
	$transactionId = '2' . $idBase;
	$recommendationId = '3' .$idBase;
	$tagId = '4' . $idBase;
	
	$artist = $_POST["artist"];                                 //MUST BE EXACT NAMES OF FIELDS IN SUBMISSION FORM
	$recommendationText = $_POST["recommendationText"];
	$albumTrack = $_POST["albumTrack"];
	$coverURL = $_POST["coverURL"];
	$sourceURL = $_POST["sourceURL"];
	$type = $_POST["type"];
	$tag = $_POST["tag"];
	
	$userEmail = $_POST["email"];
	$targetName = $_POST["firstName"];
	
			$con=mysqli_connect("classroom.cs.unc.edu","gpwclark","brennan5?@?@","gpwclarkdb");
		/*	
			$sqlName= mysqli_query($con,"Select first,last From Users Where email = '".$userEmail."' )" );
				while($row = mysqli_fetch_array($sqlName )){
				if( $row['email'] == $userEmail ){
					$firstName = $row['first'];
					$lastName = $row['last'];
				}
			}
			
			*/
			
			$sql1= mysqli_query($con,"INSERT INTO Music (musicId,transactionId,artist,recommendationText) values('".$musicId."','".$transactionId."','".$artist."','".$recommendationText."')" );
			
			
			$sql2=mysqli_query($con,"INSERT INTO Recommendation (recommendationId,musicId,albumTrack,coverURL,sourceURL,type) values('".$recommendationId."','".$musicId."','".$albumTrack."','".$coverURL."','".$sourceURL."','".$type."')" );
			
			
			$sql3= mysqli_query($con, "INSERT INTO Tags (tagId,musicId,tag) values('".$tagId."','".$musicId."','".$tag."')" );
			// $sqlTEST= mysqli_query($con, "INSERT INTO Test2 (id,textField) values('".$id."','".$text."')" );
	

	
			$sql4="SELECT UserId,email FROM Users WHERE email = '".$userEmail."'";
			
			$submitterIdQuery = mysqli_query($con,$sql4);
			while($row = mysqli_fetch_array($submitterIdQuery )){
				if( $row['email'] == $userEmail ){
					$submitterId = $row['UserId'];

				}
			}
			
			$sql5="SELECT UserId,first FROM Users WHERE first = '".$targetName."'";
			
			$submitteeIdQuery =  mysqli_query($con,$sql5);
			while($row = mysqli_fetch_array($submitteeIdQuery)){
				if( $row['first'] == $targetName ){
					$submitteeId = $row['UserId'];

				}
			}
			
		//	$sqlTEST = mysqli_query($con, "INSERT INTO Music (musicId,transactionId,artist,recommendationText) values('".$id."','".$id."','".$text."','".$text."')" );
			$sql= mysqli_query($con,"INSERT INTO Transactions (transactionId,submitterId,submitteeId,date) values('".$transactionId."','".$submitterId."','".$submitteeId."','".$idBase."')" );

			
			mysqli_close($con);
	

?>


</body>
</html>