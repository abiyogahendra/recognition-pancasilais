// Sort By City
    var pathArray = window.location.pathname.split('/');
    var city = pathArray[3];
    console.log(city);
    document.getElementById("filterCity").value = city;
// Sorting by Date  
    var pathArray = window.location.pathname.split('/');
    var sort = pathArray[3];
    console.log(sort);
    document.getElementById("filterSort").value = sort;