<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashboard.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>

        <?php if (!empty($events)): ?>
            <div class="dashboard">
                <div class="header">
                    <h1>Dashboard</h1>
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
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td>
                                        <div class="event-info">
                                            <img class="eventimage" src=<?= htmlspecialchars($event->cover_images) ?> alt="Event Image">
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
                            <?php foreach ($eventBuyers as $eventBuyer): ?>
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
                </div>
            </div>
        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>
        
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
