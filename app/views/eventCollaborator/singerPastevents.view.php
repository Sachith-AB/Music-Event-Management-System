<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Future Evnets</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators\singerfutureevents.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/collaborator/singersidebar.php');  ?>
        <div class="dashboard">

                <div class="events-container">
                        
                        <?php if(!empty($data)): ?>

                            <?php foreach($data as $event): ?>

                                <div class="event-card">
                                    <a href="<?=ROOT?>/view-pastevent?id=<?php echo htmlspecialchars($event->id)?>&sender_id=<?php echo htmlspecialchars($_SESSION['USER']->id)?>" class="event-card-link">
                                       
                                        <?php
                                        $coverImages = json_decode($event->cover_images, true);
                                        $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                        ?>
                                        <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" >
                                        <div class = "event-details" >

                                            <div>🎤 <?php echo htmlspecialchars($event->event_name); ?></div>
                                            <div>
                                                <div>📅 <?php echo htmlspecialchars(date('l, d F Y', strtotime($event->eventDate))); ?> </div>
                                                <div>📍 <?php echo htmlspecialchars($event->address); ?> </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            
                            <?php endforeach; ?>

                        <?php else: ?>

                                <div> No any Events in the Future </div>

                        <?php endif; ?>
                            
                            
                </div>

        </div>
    </div>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>