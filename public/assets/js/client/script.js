
/**************************************
 * 
 *           header
 * 
 * *************************************/

const records_numbers = document.querySelectorAll(".number");
const hamburger_menu = document.querySelector(".hamburger-menu");
const navbar = document.querySelector("#header-id nav");
const links = document.querySelectorAll(".links a");



function closeMenu() {
  if (navbar) {
    navbar.classList.remove("open");
    document.body.classList.remove("stop-scrolling");
  }
}

hamburger_menu.addEventListener("click", () => {
  if (!navbar.classList.contains("open")) {
    navbar.classList.add("open");
    document.body.classList.add("stop-scrolling");
  } else {
    closeMenu();
  }
});

links.forEach((link) => link.addEventListener("click", () => closeMenu()));



$(".grid").isotope({
  itemSelector: ".grid-item",
  layoutMode: "fitRows",
  transitionDuration: "0.6s",
});

window.addEventListener("scroll", () => {
  skillsEffect();
  countUp();
});

function checkScroll(el) {
  let rect = el.getBoundingClientRect();
  if (window.innerHeight >= rect.top + el.offsetHeight) return true;
  return false;
}














const container = document.querySelector(".container-login"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");
    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";
                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";
                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })






    const showMenu = (toggleId, navId) =>{
      const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId)
   
      toggle.addEventListener('click', () =>{
          // Add show-menu class to nav menu
          nav.classList.toggle('show-menu')
   
          // Add show-icon to show and hide the menu icon
          toggle.classList.toggle('show-icon')
      })
   }
   
   showMenu('nav-toggle','nav-menu')

