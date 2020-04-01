//Hamburger Menu
document.querySelector("header nav img").addEventListener("click", (e)=>{
    console.log("click");
    document.querySelector("header nav ul").classList.toggle("active");

    // if on browse page, chnage Z-index of the MovieFilters
    const filter = document.querySelector(".DetailView .MovieFilters");
    if (filter){
        filter.classList.toggle("pushback");
    }
 
});
