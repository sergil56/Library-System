const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

const currentLocation = location.href;
const menuItem = document.querySelectorAll('.sidebar-link');
const menuLength = menuItem.length
for (let i = 0;i<menuLength; i++){
    if(menuItem[i].href === currentLocation){
        menuItem[i].className ="active"
    }
}
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }