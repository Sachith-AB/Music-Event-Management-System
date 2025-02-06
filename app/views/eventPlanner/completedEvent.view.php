<?php 

    //Retriving the data from the session
    $event_name = $_SESSION['event_data']['event_name']?? '';
    $audience = $_SESSION['event_data']['audience']?? '';
    $address= $_SESSION['event_data']['address']?? '';
    $eventDate = $_SESSION['event_data']['event_date']?? '';
    $start_time = $_SESSION['event_data']['start_time']?? '';
    $end_time = $_SESSION['event_data']['end_time']?? '';
    $pricing = $_SESSION['event_data']['pricing']?? '';
    $type = $_SESSION['event_data']['type']?? '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Scheduled Event</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventplanner/completed.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class = "pdf-container">
<div class="container">
    <div class="left-section">
        <h1>Event Details</h1>
        <div class="details">
            <div class="event-detail">
                <h3>Event Name:</h3>
                <p><?= htmlspecialchars($data['event']->event_name); ?></p>
            </div>
            <div class="event-detail">
                <h3>Event Audience:</h3>
                <p><?= htmlspecialchars($data['event']->audience); ?></p>
            </div>
            <div class="event-detail">
                <h3>Event Date:</h3>
                <p><?= htmlspecialchars($data['event']->eventDate); ?></p>
            </div>
            <div class="event-detail">
                <h3>Event Address:</h3>
                <p><?= htmlspecialchars($data['event']->address); ?></p>
            </div>
            <div class="event-detail">
                <h3>Event Type:</h3>
                <p><?= htmlspecialchars($data['event']->type); ?></p>
            </div>
            
            <div class="event-detail">
                <h3>Performers:</h3>
                <div>
                    <?php if(!empty($data['performers'])): ?>
                        <?php foreach($data['performers'] as $performer): ?>
                            <p><?php echo htmlspecialchars($performer->name); ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <div class = "ticket-summary">
        <h1>Ticket Summary</h1>
        <table>
            <tr> 
                <th>Ticket Type</th>
                <th>Quantity</th>
                <th>Sold Quantity</th>
            </tr>
            <?php if(!empty($data['ticket_types'])): ?>
                <?php foreach($data['ticket_types'] as $ticket): ?>
                    <tr>
                        <td><?= htmlspecialchars($ticket['type']); ?></td>
                        <td ><?= htmlspecialchars($ticket['quantity']); ?></td>
                        <td><?= htmlspecialchars($ticket['sold_quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>

    <div class="income-summary">
        <h1>Income Summary</h1>
        <table>
            <tr>
                <th>Date</th>
                <th class="text-right"> Income</th>
            </tr>
            <?php if(!empty($data['record'])): ?>
                <?php foreach($data['record'] as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record->purchase_date); ?></td>
                        <td class="text-right"><?= htmlspecialchars($record->total_income); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <tr>
                <td>Total</td>
                <td class="text-right">LKR <?= htmlspecialchars($data['total_income']); ?></td>
            </tr>
        </table>
    </div>

    <div class="income-summary">
        <h1>Payment Summary</h1>
        <table>
            <tr>
                <th>Performer's Name</th>
                <th>Payment</th>
            </tr>
            <?php if(!empty($data['record1'])): ?>
                <?php foreach($data['record1'] as $record1): ?>
                    <tr>
                        <td><?= htmlspecialchars($record1->name); ?></td>
                        <td class="text-right"><?= htmlspecialchars($record1->total_payment); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <tr>
                <td>Total</td>
                <td class="text-right">LKR <?= htmlspecialchars($data['total_cost']); ?></td>
            </tr>
        </table>
    </div>

    <div class =  "balance report-look">
        <h3>Balance</h3>
        <p>LKR<?= htmlspecialchars(floatval($data['total_income']) - floatval($data['total_cost'])); ?></p>
    </div>  
</div>
</div>
 


    <button class = "print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>


    <script>
        function print() {
            const pdfContainer = document.querySelector('.pdf-container'); 
            const newWindow = window.open('', '_blank'); 
            newWindow.document.write('<html><head><title>Musicial - Event Report</title>');
            newWindow.document.write('<link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventplanner/completed.css">'); 
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