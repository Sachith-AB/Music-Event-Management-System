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
</head>
<body>
    <?php include ('../app/views/components/loading.php'); ?>
    <div class="dash-container">
        <?php include ('../app/views/components/collaborator/singersidebar.php'); ?>
        <div class="dashboard">
            <div class="container">
                <h1>My Calendar</h1>
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <div id="messageContainer"></div>
                <div class="calendar">
                    <div class="calendar-header">
                        <button id="prevMonth">◀</button>
                        <h2 id="currentMonth"></h2>
                        <button id="nextMonth">▶</button>
                    </div>
                    <div class="calendar-grid">
                        <script id="events" type="application/json"><?= json_encode($data) ?></script>
                    </div>
                </div>
                <div class="available-dates">
                    <h2>Add Unavailable Dates</h2>
                    <form id="unavailableForm" method="POST">
                        <input type="date" name="date" id="date" required min="<?= date('Y-m-d') ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['USER']->id ?>">
                        <button type="submit" name="submit" value = "submit">Add</button>
                    </form>
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
<?php include ('../app/views/components/footer.php'); ?>