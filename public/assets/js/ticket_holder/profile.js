function showTab(tab) {
    // Hide both
    document.getElementById('past').style.display = 'none';
    document.getElementById('upcoming').style.display = 'none';

    // Remove active class from buttons
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));

    // Show selected
    document.getElementById(tab).style.display = 'block';
    document.querySelector(`.tab-button[onclick="showTab('${tab}')"]`).classList.add('active');
}

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
