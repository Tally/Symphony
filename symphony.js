var recommendations =  new Array();
recommendations[0] = ["0Title", "1Artist", "2url://of.the.image/", "3Recommender", "4Message","url"];
recommendations[1] = ["The Velvet Underground & Nico", "The Velvet Underground", "cover1.jpg", "Price", "Pretty solid if you haven't - must listen"];
recommendations[2] = ["Most Wanted", "The Cults", "cover2.jpg", "Price", "Most Wanted I think is their best"];
recommendations[3] = ["Lightning", "Matt and Kim", "cover3.jpg", "Price", "Music video to Let's go is them in bed. 'Nuff said."];
recommendations[4] = ["Caravan Palace", "Caravan Palace", "cover4.jpg", "Price", "uhhhm"];
recommendations[5] = ["Hotel Paper", "Michelle Branch", "cover5.jpg", "Price", "well. . . uhhh."];
recommendations[6] = ["Kinks", "Kinks", "cover6.jpg", "Price", "it's good I guess"];
recommendations[7] = ["Alt-J", "Alt-J", "cover7.jpg", "Price", "oh yeah"];
recommendations[8] = ["Quebec", "Ween", "cover8.jpg", "Price", "awesome"];

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
	$("#top3summary").html("<table><tr><td id='no1' class='mainAlbums'><img alt='"+recommendations[1][0]+"' src='"+recommendations[1][2]+"'><br><em><strong>"+recommendations[1][0]+"</strong></em></td><td id='no2' class='mainAlbums'><img alt='"+recommendations[2][0]+"' src='"+recommendations[2][2]+"'><br><em><strong>"+recommendations[2][0]+"</strong></em></td><td id='no3' class='mainAlbums'><img alt='"+recommendations[3][0]+"' src='"+recommendations[3][2]+"'><br><em><strong>"+recommendations[3][0]+"</strong></em></td></tr></table>");
}

function paintNext5() {
	$("#next5summary").html("<img id='no4' class='next5album' alt='"+recommendations[4][0]+"' src='"+recommendations[4][2]+"'><img id='no5' class='next5album' alt='"+recommendations[5][0]+"' src='"+recommendations[5][2]+"'><img id='no6' class='next5album' alt='"+recommendations[6][0]+"' src='"+recommendations[6][2]+"'><img id='no7' class='next5album' alt='"+recommendations[7][0]+"' src='"+recommendations[7][2]+"'><img id='no8' class='next5album' alt='"+recommendations[8][0]+"' src='"+recommendations[8][2]+"'>");
}

//Dynamic Painters
function expandTop3Details(albumNo) {
	$("#top3summary").toggle();
	var album = recommendations[albumNo];
	$("#top3details").html("<table><tr><td rowspan='4'><img src='"+album[2]+"'></td><td class='top3title' colspan='2'><strong>"+album[0]+"</strong> by "+album[1]+"</td></tr><tr><td>Listen <a href='"+album[5]+"'>here</a></td></tr><tr><td>"+album[4]+"</td></tr><tr><td>Recommended by "+album[3]+"</td></tr><tr><td><button type='button' class='backbutton'><em>Back</em></button></td></tr></table>").toggle();
	$(".backbutton").click(function() {minimizeTop3Details()});
}

function minimizeTop3Details() {
	$("#top3details").toggle();
	$("#top3summary").toggle();
}

function showSubmissionForm() {
	$("#top3summary, #top3details, #top3title").hide();
	$("#submissionform").show();
}

function cancelSubmissionForm() {
	$("#top3summary, #top3title").show();
	$("#submissionform").hide();
}