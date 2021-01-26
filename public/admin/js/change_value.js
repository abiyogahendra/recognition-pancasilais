$(document).ready(function(){
    var data = $(".step_on").text();
    console.log(data);
    document.getElementById("step_progress").value = data;
})