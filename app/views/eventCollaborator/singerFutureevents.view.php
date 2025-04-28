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
    <script src="<?=ROOT?>/assets/js/singerfutureevent.js"></script>
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/collaborator/singersidebar.php');  ?>
        <div class="dashboard">

                <div class="events-container">
                        
                        <?php if(!empty($data)): ?>

                            <?php foreach($data as $event): ?>
                                <div class="event-card">
                                    <?php
                                    $coverImages = json_decode($event->cover_images, true);
                                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                    ?>
                                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" >

                                    <!-- Floating Flag Button -->
                                    <div class="flag-btn" onclick="openNoteModal(<?= $event->id ?>)">📝</div>
                                    <a href="<?=ROOT?>/collaborator-eventdetails?event_id=<?php echo htmlspecialchars($event->id)?>&sender_id=<?php echo htmlspecialchars($_SESSION['USER']->id)?>" class="event-card-link">
                                        <div class="event-details">
                                            <div>🎤 <?php echo htmlspecialchars($event->event_name); ?></div>
                                            <div>
                                                <div>📅 <?php echo htmlspecialchars(date('l, d F Y', strtotime($event->eventDate))); ?> </div>
                                                <div>📍 <?php echo htmlspecialchars($event->address); ?> </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Note Modal for each event -->
                                <div id="noteModal<?= $event->id ?>" class="modal-wrapper hidden">
                                    <div class="modal">
                                        <button class="close-btn" onclick="closeNoteModal(<?= $event->id ?>)">×</button>
                                        <form method="POST">
                                            <h2>Add a Note for Your Event</h2>
                                            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event->id); ?>">
                                            <textarea id="noteText" name="noteText" placeholder="Write your important note here..." rows="6">
                                                <?= isset($event->note) ? htmlspecialchars($event->note) : '' ?>
                                            </textarea>
                                            <button class="save-btn" name="save_note">Save Note</button>
                                        </form>
                                    </div>
                                </div>

                                <script>
                                    function openNoteModal(eventId) {
                                        const modal = document.getElementById("noteModal" + eventId); // Use the eventId to find the correct modal
                                        const eventIdInput = modal.querySelector("input[name='event_id']");
                                        
                                        // Set the event_id value dynamically based on the event clicked
                                        eventIdInput.value = eventId;

                                        // Show the modal
                                        modal.classList.remove("hidden");
                                    }

                                    function closeNoteModal(eventId) {
                                        const modal = document.getElementById("noteModal" + eventId);
                                        modal.classList.add("hidden");
                                    }
                                </script>


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