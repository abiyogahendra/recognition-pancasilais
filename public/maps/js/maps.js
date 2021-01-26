var x = document.getElementById("myBtn").textContent;

var ar_coordinate = x.split(', ')
function initialize() {
    var bounds = new google.maps.LatLngBounds();
    var propertiPeta = {
        center:new google.maps.LatLng(ar_coordinate[0] , ar_coordinate[1]),
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
    var lokasi = new google.maps.LatLng(ar_coordinate[0] , ar_coordinate[1]);
    bounds.extend(lokasi);
    var marker = new google.maps.Marker({
        map: peta,
        position: lokasi
    });
}
// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);
