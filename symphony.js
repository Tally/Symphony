var nextOffset = 0;

var recommendations =  new Array();
recommendations[0] = ["0RecommenderFirst", "1RecommenderLast", "2Artist", "3RecommendationText", "4Title", "5url://of.the.image/", "6url://of.a.listening.source", "7Type"];
recommendations[1] = ["Price", "Clark", "The Velvet Underground & Nico", "Pretty solid if you haven't - must listen", "The Velvet Underground", "cover1.jpg", "http://www.youtube.com/watch?v=dQw4w9WgXcQ", "a"];
recommendations[2] = ["Price", "Clark", "Most Wanted", "Most Wanted I think is their best", "The Cults", "cover2.jpg", "http://www.youtube.com/watch?v=dQw4w9WgXcQ", "a"];
recommendations[3] = ["Price", "Clark", "Lightning", "Music video to Let's go is them in bed. 'Nuff said.", "Matt and Kim", "cover3.jpg", "http://www.youtube.com/watch?v=dQw4w9WgXcQ", "a"];
recommendations[4] = ["Price", "Clark", "Caravan Palace", "uhhhm", "Caravan Palace", "cover4.jpg", "http://www.youtube.com/watch?v=dQw4w9WgXcQ", "a"];
recommendations[5] = ["Price", "Clark", "Hotel Paper", "well. . . uhhh.", "Michelle Branch", "cover5.jpg", "http://www.youtube.com/watch?v=dQw4w9WgXcQ", "a"];
recommendations[6] = ["Price", "Clark", "Kinks", "it's good I guess", "Kinks", "cover6.jpg"];
recommendations[7] = ["Price", "Clark", "Alt-J", "oh yeah", "Alt-J", "cover7.jpg"];
recommendations[8] = ["Price", "Clark", "Quebec", "awesome", "Ween", "cover8.jpg"];

var ownRecommendations =  new Array();
ownRecommendations[0] = [];
ownRecommendations[1] = [];
ownRecommendations[2] = [];
ownRecommendations[3] = [];
ownRecommendations[4] = [];

var friends = ["George Clark", "Tally Lassiter", "Zach Stamper", "Nick Mortenson", "Grace Thompson"];

$(document).ready(function() {
	$("#top3details").hide();
	$("#submissionform").hide();
	
	paintFriends();
	paintTop3();
	paintNext5();
	
	$(".mainAlbums").click(function() {expandTop3Details($(this).index()+1)});
	$("#submitnew").click(function() {showSubmissionForm()});
	$("#submitcancel").click(function() {cancelSubmissionForm()});
});

//Control Painters
function paintFriends() {
	for (i=0; i<friends.length; i++) {
		$("#friendlist").append("<li><a>"+friends[i]+"</a></li>");
	}
}

//Content Painters
function paintTop3() {
	$("#top3summary").html("<table><tr><td id='no1' class='mainAlbums'><img alt='"+recommendations[1][4]+"' src='"+recommendations[1][5]+"'><br><em><strong>"+recommendations[1][4]+"</strong></em></td><td id='no2' class='mainAlbums'><img alt='"+recommendations[2][4]+"' src='"+recommendations[2][5]+"'><br><em><strong>"+recommendations[2][4]+"</strong></em></td><td id='no3' class='mainAlbums'><img alt='"+recommendations[3][4]+"' src='"+recommendations[3][5]+"'><br><em><strong>"+recommendations[3][4]+"</strong></em></td></tr></table>");
}

function paintNext5() {
	var nextHTML = "";
	var currOffset = nextOffset + 4;
	for (var i = 0; i<5; i++) {
		nextHTML = nextHTML + "<td id='"+currOffset+"'><img alt='"+recommendations[currOffset][4]+"' src='"+recommendations[currOffset][5]+"'></td>"
		currOffset++;
	}
	$("#next5summary table").append(nextHTML);
	$("#next5 img").click(function() {expandNext5(this)});
}

//Dynamic Painters
function expandTop3Details(albumNo) {
	$("#top3summary").toggle();
	var album = recommendations[albumNo];
	
	var albumTypeText;
	if (album[7] == "a") albumTypeText = "album";
	else if (album[7] == "t") albumTypeText = "track";
	else albumTypeText = "";

	var sourceLinkText;
	if (album[6] != null) sourceLinkText = "<a href='"+album[6]+"'>Listen Here</a>";
	else sourceLinkText = "";
	
	$("#top3details").html("<tr><td colspan='2'>"+album[0]+" "+album[1]+" recommends this "+albumTypeText+"</td></tr><tr><td rowspan='5'><img alt='"+album[4]+"' src='"+album[5]+"'></td><td><strong>"+album[4]+"</strong> by "+album[2]+"</td></tr><tr><td>"+sourceLinkText+"</td></tr><tr><td>\""+album[3]+"\"</td></tr><tr><td>Tags?</td></tr><tr><td><button type='button' class='backbutton'><em>Back</em></button></td></tr>").toggle();
	$(".backbutton").click(function() {minimizeTop3Details()});
}

function minimizeTop3Details() {
	$("#top3details").toggle();
	$("#top3summary").toggle();
}

function showSubmissionForm() {
	$("#top3summary, #top3details, #top3title").hide();
	$("#submissionform [name=title]").val("Title");
	$("#submissionform [name=artist]").val("Artist");
	$("#submissionform [name=imagesource]").val("Image URL");
	$("#submissionform [name=sourcelink]").val("Source URL");
	$("#submissionform [name=review]").val("Reason for recommending");
	$("#submissionform [name=tags]").val("Tags, Comma-separated (e.g. Dark, Dancy, Hip Hop)");
	$("#submissionform [name=recommendees]").val("To Whom You Are Recommending");
	$("#submissionform").show();
}

function cancelSubmissionForm() {
	$("#top3summary, #top3title").show();
	$("#submissionform").hide();
}

function expandNext5(album) {
	//var currIndex = $(album).parent().attr(id);
	alert($(album).html());
}