<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Effect</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css"> <!-- External CSS -->
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="logo-container">
            <div class="spinner">
                <!-- <img src="<?=ROOT?>/assets/images/logo/logo.png" alt="System Logo" class="logo"> -->
            </div>
        </div>
    </div>

    <!-- Main Page Content (Initially blurred) -->
    <div id="page-content">
        <!-- Your actual page content goes here -->
    </div>

    <script>
        // script.js

        // Ensure DOM is fully loaded
        document.addEventListener("DOMContentLoaded", function () {
            // Add event listener to wait for page load
            window.addEventListener("load", function () {
                // Add a delay of 2 seconds before hiding the loading screen
                setTimeout(function () {
                    const loadingScreen = document.getElementById("loading-screen");
                    const pageContent = document.getElementById("page-content");

                    loadingScreen.style.display = "none"; // Remove loading screen
                    pageContent.classList.add("loaded"); // Unblur the content
                }, 0); // 2000 milliseconds = 2 seconds
            });
        });
    </script>
</body>
</html>
