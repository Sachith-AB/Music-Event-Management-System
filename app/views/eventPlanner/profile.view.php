<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/profile.css">
</head>
<body>
    <main class="page-content">
        <div class="image-container">
            <h1>create a wonderful event</h1>
            <button class="button" onclick="goToCreateEvent()">Click Here</button>
        </div>

        <p class="title">Upcoming Shows</p>

        <div>
            <div class="events-container">
                <div class="event-container">
                    <div class="text-container">
                        <h2>NYC Concert</h2>
                        <h3>Date: Oct 15, 2024</h3>
                        <h3>Location: Madison Square Garden</h3>
                    </div>
                    <div class="">
                        <img class="event-image" src="<?=ROOT?>/assets/images/landing/One Mic.png" alt="events">
                    </div>
                </div>

                <div class="event-container">
                    <div class="text-container">
                        <h2>NYC Concert</h2>
                        <h3>Date: Oct 15, 2024</h3>
                        <h3>Location: Madison Square Garden</h3>
                    </div>
                    <div class="">
                        <img class="event-image" src="<?=ROOT?>/assets/images/landing/One Mic.png" alt="events">
                    </div>
                </div>

                <div class="event-container">
                    <div class="text-container">
                        <h2>NYC Concert</h2>
                        <h3>Date: Oct 15, 2024</h3>
                        <h3>Location: Madison Square Garden</h3>
                    </div>
                    <div class="">
                        <img class="event-image" src="<?=ROOT?>/assets/images/landing/One Mic.png" alt="events">
                    </div>
                </div>

                <div class="event-container">
                    <div class="text-container">
                        <h2>NYC Concert</h2>
                        <div class="details">
                            <h3>Date : Oct 15, 2024</h3>
                        </div>
                        <h3>Location: Madison Square Garden</h3>
                    </div>
                    <div class="">
                        <img class="event-image" src="<?=ROOT?>/assets/images/landing/One Mic.png" alt="events">
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        function goToCreateEvent() {
            window.location.href = "create-event";
        }
    </script>

</body>
</html>