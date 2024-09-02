const inputs = document.querySelectorAll(".input-field");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");


inputs.forEach((input) => {

    // input class name rename when the clicked
    input.addEventListener("focus", () => {
        input.classList.add("active");
    })

    // input class name rename when the input field for values added
    if(input.value !=""){
        input.classList.add("active");
    }

    // input class name remove when the clicked outside the page
    input.addEventListener("blur", () => {
        if(input.value !=""){
            return;
        }else{
            input.classList.remove("active");
        }
    })
});

//password visibility
function togglePasswordVisibility(passwordId, IconId) {

    var passwordField = document.getElementById(passwordId);
    var toggleIcon = document.getElementById(IconId);

    if (passwordField.type === "password") {
        toggleIcon.setAttribute("name", "eye-off-outline");
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
        toggleIcon.setAttribute("name", "eye-outline");
      }
}

// image slider & bullet navigation
let index = 0;

function moveSlider() {
  index = (index % images.length) + 1;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  let currentBullet = document.querySelector(`.bull-${index}`);
  bullets.forEach((bull) => bull.classList.remove("active"));
  currentBullet.classList.add("active");
}

setInterval(moveSlider, 2000);


