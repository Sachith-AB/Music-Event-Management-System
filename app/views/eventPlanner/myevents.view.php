<?php 
    $backPath = ROOT.'/event-planner-dashboard';
    include ('../app/views/components/header.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/myevents.css">
</head>
<body>
    <!-- Include Header -->
  
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php'); ?>
        


        <?php if (!empty($events)):?>
            <div class="content">
                <!-- Processing Events Section -->
                <h2 class="content-header">Newly Created Events (Processing)</h2>
                <div class="events-container">
                    <?php foreach ($events as $event): ?>
                        <?php if ($event->status == 'processing'): ?>
                                <div class="event-card">
                                    <a href="<?=ROOT?>/event-planner-viewEvent?id=<?= htmlspecialchars($event->id) ?>" class="event-card-link">
                                        <div class="event-status-process">Processing</div>
                                        <img src="<?=ROOT?>/assets/images/events/<?php echo htmlspecialchars($event->cover_images)?> " alt="<?= htmlspecialchars($event->event_name) ?>">
                                        <div>
                                            <div><?= htmlspecialchars($event->event_name) ?></div>
                                            <div>
                                                <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                                <div>📍 <?= htmlspecialchars($event->address)?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Scheduled Events Section -->
                <h2 class="content-header">Upcoming Events (Scheduled)</h2>
                <div class="events-container">
                    <?php foreach ($events as $event): ?>
                        <?php if ($event->status == 'scheduled'): ?>
                            <div class="event-card">
                                <a href="<?=ROOT?>/event-planner-scheduledEvent?id=<?= htmlspecialchars($event->id) ?>" class="event-card-link" name = "update">
                                    <div class="event-status-scheduled">Scheduled</div>
                                    <img src="<?=ROOT?>/assets/images/events/<?php echo htmlspecialchars($event->cover_images)?>" alt="<?= htmlspecialchars($event->event_name) ?>">
                                    <div>
                                        <div><?= htmlspecialchars($event->event_name) ?></div>
                                        <div>
                                            <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                            <div>📍 <?= htmlspecialchars($event->address) ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Completed Events Section -->
                <h2 class="content-header">Already Held Events (Completed)</h2>
                <div class="events-container">
                    <?php foreach ($events as $event): ?>
                        <?php if ($event->status == 'completed'): ?>
                            <div class="event-card">
                                <a href = "<?=ROOT?>/event-planner-completedEventInfo?id=<?= htmlspecialchars($event->id) ?>" class="event-card-link" name = "completed">
                                <div class="event-status-completed">Completed</div>
                                <img src="<?=ROOT?>/assets/images/events/<?php echo htmlspecialchars($event->cover_images)?>" alt="<?= htmlspecialchars($event->event_name) ?>">
                                <div>
                                    <div><?= htmlspecialchars($event->event_name) ?></div>
                                    <div>
                                        <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                        <div>📍 <?= htmlspecialchars($event->address) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>

</body>
</html>
