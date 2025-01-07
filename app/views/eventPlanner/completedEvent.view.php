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

</head>
<body>

    <div class="container">

        <div class = "left-section">
            <img src="<?=ROOT?>/assets/images/events/<?php echo $data['event']->cover_images ?>" alt="Event Cover" class="cover-image">
        </div>

        <div class = "right-section">
            <div class = "details">
                <label for="event-name">Event Name:</label>
                <div class="event-detail"><?= htmlspecialchars($data['event']->event_name); ?></div>
                <div class = "event-description"><?= htmlspecialchars($data['event']->description); ?></div>
            </div>

            <div class = "details">
                <label for = "audience">Audience:</label>
                <div class="event-detail"><?= htmlspecialchars($data['event']->audience); ?></div>
            </div>

            <div class = "details">
                <label for = "address">Address:</label>
                <div class="event-detail"><?= htmlspecialchars($data['event']->address); ?></div>
            </div>

            <div class = "details">
                <label for = "eventDate">Date:</label>
                <div class="event-detail"><?= htmlspecialchars($data['event']->eventDate); ?></div>
            </div>

            <div class = "details">
                <label for = "type">Type:</label>
                <div class="event-detail"><?= htmlspecialchars($data['event']->type); ?></div>
            </div>
    
        </div>

    </div>

    <div class="financial-summary">
        <table class="financial-table">
            <thead>
                <tr>
                    <th>Financial Summary</th>
                    <th>Amount (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Income</td>
                    <td class="amount"><?= number_format(htmlspecialchars($total_income), 2); ?></td>
                </tr>
                <tr>
                    <td>Total Cost</td>
                    <td class="amount"><?= number_format(htmlspecialchars($total_cost), 2); ?></td>
                </tr>
                <tr class="total-row">
                    <td>Total Profit</td>
                    <td class="amount"><?= number_format(htmlspecialchars($total_income - $total_cost), 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>

    <div class="ticket-summary">
        <table>
            <tbody>
                <tr>
                    <th>Ticket Summary</th>
                </tr>
                <tr>
                    <td>Total Tickets</td>
                    <td class="amount"><?= htmlspecialchars($total_tickets); ?></td>
                </tr>
                <tr>
                    <td>Sold Tickets</td>
                    <td class="amount"><?= htmlspecialchars($sold_tickets); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <section class="team-section">
        <h1>Performers' Payment Information</h1>
        <div>
            <table>
                <tbody>

                    <?php if (!empty($data['performers'])): ?>
                        <?php foreach ($data['performers'] as $performer): ?>

                            <tr>
                                <td>
                                    <img src="<?=ROOT?>/assets/images/user/<?php echo $performer->pro_pic ?>" alt="Performer" class="performer-image">
                                    <span><?php echo $performer->name ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No performers found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            
        </div>
    </section>
    



    

</body>