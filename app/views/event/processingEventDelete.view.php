
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? 'Event Title';
$description = $_SESSION['event_data']['description'] ?? 'No description provided';



// Track last visit time
if (isset($_SESSION['last_visit'])) {
    $last_visit = $_SESSION['last_visit'];
} else {
    $last_visit = "This is my first visit";
}
$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventDelete.css">
</head>


<body>
    <div class="main-container">
                <?php if (isset($data['id'])): ?>
                    <div class="event-details">
                        <section id="event-header">
                            <div class="event-cover">
                                <div class = "event-info">
                                    <h2 id="event title"><?= htmlspecialchars($data['event_name']); ?></h2>
                                </div>
                            </div>
                        </section>

                        <section id = "general-information">
                            <p><strong>Description:</strong> <?= htmlspecialchars($data['description']); ?></p>
                            <p><strong>Audience:</strong> <?= htmlspecialchars($data['audience']); ?></p>
                            <p><strong>Location:</strong> <?= htmlspecialchars($data['address']) ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($data['eventDate']); ?></p>
                            <p><strong>Start Time:</strong> <?= htmlspecialchars($data['start_time']); ?></p>
                            <p><strong>End Time:</strong> <?= htmlspecialchars($data['end_time']); ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($data['status']); ?></p>
                        </section>
                    </div>

                    <section id="validation">
                        <h2>Are you sure you want to delete this event?</h2>
                    </section>

                    <div class ="action-buttons">
                        <button onclick="goBack()">No</button>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                            <button type="submit" name="delete">Yes</button>
                        </form>

                    </div>


                <?php else: ?>
                    <p>Event details not found. Please try again.</p>
                <?php endif; ?>
    </div>


    <script>
        function goBack() {
            window.location.href = "event-planner-viewEvent?id=<?php echo $data['id']?>";
            window.history.back();
        }
    </script>

</body>
</html>
