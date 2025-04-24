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
    <title>Delete Event Confirmation</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventDelete.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php include ('../app/views/components/loading.php'); ?>
    
    <div class="event-delete-container">
        <?php if (isset($data['id'])): ?>
            <div class="event-delete-details">
                <div class="event-delete-header">
                    <h2><?= htmlspecialchars($data['event_name']); ?></h2>
                </div>

                <div class="event-delete-info">
                    <p><strong>Description:</strong> <?= htmlspecialchars($data['description']); ?></p>
                    <p><strong>Audience:</strong> <?= htmlspecialchars($data['audience']); ?></p>
                    <p><strong>Location:</strong> <?= htmlspecialchars($data['address']); ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($data['eventDate']); ?></p>
                    <p><strong>Start Time:</strong> <?= htmlspecialchars($data['start_time']); ?></p>
                    <p><strong>End Time:</strong> <?= htmlspecialchars($data['end_time']); ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($data['status']); ?></p>
                </div>
            </div>

            <div class="event-delete-validation">
                <h2>Are you sure you want to delete this event?</h2>
                
            </div>

            <div class="event-delete-buttons">
                <button onclick="goBack()">
                    <i class="material-icons">arrow_back</i>
                    No, Keep Event
                </button>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                    <button type="submit" name="delete">
                        <i class="material-icons">delete_forever</i>
                        Yes, Delete Event
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="event-delete-validation">
                <h2>Event Not Found</h2>
                <p>The event details could not be found. Please try again.</p>
                <div class="event-delete-buttons">
                    <button onclick="goBack()">
                        <i class="material-icons">arrow_back</i>
                        Go Back
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function goBack() {
            window.location.href = "event-planner-viewEvent?id=<?php echo $data['id']?>";
        }
    </script>
</body>
</html>