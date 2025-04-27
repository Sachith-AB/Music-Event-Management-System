<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Event Report</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="back-button">
        <?php include('../app/views/components/backbutton.view.php'); ?>
        <h1 class="usertext">Event Report</h1>
    </div>

    <div class="pdf-container">
        <!-- Upcoming Events Section -->
        <div class="section-container">

            <h2>Upcoming Events</h2>
            
           

            <?php if (!empty($data['upcoming'])): ?>
                <table id="upcomingTable">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Planner Name</th>
                            <th>Collaborators</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['upcoming'] as $event): ?>
                            <tr class="upcoming-event-row" 
                                data-date="<?= htmlspecialchars(explode(" ", $event->eventDate)[0]) ?>"
                                data-planner="<?= htmlspecialchars($event->event_planner_id) ?>">
                                <td><?php echo htmlspecialchars($event->event_name); ?></td>
                                <td><?php echo htmlspecialchars($event->eventDate); ?></td>
                                <td><?php echo htmlspecialchars($event->event_planner_name); ?></td>
                                <td><?php echo htmlspecialchars($event->collaborators ?? 'None'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No upcoming events found.</p>
            <?php endif; ?>
        </div>

        <!-- Past Events Section -->
        <div class="section-container">
            <h2>Past Events</h2>
            
            <!-- Past Events Filter Controls -->
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="pastMonth">Month:</label>
                    <select id="pastMonth" onchange="filterPastEvents()">
                        <option value="">All Months</option>
                        <?php
                        foreach ($months as $num => $name) {
                            echo "<option value='$num'>$name</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="pastYear">Year:</label>
                    <select id="pastYear" onchange="filterPastEvents()">
                        <option value="">All Years</option>
                        <?php
                        for ($year = $currentYear; $year >= $currentYear - 5; $year--) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="pastPlanner">Event Planner:</label>
                    <select id="pastPlanner" onchange="filterPastEvents()">
                        <option value="">All Planners</option>
                        <?php if (!empty($data['planners'])): ?>
                            <?php foreach ($data['planners'] as $planner): ?>
                                <?php if($planner->role == 'planner'): ?>
                                    <option value="<?= htmlspecialchars($planner->id) ?>">
                                        <?= htmlspecialchars($planner->name) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <?php if (!empty($data['PastEvent'])): ?>
                <table id="pastTable">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Planner Name</th>
                            <th>Collaborators</th>
                            <th>Total Sold Tickets</th>
                            <th>Total Income</th>
                            <th>Total Payments</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['PastEvent'] as $event): ?>
                            <tr class="past-event-row" 
                                data-date="<?= htmlspecialchars(explode(" ", $event->eventDate)[0]) ?>"
                                data-planner="<?= htmlspecialchars($event->event_planner_id) ?>">
                                <td><?php echo htmlspecialchars($event->event_name); ?></td>
                                <td><?php echo htmlspecialchars($event->eventDate); ?></td>
                                <td><?php echo htmlspecialchars($event->event_planner_name); ?></td>
                                <td><?php echo htmlspecialchars($event->collaborators ?? 'None'); ?></td>
                                <td><?php echo htmlspecialchars($event->total_sold_tickets); ?></td>
                                <td><?php echo number_format($event->total_income, 2); ?></td>
                                <td><?php echo number_format($event->total_payments, 2); ?></td>
                                <td><?php echo number_format($event->total_income - $event->total_payments, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No past events found.</p>
            <?php endif; ?>
        </div>
    </div>

    <button class="print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>

    <script>
        function filterUpcomingEvents() {
            const month = document.getElementById('upcomingMonth').value;
            const year = document.getElementById('upcomingYear').value;
            const planner = document.getElementById('upcomingPlanner').value;
            
            const rows = document.querySelectorAll('.upcoming-event-row');
            
            rows.forEach(row => {
                const eventDate = row.getAttribute('data-date');
                const eventPlanner = row.getAttribute('data-planner');
                
                const [eventYear, eventMonth] = eventDate.split('-');
                
                const monthMatch = !month || eventMonth === month;
                const yearMatch = !year || eventYear === year;
                const plannerMatch = !planner || eventPlanner === planner;
                
                if (monthMatch && yearMatch && plannerMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterPastEvents() {
            const month = document.getElementById('pastMonth').value;
            const year = document.getElementById('pastYear').value;
            const planner = document.getElementById('pastPlanner').value;
            
            const rows = document.querySelectorAll('.past-event-row');
            
            rows.forEach(row => {
                const eventDate = row.getAttribute('data-date');
                const eventPlanner = row.getAttribute('data-planner');
                
                const [eventYear, eventMonth] = eventDate.split('-');
                
                const monthMatch = !month || eventMonth === month;
                const yearMatch = !year || eventYear === year;
                const plannerMatch = !planner || eventPlanner === planner;
                
                if (monthMatch && yearMatch && plannerMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function print() {
            const pdfContainer = document.querySelector('.pdf-container'); 
            const newWindow = window.open('', '_blank'); 
            newWindow.document.write('<html><head><title>Musicial - Event Report</title>');
            newWindow.document.write('<link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">'); 
            newWindow.document.write('</head><body>');
            newWindow.document.write(pdfContainer.innerHTML);
            newWindow.document.write('</body></html>');
            newWindow.document.close(); 
            
            newWindow.onload = function() {
                newWindow.print(); 
                newWindow.close(); 
            };
        }
    </script>
</body>

</html>