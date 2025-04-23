<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/singerpayments.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/collaborator/singersidebar.php');  ?>
        <div class="dashboard">

                <div class="container-table">
                        <h1>My Payments</h1>
                        <br>
                        <!-- Filter Form -->
                        <div class="filter-container">
                            <form method="GET" action="">
                                <input type="date" name="date_filter" value="<?php echo isset($_GET['date_filter']) ? $_GET['date_filter'] : ''; ?>" placeholder="Filter by date">
                                <input type="text" name="event_filter" value="<?php echo isset($_GET['event_filter']) ? htmlspecialchars($_GET['event_filter']) : ''; ?>" placeholder="Filter by event name">
                                <input type="text" name="planner_filter" value="<?php echo isset($_GET['planner_filter']) ? htmlspecialchars($_GET['planner_filter']) : ''; ?>" placeholder="Filter by event planner">
                                <button type="submit">Filter</button>
                                <?php if(isset($_GET['date_filter']) || isset($_GET['event_filter']) || isset($_GET['planner_filter'])): ?>
                                    <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="button">Clear Filters</a>
                                <?php endif; ?>
                            </form>
                        </div>

                        <table class="rtable">
                            <thead>
                                <tr>                
                                   
                                    <th>Payment Time</th>
                                    <th>Event name</th>
                                    <th>Amount</th>
                                    <th>Paid by</th>
                                </tr>
                            </thead>

                            <tbody>
 
                                    <?php if(!empty($data)): ?>

                                        <?php foreach($data as $payment): ?>

                                            <?php
                                                // Apply filters
                                                $showRow = true;
                                                
                                                // Date filter
                                                if(isset($_GET['date_filter']) && !empty($_GET['date_filter'])) {
                                                    $paymentDate = date('Y-m-d', strtotime($payment->payment_timestamp));
                                                    if($paymentDate != $_GET['date_filter']) {
                                                        $showRow = false;
                                                    }
                                                }
                                                
                                                // Event name filter
                                                if(isset($_GET['event_filter']) && !empty($_GET['event_filter'])) {
                                                    if(stripos($payment->event_name, $_GET['event_filter']) === false) {
                                                        $showRow = false;
                                                    }
                                                }
                                                
                                                // Event planner filter
                                                if(isset($_GET['planner_filter']) && !empty($_GET['planner_filter'])) {
                                                    if(stripos($payment->paid_by, $_GET['planner_filter']) === false) {
                                                        $showRow = false;
                                                    }
                                                }
                                                
                                                if($showRow):
                                            ?>
                                                <tr>
                                                        <td> <?php echo date('Y-m-d', strtotime($payment->payment_timestamp)); ?> </td>
                                                        <td> <?php echo(htmlspecialchars($payment->event_name)); ?> </td>
                                                        <td><?php echo(htmlspecialchars($payment->payment)); ?> </td>
                                                        <td><?php echo(htmlspecialchars($payment->paid_by)); ?> </td>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach;?>

                                    <?php else : ?>

                                        <tr>
                                            <td colspan="4" style="text-align: center;">No payments found</td>
                                        </tr>

                                    <?php endif; ?>

                            </tbody>

                        </table>

                </div>

        </div>


    </div>

</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>