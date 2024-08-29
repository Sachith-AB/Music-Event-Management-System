//Error pop up

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