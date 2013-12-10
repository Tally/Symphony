var nextOffset = 0;
var nextMoreAlbums = true;
var nextPrevAlbums = false;
var wellOffset = 0;
var wellMoreAlbums = true;
var wellPrevAlbums = false;

var userFirst = "Prally";
var userLast = "Lassark";
var wellSelector = userFirst+" "+userLast;

var albumFiller = ["Tally", "Lassiter", "Le Artiste", "YTF not, eh?", "Al the Bum", "album-filler.png", "http://www.youtube.com/watch?v=dQw4w9WgXcQ"]

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

for(var i=9;i<15;i++){recommendations[i]=["Tally", "Lassiter", "Le Artiste", "YTF not, eh?", "Al the Bum("+i+")", "album-filler.png", "http://www.youtube.com/watch?v=dQw4w9WgXcQ"]};

var zachAlbums = new Array();
var nickAlbums = new Array();
var graceAlbums = new Array();
var ownAlbums =  new Array();
ownAlbums[1] = ["Prally", "Lassark", "Nirvana", "They totally understand me, man.", "In Utero", "nirvana.jpg", "zombo.com"];
ownAlbums[2] = ["Prally", "Lassark", "The Tins", "Kick The Aluminums' ass.", "Alboom", "tins.jpg", "rekall.tumblr.com"];
ownAlbums[3] = ["Prally", "Lassark", "LCD Soundsystem", "They're musical", "Album", "lcd.jpg", "explosionsandboobs.com"];

var friends = ["Prally Lassark", "Price Clark", "Tally Lassiter", "Zach Stamper", "Nick Mortenson", "Grace Thompson"];

var friendAlbums = new Array();
friendAlbums["Tally Lassiter"] = ownAlbums;
friendAlbums["Price Clark"] = [recommendations[1], recommendations[2], recommendations[3], recommendations[4], recommendations[5], recommendations[6], recommendations[7], recommendations[8]];
friendAlbums["Zach Stamper"] = zachAlbums;
friendAlbums["Nick Mortenson"] = nickAlbums;
friendAlbums["Grace Thompson"] = graceAlbums;
friendAlbums["Prally Lassark"] = recommendations;

$(document).ready(function() {
	$("#top3details").hide();
	$("#submissionform").hide();
	
	paintUser();
	paintRecent();
	paintFriends();
	paintTop3();
	paintNext5();
	populateWell();
	
	$(".mainAlbums").click(function() {expandTop3Details($(this).index()+1)});
	$("#submitnew").click(function() {showSubmissionForm()});
	$("#submitcancel").click(function() {cancelSubmissionForm()});
	$("#next5 .next5control").click(function() {next5Suggestions()});
	$("#next5 .prev5control").click(function() {prev5Suggestions()});
	$("#dynamicwell .next5control").click(function() {next5Well()});
	$("#dynamicwell .prev5control").click(function() {prev5Well()});
});

//Control Painters
function paintUser () {
	$("#username").html(userFirst+"<br>"+userLast);
	$("input [name=submitter]").val(userFirst+" "+userLast);
}

function paintRecent() {
	$("#submissions td:first").html("<img alt='"+ownAlbums[1][4]+"' src='"+ownAlbums[1][5]+"'>").next().html("<img alt='"+ownAlbums[2][4]+"' src='"+ownAlbums[2][5]+"'>").next().html("<img alt='"+ownAlbums[3][4]+"' src='"+ownAlbums[3][5]+"'>");
}

function paintFriends() {
	for (i=0; i<friends.length; i++) {
		$("#friendlist").append("<li><a>"+friends[i]+"</a></li>");
	}
	$("#friendlist li").click(function() {wellSelect($(this).text())});
}

//Content Painters
function paintTop3() {
	$("#top3summary").html("<table><tr><td id='no1' class='mainAlbums'><img alt='"+recommendations[1][4]+"' src='"+recommendations[1][5]+"'><br><em><strong>"+recommendations[1][4]+"</strong></em></td><td id='no2' class='mainAlbums'><img alt='"+recommendations[2][4]+"' src='"+recommendations[2][5]+"'><br><em><strong>"+recommendations[2][4]+"</strong></em></td><td id='no3' class='mainAlbums'><img alt='"+recommendations[3][4]+"' src='"+recommendations[3][5]+"'><br><em><strong>"+recommendations[3][4]+"</strong></em></td></tr></table>");
}

function paintNext5() {
	var currOffset = nextOffset + 4;
	
	var currCell = $("#next5 td:first");
	$("#next5 td").empty();
	for (var i = 0; i<5; i++) {
		if (recommendations[currOffset] == null) {
			nextMoreAlbums = false;
			break;
		}
		currCell.html("<img alt='"+recommendations[currOffset][4]+"' src='"+recommendations[currOffset][5]+"'>").next().html("<strong><em>"+recommendations[currOffset][4]+"</em><br>"+recommendations[currOffset][2]+"</strong><br><a href='"+recommendations[currOffset][6]+"'>Listen</a>").hide();
		currCell = currCell.next().next();
		currOffset++;
	}

	$("#next5 img").click(function() {$(this).parent().next().toggle()});
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
	$("#submissionform [name=title]").val("Title");
	$("#submissionform [name=artist]").val("Artist");
	$("#submissionform [name=imagesource]").val("Image URL");
	$("#submissionform [name=sourcelink]").val("Source URL");
	$("#submissionform [name=review]").val("Reason for recommending");
	$("#submissionform [name=tags]").val("Tags, Comma-separated (e.g. Dark, Dancy, Hip Hop)");
	$("#submissionform [name=submittee]").val("Recommendee(s)");
	$("#submissionform").show();
}

function cancelSubmissionForm() {
	$("#top3summary, #top3title").show();
	$("#submissionform").hide();
}

function expandOrCloseNext5(index) {
	var currIndex = index;
	$("."+currIndex+".detailCell").toggle();
	alert("."+currIndex+".detailCell");
}

function populateWell() {
	var userPool = []
	var tempWellOffset = wellOffset;
	if (friendAlbums[wellSelector] == null) return;
	userPool = friendAlbums[wellSelector];
	$("#dynamicwell td").empty();
	$("#welltitle").text("Music Recommended by "+wellSelector);
	
	var currCell = $("#dynamicwell td:first");
	for (var i = 1; i<=5; i++) {
		tempWellOffset++;
		if (userPool[tempWellOffset] == null) {
			wellMoreAlbums = false;
			break;
		}
		currCell.html("<img alt='"+userPool[tempWellOffset][4]+"' src='"+userPool[tempWellOffset][5]+"'>").next().html("<strong><em>"+userPool[tempWellOffset][4]+"</em><br>"+userPool[tempWellOffset][2]+"</strong><br><a href='"+userPool[tempWellOffset][6]+"'>Listen</a>").hide();
		currCell = currCell.next().next();
	}
	
	$("#dynamicwell img").click(function() {$(this).parent().next().toggle()});
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