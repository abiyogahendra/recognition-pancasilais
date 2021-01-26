function ProfilDashboard(x) {
    if (x.matches) { // If media query matches
        // image
        $(".image_fixed").css(
            "height" , "50px"
        )
        
        // FONT AWESOME
        $(".small_fa").removeClass("fa-7x").addClass("fa-2x");
        
        // height width
         $(".respon_rem_card").css({
            // "height" : "50px",
            "width" : "33rem"
         })

    } else {
        // image
        $(".image_fixed").css(
            "height" , "150px"
        )

         // height width
         $(".respon_rem_card").css({
            // "height" : "50px",
            "width" : "50rem"
         })

    }
  }
  
  var x = window.matchMedia("(max-width: 500px)")
  ProfilDashboard(x) // Call listener function at run time
  x.addListener(ProfilDashboard) // Attach listener function on state changes
  