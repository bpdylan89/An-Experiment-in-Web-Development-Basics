<!--

// javascript.js -- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017


// HEADER IMAGE FADE ON SCROLL

window.addEventListener('scroll', function () {
    document.body.classList[window.scrollY > 50 ? 'add': 'remove']('scrolled');
});

// TOUCHSCREEN MENU SWIPE

document.addEventListener('touchstart', handleTouchStart, false);        
document.addEventListener('touchmove', handleTouchMove, false);

var xDown = null;                                                        
var yDown = null;                                                      

function handleTouchStart(evt) {                                         
    xDown = evt.touches[0].clientX;                                      
    yDown = evt.touches[0].clientY; 
    
    xTouch =  Math.abs( xDown );;                                              
};                                                

function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        return;
    }

    var xUp = evt.touches[0].clientX;                                    
    var yUp = evt.touches[0].clientY;

    var xDiff = xDown - xUp;
    var yDiff = yDown - yUp;

    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
        if ( xDiff > 0 ) {
            document.getElementById("navbox").checked = true;
        } else {
            document.getElementById("navbox").checked = false;
        }                                                                                      
    }
    xDown = null;
    yDown = null;                                             
};
    
// FACEBOOK

window.fbAsyncInit = function() {
    FB.init({
      appId      : '307542716354411',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };

(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


// Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017

-->