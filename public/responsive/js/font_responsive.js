function Master(x) {
    if (x.matches) { // If media query matches
        // font responsive
        $(".5vw").css(
            "font-size" , "5vw"
        );
        $(".3vw").css(
            "font-size" , "3vw"
        );
        $(".2vw").css(
            "font-size" , "2vw"
        );
        $(".1vw").css(
            "font-size" , "1vw"
        );

        //padding
        $(".pt_20").css({
            "margin-top" : "20px",
        });
        $(".pt_10").css({
            "padding-top" : "10px",
        });
        $(".p_20").removeClass("xs-mb-50 xs-mb-40 xs-mb-30").css({
            "margin-bottom" : "20px",
        });
        $(".pt_5").removeClass("xs-mb-50 xs-mb-30 xs-mb-20").css({
            "padding-top" : "5px",
        });
        $(".p_5").removeClass("xs-mb-50 xs-mb-30 xs-mb-20").css({
            "padding-bottom" : "5px",
        });
        $(".xs-content-section-padding").css({
            "padding-top" : "30px",
        });
        $(".fundpress-footer-top-layer").css({
            "padding-top" : "0",
            "padding-bottom" : "0",
        })
        $("#progressbar").css(
            "margin-bottom" , "10px"
        );
        $(".pl_0").css({
            "padding-right" : "0",
            "padding-left" : "0px",
        });
        $(".fundpress-avatar").css({
            "margin-right" : "0",
            "margin-left" : "0px",
        });
        $(".xs-info-card").css(
            "padding" , "10px 10px 10px 10px"
        );
        $(".location_smaller").css(
            "padding-left" , "30px"
        );
        $(".mb_20").css({
            "margin-bottom" : "20px",
        });
     
    } else {
    }
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  Master(x) // Call listener function at run time
  x.addListener(Master) // Attach listener function on state changes
  