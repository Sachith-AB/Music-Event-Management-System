<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singer Dashboard - Calendar</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/singercalendar.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css" rel="stylesheet">
</head>
<body>
    <div class="dash-container">
        <?php include ('../app/views/components/collaborator/singersidebar.php'); ?>
        <div class="dashboard">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- FullCalendar Library -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js"></script>

    <!-- Calendar Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing Calendar');
            var calendarEl = document.getElementById('calendar');

            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: [
                        { title: 'Event 1', start: '2024-11-20' },
                        { title: 'Event 2', start: '2024-11-22' },
                        { title: 'Event 3', start: '2024-11-25' }
                    ],
                    height: 'auto',
                });

                calendar.render();
                console.log('Calendar Rendered');
            } else {
                console.error('Calendar element not found');
            }
        });
    </script>
</body>
</html>
