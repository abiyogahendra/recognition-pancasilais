function Detail(x) {
    if (x.matches) { // If media query matches
        // font
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
            $(".img_slid").css({
                "border-radius" : "5px",
                "height": "100px", 
                "width" : "70%",
                "margin-left" : "auto",
                "margin-right": "auto",
                "bg-color" : "white"
            });    
            $(".img_preview").css({
                "height": "20px", 
                "width" : "50px"
            });
            $(".img_profil").css({
                "padding-right" : "0",
                "padding-left" : "20px",
            });

            $(".image-model").css({
                "height" : "80px",
                "border-radius" : "20px",
                "width" : "100%"
            })
     

           

        // padding
            $(".p_20").removeClass("xs-mb-50 xs-mb-40 xs-mb-30").css({
                "margin-bottom" : "20px",
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
            
        // stepper
            $(".stepper").removeAttr("id").css({
                "width" : "60px",
                "height" : "30px",

            });
            $("#progressbar").css(
                "font-family" , ""
            );
            
            $(".step_center").css(
                "margin-left" , "5%"
            )
        
        // color
            $(".owl-item active").removeAttr('id').css(
                "bg-color" , "white"
            );
        
        // hidden_500
            $(".hidden_500").css(
                "display" , "none"
            );
        // button
            $(".btn-booking").addClass("xs-btn-small").removeClass("xs-btn-medium")
           
        // icon font Awesome
            $(".fa_smaller").removeClass("fa-4x").addClass("fa-2x").css(
                "display" , "none"
            );
               

    } else {
        // font
            $(".logo_1").css({
                "width" : "120px"
            });

        // img
            $(".img_slid").css({
                "height": "300px", 
                "width" : "650px"
            });
            $(".img_preview").css({
                "height": "50px", 
                "width" : "250px"
            });
            $(".image-model").css({
                "height" : "250px",
                "width" : "100%",
                "border-radius" : "20px",

            })
        // padding
           $(".step_center").css(
               "margin-left" , "12%"
           )

        // stepper
            $("#progressbar").css(
                "font-family" , "FontAwesome"
            );

        // display_500
            $(".display_500").css(
                "display" , "none"
            );
        // button
            $(".btn-booking").addClass("xs-btn-medium").removeClass("xs-btn-small")


    }
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  Detail(x) // Call listener function at run time
  x.addListener(Detail) // Attach listener function on state changes
  