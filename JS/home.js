var search = document.getElementById("searchMovie");

search.addEventListener("keyup", function(event) {
    if (event.keyCode == 13)
    {
        event.preventDefault();
        document.getElementById("procSearch").click();
        /* Code taken from https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp */
}
});