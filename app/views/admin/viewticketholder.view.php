<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket holder Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/viewticketholder.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <script src="<?=ROOT?>/assets/js/ticket_holder/profile.js"></script>
    <?php 
    include ('../app/views/components/loading.php');
    // Set default value for showMore if not set
    $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false; 
    ?>
    <?php //$id = $_SESSION['USER']->id;

    $success = htmlspecialchars($_GET['msg'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 0);
    //show($_SESSION['USER']);
    
    ?>
    <div class="page-content">
        <div class="all">
            <div class="container">
                <h2>My Profile</h2>
                <div class="avatar">
                    <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="user image">        
                </div>
                <div class="details">
                    <h2 class="head2"><?php echo $_SESSION['USER']->name ?></h2>
                    <h3 class="head3"><?php echo $_SESSION['USER']->email ?></h3>
                    <h3 class="head3"><?php  echo $_SESSION['USER']->contact ?></h3>
                </div>
                <div class="tag">
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[0]) ?> events</div>
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[1]) ?> tickets</div>
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[2]) ?> price</div>
                </div>
            </div>
            <div class="upcommingeve-tickets">
                <div class="content">
                    <h2 class="content-header">Past Events</h2>
                    <div class="events-container">
                        <?php foreach ($pastTickets as $event): ?>
                            
                            <div class="event-card">
                                <a href="<?=ROOT?>/event-planner-viewEvent?id=<?= htmlspecialchars($event[0]->id) ?>" class="event-card-link">
                                    <div class="event-status-process"><?= htmlspecialchars($event[0]->ticket_type) ?> - LKR<?= htmlspecialchars($event[0]->ticket_price) ?></div>
                                    <?php
                                    $coverImages = json_decode($event[0]->cover_images, true);
                                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                    ?>
                                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="<?= htmlspecialchars($event[0]->event_name) ?>">
                                    <div>
                                        <div><?= htmlspecialchars($event[0]->event_name) ?></div>
                                        <div>
                                            <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event[0]->event_date))) ?></div>
                                            <div class="two-line-ellipsis">📍 <?= htmlspecialchars($event[0]->address)?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                                
                            
                        <?php endforeach; ?>
                    </div>


                    <!-- futureevents -->
                    <h2 class="content-header">Future Events</h2>
                    <div class="events-container">
                        <?php if (!empty($upcomingTickets)): ?>
                            <?php foreach ($upcomingTickets as $event): ?>
                                
                                <div class="event-card">
                                    <a href="<?=ROOT?>/event-planner-viewEvent?id=<?= htmlspecialchars($event[0]->id) ?>" class="event-card-link">
                                        <div class="event-status-process"><?= htmlspecialchars($event[0]->ticket_type) ?> - LKR<?= htmlspecialchars($event[0]->ticket_price) ?></div>
                                        <?php
                                        $coverImages = json_decode($event[0]->cover_images, true);
                                        $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                        ?>
                                        <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="<?= htmlspecialchars($event[0]->event_name) ?>">
                                        <div>
                                            <div><?= htmlspecialchars($event[0]->event_name) ?></div>
                                            <div>
                                                <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event[0]->event_date))) ?></div>
                                                <div class="two-line-ellipsis">📍 <?= htmlspecialchars($event[0]->address)?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                    
                                
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>