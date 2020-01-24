<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<title>DBZ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	#preloader{
		display: none;
	}
	body{
		text-align: center;
	}
	#result2{
		margin: 10px 5%;
		border: 1px solid #9a9a9a;
		padding: 10px;
		text-align: left;
		display: none;
	}
</style>
<script src="zxcvbn.js"></script>
</head>
<body>
<img id="goku" src="images/goku001.gif"><br>
<div id="result">Power Level: 0</div><br>
<div id="result2"></div>
<div id="form">
Full Name<br><input id="fn" type="text"><br>
Password<br><input id="pw" type="password" onkeyup="assess()" onkeydown="setTimeout(resetGoku, 1000)"><br>
<br>
<button onclick="goBattle()">Go to battle</button>
<br><br><br>Download:<br><a href="https://docs.google.com/presentation/d/1TlzfPznhpkd2rCjTIRLNO5rRCHAjnXa7wFw5gcxWu8w/edit?usp=sharing">Slides from Google Drive</a> | <a href="https://github.com/jcwebhole/password_analyzer">Code from Github</a>
</div>
<script>
var current = 'norm';
function assess(){
	pw = document.querySelector('#pw').value;
	var r = zxcvbn(pw);
	// console.log(r);
	if(r.score<=1) current='norm';
	if(r.score==2) current='ssj1';
	if(r.score==3) current='ssj2';
	if(r.score>=4) current='ssj3';
	document.querySelector('#result').innerHTML = 'Power Level: '+parseInt(r.guesses_log10*100);
	document.querySelector('#goku').src = document.querySelector('#'+current+'-charge').src;
}
function resetGoku(){
	window.clearTimeout();
	document.querySelector('#goku').src = document.querySelector('#'+current).src;
}
function goBattle(){
	pw = document.querySelector('#pw').value;
	var r = zxcvbn(pw);
	if(r.score<=1) current='norm';
	if(r.score==2) current='ssj1';
	if(r.score==3) current='ssj2';
	if(r.score>=4) current='ssj3';
	document.querySelector('#result').innerHTML = 'Power Level: '+parseInt(r.guesses_log10*100);
	document.querySelector('#result2').innerHTML = '<hr>';
	document.querySelector('#result2').innerHTML+='# of Guesses: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+parseInt(r.guesses)+'<hr>'
	document.querySelector('#result2').innerHTML+='Crack Time (Throttled Online 100/hr): <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+r.crack_times_display.online_throttling_100_per_hour+'<hr>';
	document.querySelector('#result2').innerHTML+='Crack Time (Unthrottled Online 10/s): <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+r.crack_times_display.online_no_throttling_10_per_second+'<hr>';
	document.querySelector('#result2').innerHTML+='Crack Time (Slow Offline Attack 100K/s): <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+r.crack_times_display.offline_slow_hashing_1e4_per_second+'<hr>';
	document.querySelector('#result2').innerHTML+='Crack Time (Fast Offline Attack 10B/s): <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+r.crack_times_display.offline_fast_hashing_1e10_per_second+'<hr>';
	var scoreText = 'Too guessable';
	if(r.score==1) scoreText = 'Very guessable';
	if(r.score==2) scoreText = 'Somewhat guessable';
	if(r.score==3) scoreText = 'Safely unguessable';
	if(r.score==4) scoreText = 'Very unguessable';
	document.querySelector('#result2').innerHTML+='Score: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+scoreText+'<hr>';
	document.querySelector('#result2').innerHTML+='Warning: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+r.feedback.warning+'<hr>';
	if(r.feedback.suggestions.length>0){
		for (i=0; i<r.feedback.suggestions.length; i++){
			document.querySelector('#result2').innerHTML+='Suggestion #'+(i+1)+': <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+r.feedback.suggestions[i]+'<hr>';			
		}
	}
	document.querySelector('#form').style.display = 'none';
	document.querySelector('#result2').style.display = 'block';
	document.querySelector('#goku').src = document.querySelector('#'+current).src;
}


</script>
<div id="preloader">
<img src="images/goku001.gif" id="norm">
<img src="images/goku002.gif" id="norm-charge">
<br>
<img src="images/goku003.gif" id="ssj1">
<img src="images/goku004.gif" id="ssj1-charge">
<br>
<img src="images/goku005.gif" id="ssj2">
<img src="images/goku006.gif" id="ssj2-charge">
<br>
<img src="images/goku007.gif" id="ssj3">
<img src="images/goku008.gif" id="ssj3-charge">
</div>


</body>
</html>
