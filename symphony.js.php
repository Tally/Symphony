var nextOffset = 0;
var nextMoreAlbums = true;
var nextPrevAlbums = false;
var wellOffset = 0;
var wellMoreAlbums = true;
var wellPrevAlbums = false;

var phpUsername = "lassitet@live.unc.edu";

var albumFiller = ["Tally", "Lassiter", "Le Artiste", "YTF not, eh?", "Al the Bum", "album-filler.png", "http://www.youtube.com/watch?v=dQw4w9WgXcQ"]

var recommendations =  new Array();
var ownAlbums = new Array();
var userPool = new Array();

recommendations[0] = ["0RecommenderFirst", "1RecommenderLast", "2Artist", "3RecommendationText", "4Title", "5url://of.the.image/", "6url://of.a.listening.source", "7Type"];
ownAlbums[0] = recommendations[0];

var friends = ["Price Clark", "Tally Lassiter", "Zach Stamper", "Nick Mortenson", "Grace Thompson"];

var friendUsername = new Array();
friendUsername["Price Clark"] = "gpwclark@gmail.com";
friendUsername["Tally Lassiter"] = "lassitet@live.unc.edu";
friendUsername["Zach Stamper"] = "zstamper@live.unc.edu";
friendUsername["Nick Mortenson"] = "mortnick@email.unc.edu";
friendUsername["Grace Thompson"] = "gracert1@email.unc.edu";

var wellAlbums = new Array();

$(document).ready(function() {
	$("#top3details").hide();
	$("#submissionform").hide();
	
	//paintUser();
	paintTop3();
	paintNext5();
	paintRecent();
	paintFriends();
	
	$("[name=email]").val(phpUsername);
	
	$("#submitnew").click(function() {showSubmissionForm()});
	$("#submitcancel").click(function() {cancelSubmissionForm()});
	$("#next5 .next5control").click(function() {next5Suggestions()});
	$("#next5 .prev5control").click(function() {prev5Suggestions()});
	$("#dynamicwell .next5control").click(function() {next5Well()});
	$("#dynamicwell .prev5control").click(function() {prev5Well()});
	$("#showhidewell").click(function() {
		$("#dynamicwell").toggle();
		$("#next5").toggleClass("wellshown wellhidden");
	});
	$("#albumform").submit(function() {
		formdata = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "http://wwwp.cs.unc.edu/Courses/comp426-f13/gpwclark/final/submission.php",
			data: formdata
		});
		alert("Suggestion submitted, thanks.");
		cancelSubmissionForm();
		return false;
	});
});

function storeRecommendations(data,array) {
	for (i=1; i<data.length; i++) {
		array[i] = [data[i-1].first,data[i-1].last,data[i-1].artist,data[i-1].recommendationText,data[i-1].albumTrack,data[i-1].coverURL,data[i-1].sourceURL,data[i-1].type];
	}
}

//Control Painters
function paintUser () {
	$("#username").html(userFirst+"<br>"+userLast);
	$("input [name=submitter]").val(userFirst+" "+userLast);
}

function paintRecent() {
	$.post("http://wwwp.cs.unc.edu/Courses/comp426-f13/gpwclark/final/recommendedBy.php", {submitter: phpUsername}, function(data) {
		parsedData = $.parseJSON(data);
		for (i=0; parsedData[i]!=null; i++) {
			ownAlbums[i+1] = [parsedData[i].first,parsedData[i].last,parsedData[i].artist,parsedData[i].recommendationText,parsedData[i].albumTrack,parsedData[i].coverURL,parsedData[i].sourceURL,parsedData[i].type];
		}
		$("#submissions td:first").html("<img alt='"+ownAlbums[1][4]+"' src='"+ownAlbums[1][5]+"'>").next().html("<img alt='"+ownAlbums[2][4]+"' src='"+ownAlbums[2][5]+"'>").next().html("<img alt='"+ownAlbums[3][4]+"' src='"+ownAlbums[3][5]+"'>");
	});
}

