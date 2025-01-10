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
<div class="event-details-box">
    <h2 class="event-title">Event Detail</h2>
    <form method = "POST" class="form">
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
            <input id="end_time" name="endtime" type="time" value="<?= date('H:i', strtotime($data['end_time'])); ?>">
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




        <!-- <input type="hidden" id="hidden-start-time" name="starttime">
        <input type="hidden" id="hidden-end-time" name="endtime"> -->

        <input type="hidden" id="hidden-start-time" name="starttime">
        <input type="hidden" id="hidden-end-time" name="endtime">

        <input type="hidden" id="hidden-event-id" name="id" value="<?= $data['id']; ?>">

        <script src="<?= ROOT ?>/assets/js/event/processingEventUpdate.js"></script>

        <div class="button-wrap">
            <button type="button" onclick="goBack()">Cancel</button>
            <button type="submit" name="update">Done</button>
        </div>
    </form>
</div>


    <script>
        function goBack() {
            window.location.href = "event-planner-viewEvent?id=<?php echo $data['id']?>";
            window.history.back();
        }


        function go() {
            window.location.href = "event-payment?id=<?php echo $data['id']?>";
        }


    </script>
    
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

    <div class="event-details-box">
        <section class="collaborator-payment-section">
            <div class="collaborator-box">
                <h2 class="collaborator-title">Would you like to record collaborators' payments?</h2>
                <p class="collaborator-text">
                    Keep track of payments made to your event collaborators, including performers, suppliers, and other key contributors. Ensure smooth operations with accurate records!
                </p>
                <div class="collaborator-buttons">
       <button type = "submit" class="btn btn-primary" onclick="go()">Yes, Record Payments</a>

                    <button type = "submit" class="btn btn-primary">Yes, Record Payments</a>

                    <button class="btn btn-secondary" onclick="goBack()">No, Continue Without Payments</button>
                </div>
            </div>
        </section>
    </div>



</body>
</html>
