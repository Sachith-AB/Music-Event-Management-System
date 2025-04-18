<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    
    <?php include ('../app/views/components/loading.php');  ?>
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>

        <?php if (!empty($events)): ?>
            <div class="dashboard">
                <div class="back-button">
                    <!-- Include Back Button Component -->
                    <?php include('../app/views/components/backbutton.view.php'); ?>
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
                    
                    <!-- Filter Controls -->
                    <div class="filter-controls">
                        <div class="filter-group">
                            <label for="filterMonth">Month:</label>
                            <select id="filterMonth" onchange="filterEvents()">
                                <option value="">All Months</option>
                                <?php
                                $months = [
                                    '01' => 'January', '02' => 'February', '03' => 'March',
                                    '04' => 'April', '05' => 'May', '06' => 'June',
                                    '07' => 'July', '08' => 'August', '09' => 'September',
                                    '10' => 'October', '11' => 'November', '12' => 'December'
                                ];
                                foreach ($months as $num => $name) {
                                    echo "<option value='$num'>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="filterYear">Year:</label>
                            <select id="filterYear" onchange="filterEvents()">
                                <option value="">All Years</option>
                                <?php
                                $currentYear = date('Y');
                                for ($year = $currentYear; $year >= $currentYear - 5; $year--) {
                                    echo "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="filterName">Event Name:</label>
                            <input type="text" id="filterName" onkeyup="filterEvents()" placeholder="Search by event name">
                        </div>
                    </div>

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
                                <tr class="event-row" data-date="<?= htmlspecialchars(explode(" ", $event->start_time)[0]) ?>" data-name="<?= strtolower(htmlspecialchars($event->event_name)) ?>">
                                    <td>
                                        <div class="event-info">
                                            <img class="eventimage" src='<?=ROOT?>/assets/images/events/<?php echo esc($event->cover_images) ?>' alt="Event Image">
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

                <script>
                    function filterEvents() {
                        const month = document.getElementById('filterMonth').value;
                        const year = document.getElementById('filterYear').value;
                        const name = document.getElementById('filterName').value.toLowerCase().trim();
                        
                        const rows = document.querySelectorAll('.event-row');
                        
                        rows.forEach(row => {
                            const eventDate = row.getAttribute('data-date');
                            const eventName = row.getAttribute('data-name');
                            
                            const [eventYear, eventMonth] = eventDate.split('-');
                            
                            const monthMatch = !month || eventMonth === month;
                            const yearMatch = !year || eventYear === year;
                            const nameMatch = !name || eventName.includes(name);
                            
                            if (monthMatch && yearMatch && nameMatch) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }
                </script>

                <!-- <div class="section purchases">
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
                </div> -->
            </div>
        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>
        
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>