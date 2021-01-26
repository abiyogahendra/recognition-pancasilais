function aboutUs(x) {
    if (x.matches) { // If media query matches
        $(".img_play1").css(
            "width" , "60%"
        )
        $(".md-small").removeClass("col-md-3").addClass("col-4");
        
        $(".16rem-12rem").addClass("12rem")

    } else {
        $(".16rem-12rem").addClass("16rem")
    } 
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  aboutUs(x) // Call listener function at run time
  x.addListener(aboutUs) // Attach listener function on state changes
  