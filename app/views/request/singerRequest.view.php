<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/request/singerdropdown.css">
    <title>Event Planner Dashboard</title>
</head>

<body>

<?php include ('../app/views/components/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="content">

    <h1>Singers</h1>
        <!-- Search Bar -->
        <header>
            <input type="text" placeholder="Search..." class="search-bar">
        </header>

        <!-- Singers Section -->
        <section class="singers-section">
            
            <div class="singers-grid">
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 1">
                    <h3>Singer 1</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 2">
                    <h3>Singer 2</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 3">
                    <h3>Singer 3</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 4">
                    <h3>Singer 4</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 5">
                    <h3>Singer 5</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 6">
                    <h3>Singer 6</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 7">
                    <h3>Singer 7</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 8">
                    <h3>Singer 8</h3>
                    <p>Music Genre</p>
                </div>
                <div class="singer-card">
                    <img src="https://via.placeholder.com/150" alt="Singer 9">
                    <h3>Singer 9</h3>
                    <p>Music Genre</p>
                </div>
            </div>
        </section>
    </div>

<script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>
