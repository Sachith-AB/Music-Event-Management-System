<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/ticketstyle.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/popupmodal-style.css">
</head>
<body>
    <!-- Include Header -->
    <?php include ('../app/views/components/Header.php'); ?>

    <?php if (!empty($pro_pic)&&!empty($username)&&!empty($email)&&!empty($combinedTickets)): ?>
        <div class="upcommingeve-container">
            <div class="upcommingeve-profile">
                <img src=<?= htmlspecialchars($pro_pic) ?> alt="Profile Picture">
                <h3><?= htmlspecialchars($username) ?></h3>
                <p><?= htmlspecialchars($email) ?></p>
                <button>Go to profile</button>
            </div>

            <div class="upcommingeve-tickets">
                <h2>My Tickets</h2>

                <!--<div class="upcommingeve-tabs">
                    <span class="upcommingeve-tab active">Upcoming</span>
                    <span class="upcommingeve-tab">Used</span>
                </div>-->
                <?php foreach ($combinedTickets as $event): ?>
                    <div class="upcommingeve-ticket-card">
                        <div class="upcommingeve-ticket-image">
                            <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Event Image">
                        </div>
                        <div class="upcommingeve-ticket-info">
                            <h3><?= htmlspecialchars($event[0]->event_name) ?>: <?= htmlspecialchars($event[0]->event_description) ?></h3>
                            <p><?= htmlspecialchars(date("l, F d | h:i A", strtotime($event[0]->event_date))) ?></p>
                            <p><?= htmlspecialchars($event[0]->event_city) ?>, <?= htmlspecialchars($event[0]->event_province) ?></p>
                            <div class="upcommingeve-ticket-meta"><?= htmlspecialchars($event['ticket_quantity']) ?> Tickets - LKR<?= htmlspecialchars($event['ticket_quantity'] * $event[0]->ticket_price) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>No events created yet.</p>
    <?php endif; ?>

    <!--recommended event section-->
    <div class="event-details-container">

        <h2>Recommonded Events</h2>
        <?php if (!empty($recentevents)): ?>
                <div class="musicevent-events-container">
                    <?php foreach ($recentevents as $event): ?>
                        <div class="musicevent-event-card">
                            <!-- <div class="musicevent-event-badge">20% OFF</div> -->
                            <img src=<?= htmlspecialchars($event->cover_images) ?> alt="Musical Fusion Festival" class="musicevent-event-image">
                            <div class="musicevent-event-info">
                                <div class="musicevent-event-title"><?= htmlspecialchars($event->event_name) ?></div>
                                <div class="musicevent-event-details">
                                    <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                    <div>📍 <?= htmlspecialchars($event->city) ?>, <?= htmlspecialchars($event->province) ?></div>
                                </div>
                                <!-- <div class="musicevent-event-price">From $80</div> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            
                <a href="#" class="view-more">View more</a>
            <?php else: ?>
                <p>No events created yet.</p>
            <?php endif; ?>
    </div>
</body>
 