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
    <div class="pdf-container">
    <h1>Admin Ticket Report</h1>
    <?php
    // Group ticket data by event_name
    $groupedTickets = [];
    foreach ($data['ticket'] as $ticket) {
        $eventName = htmlspecialchars($ticket->event_name);
        if (!isset($groupedTickets[$eventName])) {
            $groupedTickets[$eventName] = [];
        }
        $groupedTickets[$eventName][] = $ticket;
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Ticket Type</th>
                <th>Ticket Price</th>
                <th>Total Tickets Made</th>
                <th>Available Quantity</th>
                <th>Sold Tickets</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupedTickets as $eventName => $tickets): ?>
                <?php $firstTicket = true; ?>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <?php if ($firstTicket): ?>
                            <!-- Display event name only for the first ticket type -->
                            <td rowspan="<?= count($tickets) ?>">
                                <?= $eventName ?>
                            </td>
                            <?php $firstTicket = false; ?>
                        <?php endif; ?>
                        <td><?= htmlspecialchars($ticket->ticket_type) ?></td>
                        <td class="currency"><?= number_format($ticket->ticket_price, 2) ?></td>
                        <td><?= htmlspecialchars($ticket->total_tickets_made) ?></td>
                        <td><?= htmlspecialchars($ticket->available_quantity) ?></td>
                        <td><?= htmlspecialchars($ticket->sold_tickets) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <button class = "print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>

    <script>
        function print() {
            const pdfContainer = document.querySelector('.pdf-container'); 
            const newWindow = window.open('', '_blank'); 
            newWindow.document.write('<html><head><title>Musicial - Ticket Report</title>');
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