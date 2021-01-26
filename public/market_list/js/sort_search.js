
var trigger = document.getElementById("searchSort");
trigger.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("btn_search").click();
    }
});
