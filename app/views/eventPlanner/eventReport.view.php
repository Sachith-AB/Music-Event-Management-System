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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <div class="back-button">
        <!-- Include Back Button Component -->
        <?php include('../app/views/components/backbutton.view.php'); ?>
        <h1 class="usertext">Event Report</h1>
    </div>
    
    
    <div class="pdf-container">
        <div class="section-container">
            <h2>Completed Events</h2>

            <div class="filter-controls">
                <div class="filter-group">
                    <label for="pastMonth">Month:</label>
                    <select id="pastMonth" onchange="filterPastEvents()">
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
                    <label for="pastYear">Year:</label>
                    <select id="pastYear" onchange="filterPastEvents()">
                        <option value="">All Years</option>
                        <?php
                        $currentYear = date('Y');
                        for ($year = $currentYear - 5; $year <= $currentYear; $year++) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                </div>
                
                
            </div>

            <?php if(!empty($data['pastEvent'])): ?>
                <table id="pastTable">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Collaborators</th>
                            <th>Total Sold Tickets</th>
                            <th>Total Income</th>
                            <th>Total Cost</th>
                            <th>Total Revenue</th>
                            <th>Administrative Fee</th>
                            <th>Net Income</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($data['pastEvent'] as $event): ?>
                            <tr class="past-event-row">
                                <td><?= htmlspecialchars($event->event_name) ?></td>
                                <td><?= htmlspecialchars($event->eventDate) ?></td>
                                <td><?= htmlspecialchars($event->collaborators) ?></td>
                                <td><?= htmlspecialchars($event->total_sold_tickets) ?></td>
                                <td><?= htmlspecialchars(number_format($event->total_income, 2)) ?></td>
                                <td><?= htmlspecialchars(number_format($event->total_cost, 2)) ?></td>
                                <td><?= htmlspecialchars(number_format($event->total_revenue, 2)) ?></td>
                                <td><?= htmlspecialchars(number_format($event->administrative_fee, 2)) ?></td>
                                <td><?= htmlspecialchars(number_format($event->net_income, 2)) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <button class="print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>

    <script>
        function filterPastEvents() {
            const month = document.getElementById('pastMonth').value;
            const year = document.getElementById('pastYear').value;
            
            const rows = document.querySelectorAll('.past-event-row');
            
            rows.forEach(row => {
                const eventDateCell = row.querySelector('td:nth-child(2)'); // Get the date cell
                const eventDate = eventDateCell.textContent.trim();
                const [eventYear, eventMonth] = eventDate.split('-');
                
                const monthMatch = !month || eventMonth === month;
                const yearMatch = !year || eventYear === year;
                
                if (monthMatch && yearMatch) {
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