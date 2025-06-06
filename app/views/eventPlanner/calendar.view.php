<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar and Notifications</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/calender.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<?php $eventJson = json_encode($data['events'] ?? []); ?>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    <div class="dash-container">
    <?php include ('../app/views/components/eventPlanner/dashsidebar.php'); ?>
        <div class="dashboard">
            <div class="container">
                <div class="back-button">
                    <!-- Include Back Button Component -->
                    <?php include('../app/views/components/backbutton.view.php'); ?>
                    <h1>My Calendar</h1>
                </div>
                
                <div class="calendar">
                    <div class="calendar-header">
                        <button id="prevMonth">◀</button>
                        <h2 id="currentMonth"></h2>
                        <button id="nextMonth">▶</button>
                    </div>
                    <div class="calendar-grid">
                        <script id="events" type="application/json"><?= $eventJson ?></script>
                    </div>
                </div>

                <!--<div class="event-list">
                    <h2>My Events</h2>
                    <ul id="eventList">
                        
                    </ul>
                </div>-->
            </div>
            <div id="eventModal" class="modal">
                <div class="modal-content">
                    <span id="closeModal" class="close-button">&times;</span>
                    <h1 id="eventName">Event Title</h1>
                    <img id="eventImage" src="" alt="Event Image" style="height: 100px; width: 200px;" />
                    <p id="eventDescription">Event Description goes here.</p>
                    <p><strong>Date:</strong> <span id="eventDate"></span></p>
                    <p><strong>Time:</strong> <span id="eventTime"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/js/calander.js"></script>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>