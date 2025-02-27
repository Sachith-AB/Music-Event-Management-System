
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
    <title>Review Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventDelete.css">
</head>
<?php $event_name = htmlspecialchars($_GET['event_name']?? '');
?>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    <!-- Main Content -->
        <div class="main-content">
            <section id="event-header">
                <div class="event-cover">
                    <div class="event-info">
                        <h2 id = "event title"><?php echo $data['event_name'] ?></h2>
                    </div>
                </div>
            </section>

            <section id="general-information">
                <p class = "event-description"> <?php echo $data['description'] ?></p>
            </section>


            

            <input type="hidden" name="event_id" value="<?php echo $data['id'] ?>">

            
            <section id="validation">
                <h2>Are you sure you want to delete this event?</h2>
            </section>

            <div class ="action-buttons">
                <button onclick="goBack()">No</button>

                <form method = "POST">
                    <input type="hidden" name="event_id" value="<?php echo $data['id'] ?>">
                    <button type="submit" name="delete">Yes</button>
                </form>


            </div>
        </div>
    </div>


    <script>
       function goBack() {
            const eventName = "<?= htmlspecialchars($data['event_name']) ?>";
            if (eventName) {
                window.location.href = `event-review?event_name=${eventName}`;
            } else {
                window.history.back();
            }
        }
    </script>
</body>
</html>