function paintFriends() {
	for (i=0; i<friends.length; i++) {
		$("#friendlist").append("<li><a>"+friends[i]+"</a></li>");
	}
	$("#friendlist li").click(function() {wellSelect($(this).text())});
}

//Content Painters
function paintTop3() {
	$.post("http://wwwp.cs.unc.edu/Courses/comp426-f13/gpwclark/final/recommendedTo.php", {submittee: phpUsername}, function(data) {
		parsedData = $.parseJSON(data);
		for (i=0; parsedData[i]!=null; i++) {
			recommendations[i+1] = [parsedData[i].first,parsedData[i].last,parsedData[i].artist,parsedData[i].recommendationText,parsedData[i].albumTrack,parsedData[i].coverURL,parsedData[i].sourceURL,parsedData[i].type];
		}
		
		recommendations[1] == null ? album1HTML = "" : album1HTML = "<img alt='"+recommendations[1][4]+"' src='"+recommendations[1][5]+"'><br><em><strong>"+recommendations[1][4]+"</strong></em>";
		recommendations[2] == null ? album1HTML = "" : album2HTML = "<img alt='"+recommendations[2][4]+"' src='"+recommendations[2][5]+"'><br><em><strong>"+recommendations[2][4]+"</strong></em>";
		recommendations[2] == null ? album1HTML = "" : album3HTML = "<img alt='"+recommendations[3][4]+"' src='"+recommendations[3][5]+"'><br><em><strong>"+recommendations[3][4]+"</strong></em>";
		

		
		$("#top3summary").html("<table><tr><td id='no1' class='mainAlbums'>"+album1HTML+"</td><td id='no2' class='mainAlbums'>"+album2HTML+"</td><td id='no3' class='mainAlbums'>"+album3HTML+"</td></tr></table>");
		$(".mainAlbums").click(function() {expandTop3Details($(this).index()+1)});
	});
}

function paintNext5() {
	$.post("http://wwwp.cs.unc.edu/Courses/comp426-f13/gpwclark/final/recommendedTo.php", {submittee: phpUsername}, function(data) {
		parsedData = $.parseJSON(data);
		for (i=3; parsedData[i]!=null; i++) {
			recommendations[i+1] = [parsedData[i].first,parsedData[i].last,parsedData[i].artist,parsedData[i].recommendationText,parsedData[i].albumTrack,parsedData[i].coverURL,parsedData[i].sourceURL,parsedData[i].type];
		}
		currOffset = nextOffset + 4;
	
		currCell = $("#next5 td:first");
		$("#next5 td").empty();
		for (i = 0; i<5; i++) {
			if (recommendations[currOffset] == null) {
			nextMoreAlbums = false;
			break;
			}
			currCell.html("<img alt='"+recommendations[currOffset][4]+"' src='"+recommendations[currOffset][5]+"'>").next().html("<strong><em>"+recommendations[currOffset][4]+"</em><br>"+recommendations[currOffset][2]+"</strong><br><a href='"+recommendations[currOffset][6]+"'>Listen</a>").hide();
			currCell = currCell.next().next();
			currOffset++;
		}

		$("#next5 img").click(function() {
			$(this).parent().toggleClass("selected").next().toggle().toggleClass("selected");
		});
	});
}

//Dynamic Painters
function expandTop3Details(albumNo) {
	$("#top3summary").toggle();
	album = recommendations[albumNo];
	
	if (album[7] == "a") albumTypeText = "album";
	else if (album[7] == "t") albumTypeText = "track";
	else albumTypeText = "";

	if (album[6] != null) sourceLinkText = "<a href='"+album[6]+"'>Listen Here</a>";
	else sourceLinkText = "";
	
	$("#top3details .recommenderCell").html(album[0]+" "+album[1]+" recommends this "+albumTypeText);
	$("#top3details .coverCell").html("<img alt='"+album[4]+"' src='"+album[5]+"'>");
	$("#top3details .titleCell").html("<em><strong>"+album[2]+"</strong></em> by "+album[4]);
	$("#top3details .linkCell").html(sourceLinkText);
	$("#top3details .reviewCell").html("<br>\""+album[3]+"\"");
	
	$("#top3details").show();
	$(".backbutton").click(function() {minimizeTop3Details()});
}

