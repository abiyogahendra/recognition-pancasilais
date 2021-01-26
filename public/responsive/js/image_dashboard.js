function myFunction(x) {
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
      
      // image 
      $(".img_6").css({
        "height": "100px", 
        "width" : "100%"
      });
      $(".img_slider").css({
        "padding-top": "50px",
      });
      $(".img_3").css({
        "height": "60px", 
        "width" : "100%"
      });
      $(".img_q").css({
        "width" : "50px"
      });
      $(".profil").css(
        "display" , "none"
      );

      // heigh - width
      $(".persent_head").css({
              "width" : "25px",
              "height": "25px"
            });
      $(".persent").css({
        "width" : "20px",
        "height": "20px"
      });
      $(".button_detail").css({
        "width" : "70px",
        "height" : "10px",
      });
      $("i:after").css({
        "width" : "10px",
        "height" : "10px"
      })


      // padding - margin 
      $(".p_alig").css({
        "text-align" : "center",
        "pada": "20px"
      });
      $(".p10_top").css(
        "padding-top" , "10px"
      )
      $(".m_left").removeClass("ml-4").css({
        "padding-left" : "10px",
      });
      
      $(".m_persent").removeClass("ml-4").css(
        "margin-left" , "5px"
      );
      $(".xs-content-padding").css(
        "padding", "15px 10px 10px 10px"
      )
      $(".xs-section-heading").css(
        "padding", "0px 0px 0px 0px"
      )
      $(".xs-section-padding").css(
        "padding", "30px 0px"
      )
      $(".row_mr0").css(
        "margin-right" , "0px"
      )

    } else {
      $(".img_6").css({
        "height": "250px", 
        "width" : "100%"
      });
      $(".img_slider").css({
        "padding-top": "80px",
      });
      $(".img_3").css({
        "height": "250px", 
        "width" : "100%"
      });
      $(".persent").css({
        "width" : "40px"
        })
    }
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  myFunction(x) // Call listener function at run time
  x.addListener(myFunction) // Attach listener function on state changes
  