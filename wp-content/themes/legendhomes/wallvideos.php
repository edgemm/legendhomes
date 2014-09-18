<script> 
var tag = document.createElement('script'); 
tag.src = "http://www.youtube.com/player_api"; 
var firstScriptTag = document.getElementsByTagName('script')[0]; 
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player; 
function onYouTubePlayerAPIReady() { 
player = new YT.Player('player', { 

playerVars: {
   modestbranding: 1,
	rel: 0,
	showinfo: 1,
	list: 'PLnsJZwrh2aZY7TotQgadacpr7uPvOBh4x', 
	index: 1,
	vq: 'large',
	
  },

height: '343', 
width: '610',
videoId: 'SxJBlCBumiY',

events: { 
'onReady': onPlayerReady, 
'onStateChange': onPlayerStateChange 
} 
}); 
}
function onPlayerReady(event) { 
/// event.target.playVideo(); 
}

function onPlayerStateChange(event) { 
if (event.data ==YT.PlayerState.PLAYING) 
{_gaq.push(['_trackEvent', 'Videos', 'Play', 
player.getVideoUrl() ]); } 
if (event.data ==YT.PlayerState.ENDED) 
{_gaq.push(['_trackEvent', 'Videos', 'Watch to End', 
player.getVideoUrl() ]); } } 
</script> 
                           
                
<p style="width: 100%;"><div style="width: 610px; height: 343px; text-align: center; margin-right: auto; margin-left: auto; display: block;" id="player"></div></p>			