function minimizeTop3Details() {
	$("#top3details").hide();
	$("#top3summary").show();
}

function showSubmissionForm() {
	$("#top3summary, #top3details, #top3title").hide();
	$("#submissionform [name=albumTrack]").val("Title");
	$("#submissionform [name=artist]").val("Artist");
	$("#submissionform [name=coverURL]").val("Image URL");
	$("#submissionform [name=sourceURL]").val("Source URL");
	$("#submissionform [name=recommendationText]").text("Reason for recommending");
	$("#submissionform [name=tag]").val("Tags, Comma-separated (e.g. Dark, Dancy, Hip Hop)");
	$("#submissionform [name=firstName]").val("Recommendee(s)");
	$("#submissionform").show();
}

function cancelSubmissionForm() {
	$("#top3summary, #top3title").show();
	$("#submissionform").hide();
}

function expandOrCloseNext5(index) {
	currIndex = index;
	$("."+currIndex+".detailCell").toggle();
	alert("."+currIndex+".detailCell");
}

function populateWell() {
$.post("http://wwwp.cs.unc.edu/Courses/comp426-f13/gpwclark/final/recommendedBy.php", {submitter: friendUsername[wellSelector]}, function(data) {
		if (friendUsername[wellSelector] == null) return;
		parsedData = $.parseJSON(data);
		userPool = [];
		for (i=0; parsedData[i]!=null; i++) {
			userPool[i+1] = [parsedData[i].first,parsedData[i].last,parsedData[i].artist,parsedData[i].recommendationText,parsedData[i].albumTrack,parsedData[i].coverURL,parsedData[i].sourceURL,parsedData[i].type];
		}
		tempWellOffset = wellOffset;
		$("#dynamicwell td").empty();
		$("#welltitle").text("Music Recommended by "+wellSelector);
	
		currCell = $("#dynamicwell td:first");
		for (i = 1; i<=5; i++) {
			tempWellOffset++;
			if (userPool[tempWellOffset] == null) {
			wellMoreAlbums = false;
			break;
			}
			currCell.html("<img alt='"+userPool[tempWellOffset][4]+"' src='"+userPool[tempWellOffset][5]+"'>").next().html("<strong><em>"+userPool[tempWellOffset][4]+"</em><br>"+userPool[tempWellOffset][2]+"</strong><br><a href='"+userPool[tempWellOffset][6]+"'>Listen</a>").hide();
			currCell = currCell.next().next();
		}
	
		$("#dynamicwell img").click(function() {
			$(this).parent().toggleClass("selected").next().toggle().toggleClass("selected");
		});
	});
}

//Controls
function next5Suggestions() {
	if (!nextMoreAlbums) return;
	nextPrevAlbums = true;
	nextOffset += 5;
	paintNext5();
}

function prev5Suggestions() {
	if (!nextPrevAlbums) return;
	nextOffset -= 5;
	nextMoreAlbums = true;
	if (nextOffset == 0) nextPrevAlbums = false;
	paintNext5();
}

function next5Well() {
	if (!wellMoreAlbums) return;
	wellPrevAlbums = true;
	wellOffset += 5;
	populateWell();
}

function prev5Well() {
	if (!wellPrevAlbums) return;
	wellOffset -= 5;
	wellMoreAlbums = true;
	if (wellOffset == 0) wellPrevAlbums = false;
	populateWell();
}

function wellSelect(selectee) {
	wellSelector = selectee;
	wellOffset = 0;
	wellMoreAlbums = true;
	wellPrevAlbums = false;
	populateWell();
}