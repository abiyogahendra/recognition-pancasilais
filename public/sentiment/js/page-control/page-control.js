function PageUsernameInput(){
    $.ajax({
        url : '/input-user',
        data    : {

        },
        type : 'get',
        dataType : 'html',
        success : function(response){
            $('.data_masuk').append(response);
        }
    })
}