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
<?php include ('../app/views/components/loading.php');?>

    
    <div class="dash-container">

        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>
        

<div class="payment-container">
    <h1>Event Payments</h1>
    
    <?php if (empty($data)): ?>
        <div class="no-data">
            <p>No payment records found.</p>
        </div>
    <?php else: ?>
        <?php
        // Group payments by event
        $groupedPayments = [];
        foreach ($data as $payment) {
            $groupedPayments[$payment->event_id][] = $payment;
        }
        
        foreach ($groupedPayments as $eventId => $payments): 
            $event = $payments[0]; // Get first payment to access event details
        ?>
            <div class="event-payment-section">
                <div class="event-header">
                    <h2><?php echo htmlspecialchars($event->event_name); ?></h2>
                    <p class="event-date">Date: <?php echo date('F j, Y', strtotime($event->eventDate)); ?></p>
                </div>
                
                <div class="payment-summary">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Performer Name</th>
                                <th>Payment Date</th>
                                <th>Amount (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($payment->user_name); ?></td>
                                    <td><?php echo date('F j, Y', strtotime($payment->payment_timestamp)); ?></td>
                                    <td class="amount"><?php echo number_format($payment->total_payment, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
