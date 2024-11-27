<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar and Notifications</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/calender.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">
</head>
    <?php $eventJson = json_encode($data);
    ?>
<body>
    <?php include ('../app/views/components/loading.php'); ?>
    <div class="dash-container">
    <?php include ('../app/views/components/collaborator/singersidebar.php'); ?>
        <div class="dashboard">
            <div class="container">
                <h1>My Calendar</h1>
                <div class="calendar">
                    <div class="calendar-header">
                        <button id="prevMonth">◀</button>
                        <h2 id="currentMonth"></h2>
                        <button id="nextMonth">▶</button>
                    </div>
                    <div class="calendar-grid">
                        <input type="hidden" id="events" value='<?php echo $eventJson ?>'>
                    </div>
                </div>

                <div class="event-list">
                    <h2>My Events</h2>
                    <ul id="eventList">
                        <!-- Events will be listed here dynamically -->
                    </ul>
                </div>
            </div>
            <div id="eventModal" class="modal">
                <div class="modal-content">
                    <span id="closeModal" class="close-button">&times;</span>
                    <h1 id="eventName">Event Title</h1>
                    <img id="eventImage" src="" alt="Event Image" style="height: 100px; width: 200px;" />
                    <p id="eventDescription">Event Description goes here.</p>
                    <p><strong>Date:</strong> <span id="eventDate"></span></p>
                </div>
            </div>
        </div>
    </div>


    <script src="<?=ROOT?>/assets/js/calander.js"></script>
</body>
</html>
