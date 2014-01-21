

<?php
	$con=mysqli_connect("classroom.cs.unc.edu","gpwclark","brennan5?@?@","gpwclarkdb");
	
	$submittee = $_POST['submittee'];

	$sql4="SELECT UserId,email FROM Users WHERE email = '".$submittee."'";
			
	$submitteeIdQuery = mysqli_query($con,$sql4);
	while($row = mysqli_fetch_array($submitteeIdQuery )){
		if( $row['email'] == $submittee ){
			$submitteeId = $row['UserId'];

		}
	}
	

	$multiDimensionalArray = array();
	
	
	$sql5="SELECT * FROM Transactions AS T, Music AS M, Recommendation as R, Users AS U WHERE U.UserId=T.submitteeId and T.transactionId=M.transactionId and M.musicId = R.musicId and T.submitteeId= '".$submitteeId."' ORDER BY T.date ASC";
	$xactIdQuery = mysqli_query($con,$sql5);
	while($row = mysqli_fetch_array($xactIdQuery)){
		
		$multiDimensionalArray[] =  array("first"=>$row['first'],"last"=>$row['last'],"artist"=>$row['artist'],"recommendationText"=>$row['recommendationText'],"albumTrack"=>$row['albumTrack'],,"coverURL"=>$row['coverURL'],"sourceURL"=>$row['sourceURL'],"type"=>$row['type']);

	}
	echo $multiDimensionalArray[0]['artist'];
	echo json_encode($multiDimensionalArray);


?>

