// $('#price').click(function(){
//     alert('dsfdsf');
// });

// $('#price').maskNumber({
//         thousands:'*'       
//     });

$(document).ready(function () {
    $('[name=currency-default]').maskNumber();
    $('[id=currency-data-attributes]').maskNumber();
    $('[name=currency-configuration]').maskNumber({decimal: '_', thousands: '*'});
    $('[id=integer-default]').maskNumber({integer: true});
    $('[name=integer-data-attribute]').maskNumber({integer: true});
    $('[name=integer-configuration]').maskNumber({integer: true, thousands: '_'});
});