const inputs = document.querySelectorAll(".input-field");


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

document.addEventListener("DOMContentLoaded", function() {
    const errorPopup = document.getElementById('error-popup');
    const countdownElement = document.getElementById('countdown');
    let countdownValue = 5; // Start countdown from 5 seconds

    if (errorPopup) {
        // Start the countdown
        const countdownInterval = setInterval(function() {
            countdownValue--;
            countdownElement.textContent = countdownValue;

            // Hide the error popup when the countdown reaches 0
            if (countdownValue <= 0) {
                clearInterval(countdownInterval);
                errorPopup.style.display = 'none';
            }
        }, 1000); // Update every 1 second
    }
});