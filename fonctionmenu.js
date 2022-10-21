var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
    el.classList.toggle("toggled");
};
document.addEventListener("DOMContentLoaded", function(){
document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

element.addEventListener('click', function (e) {

let nextEl = element.nextElementSibling;
let parentEl  = element.parentElement;	

if(nextEl) {
    e.preventDefault();	
    let mycollapse = new bootstrap.Collapse(nextEl);
    
    if(nextEl.classList.contains('show')){
      mycollapse.hide();
    } else {
        mycollapse.show();
        // find other submenus with class=show
        var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
        // if it exists, then close all of them
        if(opened_submenu){
          new bootstrap.Collapse(opened_submenu);
        }
    }
}
}); // addEventListener
}) // forEach
}); 
//nav link active
var btnContainer = document.getElementById("nav_accordion");

// Get all buttons with class="btn" inside the container
var btns = btnContainer.getElementsByClassName("nav-link ");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", function() {
var current = document.getElementsByClassName("active");
current[0].className = current[0].className.replace(" active", "");
this.className += " active";
});
}