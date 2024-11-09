<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashboard.css">
</head>
<body>
    <!-- Include Header -->
    <?php include ('../app/views/components/Header.php'); ?>

    <div class="dash-container">
        <!-- Sidebar -->
        <div class="dash-sidebar">
            <h3>Event Planner Profile</h3>
            <ul>
                <li onclick="loadComponent('dash-overview')">Overview</li>
                <li onclick="loadComponent('dash-profile')">Profile</li>
                <li onclick="loadComponent('dash-created-events')">Created Events</li>
                <li onclick="loadComponent('dash-upcoming-events')">Upcoming Events</li>
            </ul>
        </div>
        
        <!-- Main View Area -->
        <div class="dash-view" id="dash-view-content">
            <!-- Loaded content will appear here -->
        </div>
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
