<?php 
    $backPath = ROOT.'/event-planner-dashboard';
    include ('../app/views/components/header.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Scheduled Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/scheduledEvent.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/scheduledEvent.js" defer></script>
    
</head>
<body>
    <div class="container">
        <div class="chart-section">
            <h2 class="section-title">Income Over Time</h2>
            <canvas id="incomeChart" 
                data-dates='<?= json_encode($dates) ?>' 
                data-incomes='<?= json_encode($incomes) ?>'></canvas>
        </div>

        <div class="chart-section">
            <h2 class="section-title">Ticket Progress by Type</h2>
            <canvas id="ticketProgressChart" 
                data-types='<?= json_encode($ticket_types) ?>' 
                data-total='<?= json_encode($total_tickets) ?>' 
                data-sold='<?= json_encode($sold_tickets) ?>'></canvas>
        </div>

    </div>
</body>
</html>
