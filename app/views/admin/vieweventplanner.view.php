<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <?php include ('../app/views/components/loading.php');  
    $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false; 
    $showMoreForPurchase = isset($_POST['showMoreForPurchase']) ? $_POST['showMoreForPurchase'] == 'true' : false;

    ?>
    <div class="dash-content-eventplannerview">
        
        <?php if (!empty($events)): ?>
            <div class="dashboard">
                <div class="back-button">
                    <div>
                        <!-- Include Back Button Component -->
                        <?php include('../app/views/components/backbutton.view.php'); ?>
                    </div>
                    
                    <div class="header">
                        <h1>Dashboard</h1>
                    </div>
                </div>
                

                <div class="stats">
                    <div class="stat-item">
                        <div class="dolar-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h2 class="dolar-h2"><?= htmlspecialchars($totalRevenue) ?></h2>
                        <p>Revenue</p>
                    </div>
                    <div class="stat-item">
                        <div class="ticket-icon">
                            <i class="fas fa-ticket"></i>
                        </div>
                        <h2 class="ticket-h2"><?= htmlspecialchars($totalTicketsSold) ?>/<?= htmlspecialchars($totalTicket) ?></h2>
                        <p>Tickets Sold</p>
                    </div>
                    <div class="stat-item">
                        <div class="viewer-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h2 class="viewer-h2"><?= htmlspecialchars($totalEvents) ?></h2>
                        <p>Events</p>
                    </div>
                    <div class="stat-item">
                        <div class="share-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="share-h2"><?= htmlspecialchars($totalEventBuyers) ?></h2>
                        <p>Ticket Buyers</p>
                    </div>
                </div>

                <div class="section sales">
                    <h3>Sales by event</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Date of the Event</th>
                                <th>Ticket Sold</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php 
                            // Limit events to 3 if showMore is false
                            $maxEvents = $showMore ? count($events) : 3;
                            $eventsDisplayed = 0;
                            foreach ($events as $event): 
                                if ($eventsDisplayed >= $maxEvents) break;
                                $eventsDisplayed++;
                            ?>
                                <tr>
                                    <td>
                                        <div class="event-info">
                                            <?php
                                            $coverImages = json_decode($event->cover_images, true);
                                            $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                            ?>
                                            <img class="eventimage" src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Image">
                                            <?= htmlspecialchars($event->event_name) ?>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars(explode(" ", $event->start_time)[0]) ?></td>
                                    <td><?= htmlspecialchars($event->sold_quantity) ?>/<?= htmlspecialchars($event->total_quantity) ?></td>
                                    <td>LKR <?= htmlspecialchars($event->total_revenue) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                    <!-- Show More / Show Less button -->
                    <form method="POST" id="showMoreForm">
                        <input type="hidden" id="showMore" name="showMore" value="<?= $showMore ? 'true' : 'false' ?>">
                        <?php if (count($data) > 3): ?>
                            <button type="button" class="view-more" onclick="handleShowMore()">
                                <?= $showMore ? 'Show Less' : 'View More' ?>
                            </button>
                        <?php endif; ?>
                    </form>
                </div>
                

                <div class="section purchases">
                    <h3>Recent purchases</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Buyer</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Ticket Sold</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Limit events to 3 if showMore is false
                                $maxEvents = $showMoreForPurchase ? count($eventBuyers) : 3;
                                $eventsDisplayedForPurchase = 0;
                                foreach ($eventBuyers as $eventBuyer): 
                                    if ($eventsDisplayedForPurchase >= $maxEvents) break;
                                    $eventsDisplayedForPurchase++;
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($eventBuyer->event_name) ?></td>
                                    <td><?= htmlspecialchars($eventBuyer->buyer_Fname) ?> <?= htmlspecialchars($eventBuyer->buyer_Lname) ?></td>
                                    <td><?= htmlspecialchars(explode(" ", $eventBuyer->buy_time)[0]) ?></td>
                                    <td><?= htmlspecialchars(explode(" ", $eventBuyer->buy_time)[1]) ?></td>
                                    <td><?= htmlspecialchars($eventBuyer->ticket_quantity) ?></td>
                                    <td><?= htmlspecialchars($eventBuyer->ticket_quantity * $eventBuyer->price) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Show More / Show Less button -->
                    <form method="POST" id="showMoreForPurchaseForm">
                        <input type="hidden" id="showMoreForPurchase" name="showMoreForPurchase" value="<?= $showMoreForPurchase ? 'true' : 'false' ?>">
                        <?php if (count($data) > 3): ?>
                            <button type="button" class="view-more" onclick="handleshowMoreForPurchase()">
                                <?= $showMoreForPurchase ? 'Show Less' : 'View More' ?>
                            </button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>


        <div class='dashboard'>
            <!-- Comments Section -->
                
            <h2 class="comments-h2">Comments</h2>
            <div class="comments-container">
                <!-- Comment Input -->
                <?php if($_SESSION['USER']->id != $_GET['id']): ?>
                    <form id="addcomments" method="POST">
                        <div class="add-comment">
                            <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="User Avatar" class="comment-avatar">
                            <input type="hidden" name="receiver_id" value="<?php echo $_GET['id'] ?>"/>
                            <input type="hidden" name="sender_id" value="<?php echo $_SESSION['USER']->id ?>"/>
                            <textarea class="comment-input" name="content" placeholder="Add a comment..."></textarea>                                <button name="add_comment" class="post-comment-btn">Submit</button>
                        </div>
                    </from>
                <?php endif;?>
                <?php if (!empty($commentsForUser)): ?>
                    <!-- Comments -->
                    <?php foreach ($commentsForUser as $comment): ?>
                        <div class="comment">
                            <img src="<?=ROOT?>/assets/images/user/<?php echo $comment->sender_pro_pic ?>" alt="User Avatar" class="comment-avatar">
                            <div class="comment-content">
                                <div class="comment-header">
                                    <span class="comment-author"><?php echo $comment->sender_name ?></span>
                                    <span class="comment-date"><?= date('jS F Y, H:i A', strtotime($comment->created_at)) ?></span>
                                </div>
                                <p class="comment-text"><?php echo htmlspecialchars($comment->content) ?></p>
                                <!-- <div class="comment-actions">
                                    <button class="like-btn">👍 <?php echo $comment->num_likes ?></button>
                                    
                                </div> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                
                <?php endif; ?>

            </div>
        
        </div>
        </div>
    <script>
        // JavaScript function to handle the "View More" / "Show Less" button
        function handleShowMore() {
            const showMoreInput = document.getElementById('showMore');
            showMoreInput.value = showMoreInput.value === 'true' ? 'false' : 'true';
            document.getElementById('showMoreForm').submit();
        }
        function handleshowMoreForPurchase() {
            const showMoreInput = document.getElementById('showMoreForPurchase');
            showMoreInput.value = showMoreInput.value === 'true' ? 'false' : 'true';
            document.getElementById('showMoreForPurchaseForm').submit();
        }
    </script>
    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
<?php include ('../app/views/components/footer.php'); ?>
</html>
