<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Completed Event Info</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventplanner/completedEventInfo.css">
    <script>
        function gotoperformerprofile(user_id) {
            window.location.href = "<?= ROOT ?>/collaborator-viewprofile?id=" + user_id;
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- Section 1: Event Details -->
        <div class="section1">
            <h1>Event Details</h1>
            <div class="details">
                <div class="event-detail">
                    <h3>Event Name:</h3>
                    <p><?= htmlspecialchars($data['event']->event_name); ?></p>
                    <h3>Event Date:</h3>
                    <p><?= htmlspecialchars($data['event']->eventDate); ?></p>
                    <h3>Event Address:</h3>
                    <p><?= htmlspecialchars($data['event']->address); ?></p>
                    <h3>Event Type:</h3>
                    <p><?= htmlspecialchars($data['event']->type); ?></p>
                    <h3>Audience:</h3>
                    <p><?= htmlspecialchars($data['event']->audience); ?></p>
                </div>
            </div>
        </div>

        <!-- Section 2: Performers -->
        <div class="section2">
            <h1>Performers</h1>
            <div class="performers">
                <?php foreach($data['performers'] as $performer): ?>
                    <p><?= htmlspecialchars($performer['name']); ?>
                        <button class="btn btn-primary" onclick="gotoperformerprofile(<?= $performer['id'] ?>)">View Profile</button>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-container">
            <h1>Comments</h1>
            <div class="comments">
                <?php if(!empty($data['comments'])): ?>
                    <div class="comments-section">
                        <?php foreach($data['comments'] as $comment): ?>
                            <div class="comment">
                                <div class="comment-header">
                                    <strong><?php echo htmlspecialchars($comment->sender_name); ?></strong>
                                </div>
                                <div class="comment-content">
                                    <?php echo htmlspecialchars($comment->comment); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Event Report Section -->
        <div class="section3">
            <h2>Event Report</h2>
            <div class="report-container">
                <div class="report-section">
                    <p>Do you want to view the report?</p>
                    <button class="btn btn-primary" onclick="window.location.href='<?= ROOT ?>/event-planner-completedEvent?id=<?= htmlspecialchars($data['event']->id) ?>'">View Report</button>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>