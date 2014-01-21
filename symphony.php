<?php
	if (!isset($_COOKIE['SYMPHONY'])) {} else {

		$con=mysqli_connect("classroom.cs.unc.edu","gpwclark","brennan5?@?@","gpwclarkdb");
		$sqlName= mysqli_query($con,"Select first,last,email From Users Where email = '".$_COOKIE['SYMPHONY']."'" );

		$firstName = "Who TF";
		$lastName = "are you?!";
		while($row = mysqli_fetch_array($sqlName)){
		$firstName =  $row['first'];
		$lastName =  $row['last'];
		}
	}
?>
<!DOCTYPE html>
	<head>
	<title>Symphony</title>
	<link rel='stylesheet' type='text/css' href='symphony.css'>
	<link href='http://fonts.googleapis.com/css?family=Allan:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Signika+Negative:400,600,700' rel='stylesheet' type='text/css'>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='symphony.js.php'></script>
	</head>
	<body>
	<div id='wrapper'>
		<div id='titlebar'>
		<h1>Symphony</h1>
		</div>
	<div id='userpanel'>
		<div id='usernamecontainer'>
			<span id='sass'>In case you forgot, you're:</span><br>
			<span id='username'><?php echo $firstName;?><br><?php echo $lastName;?></span>
		</div>
		<div id='ownlast3'>
			<h4>Recently Submitted</h4>
			<table id='submissions'><tr>
				<td></td>
				<td></td>
				<td></td>
				</tr>
			</table>
			<button id='submitnew'>Suggest an Album</button>
		</div>
			<div id='controls'>
				<h5> Symphonic Friends </h5>
				<ul id='friendlist'>
				</ul>
				<button id='showhidewell'>Show/Hide Well</button>
		</div>
	</div>
	<div id='contentpanel'>
		<div id='top3'>	
			<div class='recommendationtitle' id='top3title'>Your Top 3 Recommendations</div>
			<div id='top3summary'></div>
			<div id='top3details'>
				<table>
					<thead><tr>
						<td colspan='2' class='recommenderCell'></td>
					</tr></thead>
					<tbody><tr>
						<td rowspan='5' class='coverCell'></td>
						<td class='titleCell'></td>
					</tr><tr>
						<td class='linkCell'></td>
					</tr><tr>
						<td class='reviewCell'></td>
					</tr><tr>
						<td class='tagCell'>Tags?</td>
					</tr><tr>
						<td class='buttonCell'><button type='button' class='backbutton'><em>Back</em></button></td>
					</tr></tbody>
				</table>
			</div>
			<div id='submissionform'>
				<form id='albumform'>
					<table>
						<tr>
							<td>
								<input type='hidden' name='email'>
								<select name='type'>
									<option value='a'>Album</option>
									<option value='t'>Track</option>
								</select>
								<input type='text' name='albumTrack' value='Title'></td>
							<td>by <input type='text' name='artist'value='Artist'></td>
						</tr><tr>
							<td><input type='text' name='coverURL' value='Cover URL'></td>
							<td><input type='text' name='sourceURL' value='Link URL'></td>
						</tr><tr>
							<td colspan='2'><textarea name='recommendationText'>Reason for recommending</textarea></td>
						</tr><tr>	
							<td colspan='2'><input type='text' name='tag' value='Tags'></td>
						</tr><tr>
							<td><input type='text' name='firstName' value='Recommendee'></td>
							<td><input type='submit' id='submitconfirm'><button type='button' id='submitcancel'>Cancel</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div id='next5' class='wellshown'>
			<div class='recommendationtitle' id='next5title'>More Recommendations</div>
			<div id='next5summary'><table><tr>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
			</tr></table></div>
			<div id='next5controls'><span class='prev5control'>&lt;</span><span class='next5control'>&gt;</span></div>
		</div>
		<div id='dynamicwell'>
			<div class='recommendationtitle' id='welltitle'>Past Music Recommended</div>
			<div id='wellcontents'><table><tr>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
				<td class='coverCell'></td>
				<td class='detailCell'></td>
			</tr></table></div>
			<div id='wellcontrols'><span class='prev5control'>&lt;</span><span class='next5control'>&gt;</span></div>
		</div>
	</div>
	</body>
</html>