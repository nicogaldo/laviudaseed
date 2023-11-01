document.addEventListener("DOMContentLoaded", function(){
    window.addEventListener('scroll', function() {
  
        topBar = document.getElementById("top-navbar");
        topBarHeight = 0;
        
        if (topBar) {
            topBarHeight = topBar.offsetHeight;
        }

        if (window.scrollY > topBarHeight) {
            document.getElementById('site-navbar').classList.add('fixed-top');

        } else {
            document.getElementById('site-navbar').classList.remove('fixed-top');
        } 

    });
  }); 