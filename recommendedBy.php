

<?php
	$con=mysqli_connect("classroom.cs.unc.edu","gpwclark","brennan5?@?@","gpwclarkdb");
	
	$submitter = $_POST['submitter'];
	
	$sqlName= mysqli_query($con,"Select first,email From Users Where first = '".$submitter."'" );

    while($row = mysqli_fetch_array($sqlName)){
                   $submitter= $row['email'];

            }
	
	
	
	
	$sql4="SELECT UserId,email FROM Users WHERE email = '".$submitter."'";
			
	$submitterIdQuery = mysqli_query($con,$sql4);
	while($row = mysqli_fetch_array($submitterIdQuery )){
		if( $row['email'] == $submitter ){
			$submitterId = $row['UserId'];

		}
	}
	
	$multiDimensionalArray = array();
	
	$sql5="SELECT * FROM Transactions AS T, Music AS M, Recommendation as R, Users AS U WHERE U.UserId=T.submitterId and T.transactionId=M.transactionId and M.musicId = R.musicId and T.submitterId= '".$submitterId."' ORDER BY T.date ASC";
	$xactIdQuery = mysqli_query($con,$sql5);
	
	//$dataPoints[] = array("x"=>$resp['friends_count'],"y"=>$resp ['statuses_count']);
	
	while($row = mysqli_fetch_array($xactIdQuery)){

		$multiDimensionalArray[] =  array("first"=>$row['first'],"last"=>$row['last'],"artist"=>$row['artist'],"recommendationText"=>$row['recommendationText'],"albumTrack"=>$row['albumTrack'],,"coverURL"=>$row['coverURL'],"sourceURL"=>$row['sourceURL'],"type"=>$row['type']);
		 
	}
	
	echo json_encode($multiDimensionalArray);

?>
