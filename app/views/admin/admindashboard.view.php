<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/admindashboard.css">
</head>
<body>
    <?php $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false;
    $showMorePast = isset($_POST['showMorePast']) ? $_POST['showMorePast'] == 'true' : false;
    $showMoreScheduled = isset($_POST['showMoreScheduled']) ? $_POST['showMoreScheduled'] == 'true' : false; ?>
    <!-- Include Header -->
    
    <div class="dash-container">
    <!-- Sidebar -->
    <?php include('../app/views/components/admin/dashsidebar.php'); ?>
    <div class="dashboard">
        <h2 class="content-header">Processing Events</h2>
        <div class="events-container">
            <!-- Upcoming Events Dummy Data -->
            
            <?php if(!empty($data['processing'])): ?>

                <?php 
                    $maxEvents = $showMore ? count($data['processing']) : 6;
                    $eventsDisplayed = 0;
                    
                    usort($data['processing'], function($a, $b) {
                        return strtotime($a->created_at) - strtotime($b->created_at);
                    });
                    foreach($data['processing'] as $event): 
                        if ($eventsDisplayed >= $maxEvents) break;
                                    $eventsDisplayed++;
                ?>

                            <div class="event-card">

                                <?php
                                $coverImages = json_decode($event->cover_images, true);
                                $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                ?>
                                <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Image">
                                <div>
                                    <div><?php echo $event->event_name?></div>
                                    <div>
                                        <div>📅 <?php echo $event->eventDate?> | <?php echo substr($event->start_time, 11);?> </div>
                                        <div class="two-line-ellipsis">📍 Location:  <?php echo $event->address?> </div>
                                        <div>👤 Created By: <?php echo $event->user_name ?> </div>
                                    </div>
                                </div>
                                <div class="event-card-icons">
                                    <a class="event-card-icons-a" href="<?=ROOT?>/view-event?id=<?php echo $event->event_id ?>" ><i class="fas fa-eye"></i></a>

                                        <form method="post">
                                            <input type="hidden" name="event_id" value="<?php echo $event->event_id ?>">
                                            <input type="hidden" name="is_delete" value="1">
                                            <button class="event-card-icons-b" type="button" onclick="showConfirmation(this.form)"><i class="fas fa-trash"></i></button>
                                        </form>
                                </div>
                            </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p> No processing events events yet </p>

            <?php endif; ?>

        </div>
        
        <!-- Show More / Show Less button -->
        <form method="POST" id="showMoreForm">
            <input type="hidden" id="showMore" name="showMore" value="<?= $showMore ? 'true' : 'false' ?>">
            <?php if (count($data['processing']) > 6): ?>
                <button type="button" class="view-more" onclick="handleShowMore()">
                    <?= $showMore ? 'Show Less' : 'View More' ?>
                </button>
            <?php endif; ?>
        </form>
        <script>
            // JavaScript function to handle the "View More" / "Show Less" button
            function handleShowMore() {
                const showMoreInput = document.getElementById('showMore');
                showMoreInput.value = showMoreInput.value === 'true' ? 'false' : 'true';
                document.getElementById('showMoreForm').submit();
            }
        </script>

        <!-- <div class="view-more">
            <a href="#" class ="view-more-events">View More Upcoming Events</a>
        </div> -->

        <!-- <script>
            const viewMoreBtn = document.querySelector('.view-more-events');
            let currentItem = 6;

            viewMoreBtn.onclick = () => {
                let cards = [...document.querySelectorAll('.event-card')];
                for( var i = currentItem; i < currentItem + 6; i++){
                    cards[i];
                }
                
                currentItem += 6;

                if(currentItem >= cards.length){
                    viewMoreBtn.style.display = 'none';
                }

            }
        </script> -->

        <h2 class="content-header"><br>Scheduled Events</h2>
        <div class="events-container">
            <?php if(!empty($data['scheduled'])): ?>
                <?php 
                    $maxEventsScheduled = $showMoreScheduled ? count($data['scheduled']) : 6;
                    $eventsDisplayedScheduled = 0;

                    usort($data['scheduled'], function($a, $b) {
                        return strtotime($a->created_at) - strtotime($b->created_at);
                    });

                    foreach($data['scheduled'] as $event): 
                        if ($eventsDisplayedScheduled >= $maxEventsScheduled) break;
                                    $eventsDisplayedScheduled++;
                        ?>
                    <div class="event-card">
                        <?php
                        $coverImages = json_decode($event->cover_images, true);
                        $firstImage = $coverImages[0] ?? ''; // fallback if empty
                        ?>
                        <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Image">
                        <div>
                            <div><?php echo $event->event_name ?></div>
                            <div>📅 <?php echo $event->eventDate ?> | <?php echo substr($event->start_time, 11) ?></div>
                            <div class="two-line-ellipsis">📍 Location: <?php echo $event->address ?></div>
                            <div>👤 Created By: <?php echo $event->user_name ?></div>
                            <div class="star-rating">
                                <?php 
                                $eventModel = new Event();
                                $rating = $event->average_rating ?? 0;
                                echo $eventModel->getStarRating($rating);
                                ?>
                                <span class="rating-text"></span>
                            </div>
                        </div>
                        <div class="event-card-icons">
                            <a class="event-card-icons-a" href="<?=ROOT?>/view-event?id=<?php echo $event->event_id ?>" > <i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p> No scheduled events yet </p>
            <?php endif; ?>
        </div>

        <!-- Show More / Show Less button -->
        <form method="POST" id="showMoreFormScheduled">
            <input type="hidden" id="showMoreScheduled" name="showMoreScheduled" value="<?= $showMoreScheduled ? 'true' : 'false' ?>">
            <?php if (count($data['scheduled']) > 6): ?>
                <button type="button" class="view-more" onclick="handleShowMoreScheduled()">
                    <?= $showMoreScheduled ? 'Show Less' : 'View More' ?>
                </button>
            <?php endif; ?>
        </form>
        <script>
            function handleShowMoreScheduled() {
                const showMoreInput = document.getElementById('showMoreScheduled');
                showMoreInput.value = showMoreInput.value === 'true' ? 'false' : 'true';
                document.getElementById('showMoreFormScheduled').submit();
            }
        </script>


        <h2 class="content-header"><br>Past Events</h2>
        <div class="events-container">
            <!-- Already Held Events Dummy Data -->

            <?php if (!empty($data['held']) && count($data['held']) > 0): ?>

                <?php 
                    $maxEventsPast = $showMorePast ? count($data['held']) : 6;
                    $eventsDisplayedPast = 0;
                    foreach ($data['held'] as $event): 
                        if ($eventsDisplayedPast >= $maxEventsPast) break;
                        $eventsDisplayedPast++;
                ?>

                    <div class="event-card">
                        <?php
                        $coverImages = json_decode($event->cover_images, true);
                        $firstImage = $coverImages[0] ?? ''; // fallback if empty
                        ?>
                        <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Image">
                        <div>
                            <div><?php echo $event->event_name ?></div>
                            <div>
                                <div>📅 <?php echo $event->eventDate ?>| <?php echo substr($event->start_time, 11) ?></div>
                                <div class="two-line-ellipsis">📍 Location: <?php echo $event->address ?></div>
                                <div>👤 Created By: <?php echo $event->user_name ?></div>
                                <div class="star-rating">
                                    <?php 
                                    $eventModel = new Event();
                                    $rating = $event->average_rating ?? 0;
                                    echo $eventModel->getStarRating($rating);
                                    ?>
                                    <span class="rating-text"></span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-icons">
                            <a href="<?=ROOT?>/view-pastevent?id=<?php echo $event->event_id ?>" > <i class="fas fa-eye"></i></a>
                            
                        </div>
                    </div>

        <?php endforeach; ?>

        <?php else : ?>
        <p>No past events yet.</p>
        <?php endif; ?>

        </div>

        <!-- Show More / Show Less button -->
        <form method="POST" id="showMoreFormPast">
            <input type="hidden" id="showMorePast" name="showMorePast" value="<?= $showMorePast ? 'true' : 'false' ?>">

            <?php if (isset($data['held']) && is_array($data['held']) && count($data['held']) > 6): ?>
                <button type="button" class="view-more" onclick="handleShowMorePast()">
                    <?= $showMorePast ? 'Show Less' : 'View More' ?>
                </button>
            <?php endif; ?>
        </form>

        <script>
            // JavaScript function to handle the "View More" / "Show Less" button
            function handleShowMorePast() {
                const showMoreInput = document.getElementById('showMorePast');
                showMoreInput.value = showMoreInput.value === 'true' ? 'false' : 'true';
                document.getElementById('showMoreFormPast').submit();
            }
        </script>
    </div>
</div>
            <!-- Confirmation Modal -->
            <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; 
                width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); 
                justify-content: center; align-items: center; z-index: 1000;">
                <div style="background: white; padding: 20px; border-radius: 8px; text-align: center;">
                        <p class="confirm-message">Are you sure you want to delete this event?</p>
                        <button class="confirm-btn submit-btn" onclick="submitConfirmedForm()">Yes</button>
                        <button class="confirm-btn cancel-btn" onclick="closeModal()">No</button>
                </div>
            </div>

            <script>
                let currentForm = null;

                function showConfirmation(form) {
                    currentForm = form;
                    document.getElementById('confirmModal').style.display = 'flex';
                }

                function closeModal() {
                    document.getElementById('confirmModal').style.display = 'none';
                    currentForm = null;
                }

                function submitConfirmedForm() {
                    if (currentForm) {
                        currentForm.submit();
                    }
                    closeModal();
                }

                function confirmDelete(form) {
                    // Prevent default submit and show confirmation modal instead
                    return false;
                }
            </script>

</body>
</html>