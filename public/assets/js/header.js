document.addEventListener("DOMContentLoaded", function () {
    const notifButton = document.getElementById("notificationButton");
    const popup = document.getElementById("notificationPopup");

    notifButton.addEventListener("click", function () {
        // Toggle popup
        popup.style.display = popup.style.display === "none" ? "block" : "none";

        // Send POST request to mark as read
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'changeread=true'
        }).then(() => {
            // Optionally remove the red indicator
            const indicator = document.querySelector(".notification-indicator");
            if (indicator) indicator.remove();
        });
    });

    // Hide popup when clicking outside
    document.addEventListener('click', function (e) {
        if (!notifButton.contains(e.target) && !popup.contains(e.target)) {
            popup.style.display = "none";
        }
    });
});