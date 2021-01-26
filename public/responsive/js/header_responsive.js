function Header(x) {
    if (x.matches) { // If media query matches
        $(".2vw").css(
            "font-size" , "2vw"
        );
        $(".1vw").css(
            "font-size" , "1vw"
        );
        $(".logo_1").css({
            "padding-top" : "5px",
            "width" : "70px",
            "height" : "35px"
        });
        $(".fundpress-footer-top-layer").css({
            "padding-top" : "0",
            "padding-bottom" : "0",
        })
    } else {
        $(".logo_1").css({
            "width" : "120px"
        });

    }
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  Header(x) // Call listener function at run time
  x.addListener(Header) // Attach listener function on state changes
  