function ChangeCity(){
    var x = document.getElementById("filterCity").value;
    console.log(x);
    var url = '/page_market_list/city/:city';
    url = url.replace(':city', x);
    document.location.href = url;
}
// function ChangeCity(){
//     var x = document.getElementById("filterCity").value;
//     $.ajax({
//       url: '/page_market_list/city'. x,
//       data: {
//         city        : x,     
//       },
//       type: 'get',
//       dataType: 'json',
//       success: function (d) {
//            if(d.status == 500){
//               swal("Maaf", "Tolong Isikan quantity");
//            }else{
//               $('#market_list').fadeOut();
//               $('#data_market').load('/page_market_list/city' + ' #market_list', function(){
//                 $('#market_list').fadeIn();
//               });
//            }
//       }
//   });
// }


function ChangeSort(){
    var x = document.getElementById("filterSort").value;
    console.log(x);
    var url = '/page_market_list/by/:sort';
    url = url.replace(':sort', x);
    document.location.href = url;
}
function SearchSort(){
    var x = document.getElementById("searchSort").value;
    // e.preventDefault();
    // console.log(x);
    var url = '/page_market_list/search/:searchSort';
    url = url.replace(':searchSort', x);
    document.location.href = url;
    
    // $.get( url, function(data, status){
    //     $.ajax({
    //         url: url,
    //         type:'GET',
    //         dataType:'html',
    //         success : function(res){
                
                
    //             console.log(res);
    //                 // append / insert html
    //                 // $().replaceAll("data_market");
    //             $("#result").html(ajax_load).load(loadUrl);
    //         }
    //     })
    //   });

}