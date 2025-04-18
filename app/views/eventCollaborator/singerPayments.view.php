<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators\singerpayments.css">
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

                                            <tr>
                                                    <td> <?php echo(htmlspecialchars($payment->payment_timestamp)); ?> </td>
                                                    <td> <?php echo(htmlspecialchars($payment->event_name)); ?> </td>
                                                    <td><?php echo(htmlspecialchars($payment->payment)); ?> </td>
                                                    <td><?php echo(htmlspecialchars($payment->paid_by)); ?> </td>
                                            </tr>

                                        <?php endforeach;?>

                                    <?php else : ?>

                                        <tr>
                                            <!-- add exeption data -->
                                        </tr>

                                    <?php endif; ?>

                            </tbody>

                        </table>

                </div>

        </div>


    </div>

</body>
</html>