function RouteRedirect(id){
    // console.log(id);
    var url = '/detail_market/:id';
    url = url.replace(':id', id);  
    document.location.href = url;
}