<?php 
    $backPath = ROOT.'/event-planner-dashboard';
    require_once '../app/helpers/load_notifications.php';
    include ('../app/views/components/header.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/myevents.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <!-- Include Header -->
  
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php'); ?>
        
        <div class="dashboard">

        <?php if (!empty($events)):?>
            <div class="content">
                <div class="back-button">
                    <?php include('../app/views/components/backbutton.view.php'); ?>
                    <!-- Processing Events Section -->
                    <h2 class="content-header">Processing Events</h2>
                </div>
                <div class="events-container">
                    <?php 
                        $processingCount = 0;

                        usort($events,function($a, $b) {
                            return strtotime($b->created_at) - strtotime($a->created_at);
                        });

                        foreach ($events as $event): 
                            if ($event->status == 'processing'):
                                $processingCount++;
                                if (!$showMoreProcessing && $processingCount > 6) continue;
                    ?>
                            <div class="event-card">
                                <a href="<?=ROOT?>/event-planner-viewEvent?id=<?= htmlspecialchars($event->id) ?>" class="event-card-link">
                                    <div class="event-status-process">Processing</div>
                                    <?php
                                    $coverImages = json_decode($event->cover_images, true);
                                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                    ?>
                                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?> " alt="<?= htmlspecialchars($event->event_name) ?>">
                                    <div>
                                        <div><?= htmlspecialchars($event->event_name) ?></div>
                                        <div>
                                            <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                            <div class="two-line-ellipsis">📍 <?= htmlspecialchars($event->address)?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>

                    <!-- Show More / Show Less button for Processing Events -->
                    <?php if ($processingCount > 6): ?>
                    <form method="POST" id="showMoreProcessingForm">
                        <input type="hidden" id="showMoreProcessing" name="showMoreProcessing" value="<?= $showMoreProcessing ? 'false' : 'true' ?>">
                        <button type="submit" class="view-more">
                            <?= $showMoreProcessing ? 'Show Less' : 'View More' ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>

                <!-- Scheduled Events Section -->
                <h2 class="content-header">Scheduled Events</h2>
                <div class="events-container">
                    <?php 
                    $scheduledCount = 0;

                    usort($events,function($a,$b) {
                        return strtotime($a->created_at) - strtotime($b->created_at); // corrected to use created_at for both
                    });
                    foreach ($events as $event): 
                        if ($event->status == 'scheduled'):
                            $scheduledCount++;
                            if (!$showMoreScheduled && $scheduledCount > 6) continue;
                    ?>
                            <div class="event-card">
                                <a href="<?=ROOT?>/event-planner-scheduledEvent?id=<?= htmlspecialchars($event->id) ?>" class="event-card-link" name = "update">
                                    <div class="event-status-scheduled">Scheduled</div>
                                    <?php
                                    $coverImages = json_decode($event->cover_images, true);
                                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                    ?>
                                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="<?= htmlspecialchars($event->event_name) ?>">
                                    <div>
                                        <div><?= htmlspecialchars($event->event_name) ?></div>
                                        <div>
                                            <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                            <div class="two-line-ellipsis">📍 <?= htmlspecialchars($event->address) ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>

                    <!-- Show More / Show Less button for Scheduled Events -->
                    <?php if ($scheduledCount > 6): ?>
                    <form method="POST" id="showMoreScheduledForm">
                        <input type="hidden" id="showMoreScheduled" name="showMoreScheduled" value="<?= $showMoreScheduled ? 'false' : 'true' ?>">
                        <button type="submit" class="view-more">
                            <?= $showMoreScheduled ? 'Show Less' : 'View More' ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>

                <!-- Completed Events Section -->
                <h2 class="content-header">Past Events</h2>
                <div class="events-container">
                    <?php 
                    $completedCount = 0;

                    usort($events,function($a,$b) {
                        return strtotime($a->created_at) - strtotime($b->created_at); // corrected to use created_at for both
                    });
                    foreach ($events as $event): 
                        if ($event->status == 'completed'):
                            $completedCount++;
                            if (!$showMoreCompleted && $completedCount > 6) continue;
                    ?>
                            <div class="event-card">
                                <a href="<?=ROOT?>/event-planner-completedEventInfo?id=<?= htmlspecialchars($event->id) ?>" class="event-card-link" name="completed">
                                    <div class="event-status-completed">Completed</div>
                                    <?php
                                    $coverImages = json_decode($event->cover_images, true);
                                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                    ?>
                                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="<?= htmlspecialchars($event->event_name) ?>">
                                    <div>
                                        <div><?= htmlspecialchars($event->event_name) ?></div>
                                        <div>
                                            <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                            <div class="two-line-ellipsis">📍 <?= htmlspecialchars($event->address) ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>

                    <!-- Show More / Show Less button for Completed Events -->
                    <?php if ($completedCount > 6): ?>
                    <form method="POST" id="showMoreCompletedForm">
                        <input type="hidden" id="showMoreCompleted" name="showMoreCompleted" value="<?= $showMoreCompleted ? 'false' : 'true' ?>">
                        <button type="submit" class="view-more">
                            <?= $showMoreCompleted ? 'Show Less' : 'View More' ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>
        </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
    </div>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>