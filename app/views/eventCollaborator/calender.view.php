<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar and Notifications</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/calender.css">
</head>
    <?php $eventJson = json_encode($data);
    ?>
<body>
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

    <script src="<?=ROOT?>/assets/js/calander.js"></script>
</body>
</html>
