<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Event Report</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Admin Event Report</h1>

    <div class = "pdf-container">

    <!-- Upcoming Events Table -->
    <h2>Upcoming Events</h2>
    <?php if (!empty($data['upcoming'])): ?>
        <table>
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
                    <tr>
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

    <!-- Past Events Table -->
    <h2>Past Events</h2>
    <?php if (!empty($data['PastEvent'])): ?>
        <table>
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
                    <tr>
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


    <button class = "print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>

    <script>
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