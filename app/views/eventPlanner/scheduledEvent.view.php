<?php 
    $backPath = ROOT.'/event-planner-dashboard';
    //include ('../app/views/components/header.php'); 
?>

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


<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Scheduled Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/scheduledEvent.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/scheduledEvent.js" defer></script>
</head>
<body>
    <div class="main-layout">
        <!-- Left Side - Event Details -->
        <div>
            <div class="back-button">
                <?php include('../app/views/components/backbutton.view.php'); ?>
                <h2 class="event-title">Event Detail</h2>
            </div>
            
            <form method="POST" class="form">
                <div class="input-wrap">
                    <label for="event-name">Event Name:</label>
                    <div class="event-detail"><?= htmlspecialchars($data['event_name']); ?></div>
                </div>

                <div class="input-wrap">
                    <label for="audience">Audience:</label>
                    <div class="event-detail"><?= htmlspecialchars($data['audience']); ?></div>
                </div>

                <div class="input-wrap">
                    <label for="city">Address:</label>
                    <div class="event-detail"><?= htmlspecialchars($data['address']); ?></div>
                </div>

                <div class="input-wrap">
                    <label for="eventDate">Date: <span class="required">*</span> </label>
                    <input name="event_date" id="event-date" type="date" value="<?= $data['eventDate']; ?>">
                </div>

                <div class="input-wrap">
                    <label for="start_time">Start Time: <span class="required">*</span> </label>
                    <input id="start_time" name="starttime" type="time" value="<?= date('H:i', strtotime($data['start_time'])); ?>">
                </div>

                <div class="input-wrap">
                    <label for="end_time">End Time: <span class="required">*</span> </label>
                    <input id="end_time" name="endtime" type="time" value="<?= date('H:i', strtotime($data['end_time'])); ?>" required>
                </div>

                <div class="input-wrap">
                    <label>Type:</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="indoor" name="type" value="indoor" <?= $data['type'] == 'indoor' ? 'checked' : ''; ?> disabled>
                            <label for="indoor">Indoor</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="outdoor" name="type" value="outdoor" <?= $data['type'] == 'outdoor' ? 'checked' : ''; ?> disabled>
                            <label for="outdoor">Outdoor</label>
                        </div>
                    </div>
                </div>
                <p class="note">Fields marked with <span class="required">*</span> can be updated.</p>

                <input type="hidden" id="hidden-start-time" name="starttime">
                <input type="hidden" id="hidden-end-time" name="endtime">
                <input type="hidden" id="hidden-event-id" name="id" value="<?= $data['id']; ?>">

                <div class="button-wrap">
                    <button type="button" onclick="goBack()">Cancel</button>
                    <button type="submit" name="update">Done</button>
                </div>
            </form>


        </div>

        <!-- Right Side - Charts -->
        <div class="container">
            <div class="chart-section">
                <h2 class="section-title">Income Over Time</h2>
                <canvas id="incomeChart" 
                    data-dates='<?= json_encode($dates) ?>' 
                    data-incomes='<?= json_encode($incomes) ?>'>
                </canvas>
            </div>

            <div class="chart-section">
                <h2 class="section-title">Ticket Progress by Type</h2>
                <canvas id="ticketProgressChart" 
                    data-types='<?= json_encode($ticket_types) ?>' 
                    data-total='<?= json_encode($total_tickets) ?>' 
                    data-sold='<?= json_encode($sold_tickets) ?>'></canvas>
            </div>
        </div>
    </div>
    <!-- display tickets -->
    <div class="ticket-details-box">
        <h2 class="event-title">Ticket Details</h2>
        <div class="payment-summary">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Ticket Type</th>
                        <th>Price (LKR)</th>
                        <th>Sale Start Date</th>
                        <th>Sale End Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['tickets'] as $ticket): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ticket->ticket_type); ?></td>
                            <td class="amount"><?php echo number_format($ticket->price, 2); ?></td>
                            <td><?php echo date($ticket->sale_strt_date); ?></td>
                            <td><?php echo date($ticket->sale_end_date); ?></td>
                            <td>
                                <button class="btn btn-secondary" onclick="gotoeditticket(<?= $ticket->id ?>)">Edit or Apply Discount</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>




    </div>

    <section class="collaborator-payment-section">
        <div class="collaborator-box">
            <h2 class="collaborator-title">Would you like to record collaborators' payments?</h2>
            <p class="collaborator-text">
                Keep track of payments made to your event collaborators, including performers, suppliers, and other key contributors. Ensure smooth operations with accurate records!
            </p>
            <div class="collaborator-buttons">
                <button type="submit" class="btn btn-primary" onclick="go()">Yes, Record Payments</button>
                <button class="btn btn-secondary" onclick="goBack()">No, Continue Without Payments</button>
            </div>
        </div>
    </section>

    <script>
        function gotoeditticket(ticketId){
            window.location.href = "edit-scheduled-event-ticket?ticket_id="+ticketId;
        }
        function goBack() {
            window.location.href = "event-planner-viewEvent?id=<?php echo $data['id']?>";
            window.history.back();
        }

        function go() {
            window.location.href = "event-payment?id=<?php echo $data['id']?>";
        }
    </script>
    <script src="<?= ROOT ?>/assets/js/event/processingEventUpdate.js"></script>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>