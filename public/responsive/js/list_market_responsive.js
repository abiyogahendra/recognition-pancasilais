function ListMarket(x) {
    if (x.matches) { // If media query matches
        // document.body.style.fontSize = "";
            
        $(".select2").css(
            "width" , "100% !important"
        );
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
        $(".logo_1").css({
            "padding-top" : "5px",
            "width" : "70px",
            "height" : "35px"
        });
        $(".fundpress-footer-top-layer").css({
            "padding-top" : "0",
            "padding-bottom" : "0",
        })
        $(".xs-section-heading").css({
            "padding-bottom" : "0",
        })

        // image market list
        $(".img_list").css({
            "height": "100px", 
            "width" : "100%"
        });
        $(".persent").css({
            "width" : "20px",
            "height": "20px"
        });
        $(".m_persent").removeClass("ml-4").css(
            "margin-left" , "5px"
        );
        $(".xs-content-padding").css(
            "padding", "15px 10px 10px 10px"
        )
        $(".xs-section-heading").css(
            "padding", "30px 0px 0px 0px"
        )
        $(".xs-section-padding").css(
            "padding", "30px 0px"
        )
        $(".profil").css(
            "display" , "none"
        );
        $(".fundpress-post-title").css(
            "margin" , "0 0 10px 0"
        );
        $(".fundpress-simple-tag").css(
            "margin" , "0 0 10px 0"
        );
    } else {
        $(".logo_1").css({
            "width" : "120px"
        });
        // image market list
        $(".img_list").css({
            "height": "250px", 
            "width" : "100%"
          });
    }
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  ListMarket(x) // Call listener function at run time
  x.addListener(ListMarket) // Attach listener function on state changes
  