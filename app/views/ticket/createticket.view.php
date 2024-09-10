<?php include ('../app/views/components/CreateEventHeader.php'); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['last_visit'])){
    $last_visit = $_SESSION['last_visit'];
} else {
    $last_visit = "This is my first visit";
}

$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/create-event.css">
</head>
<body>
    
    <div class="container">

            <!--create slide bar -->
        <div class="sidebar">
            
        </div>


        <!--create main content -->
        <div class="main-content">
            <form id="createticket" method="POST">
                <div class="ticket-container">
                    <h3>Ticket</h3>
                    <div class="form-group">
                        <input type="radio" id="paid-ticket" name="ticket_type" value="paid">
                        <lable for="paid-ticket">Paid</lable>
                        <input type="radio" id="free-ticket" name="ticket_type" value="free">
                        <lable for="free-ticket">Free</lable>
                    </div>

                    <div class="form-group">
                        <label for = "quantity">Ticket Type</label>
                        <select id="ticket_type" name="ticket_type" class="form-control">
                            <option value="platinum">Platinum</option>
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for = "quantity">Quantity</label>
                        <input type = "number" id="quantity" name="quantity">
                    </div>

                    <div class="form-group">
                        <label for = "price">Price</label>
                        <input type = "number" id="price" name="price">
                    </div>
                </div>

                <div class = "sale-date-container">
                    <h3>Sale Date</h3>
                    <div class = "form-group">
                        <label for = "sale-start-date">Start Date</label>
                        <input type = "date" id="sale-strt-date" name="sale_strt_date">
                    </div>

                    <div class = "form-group">
                        <label for = "sale-start-time">Start Time</label>
                        <input type = "time" id="sale-strt-time" name="sale_strt_time">
                    </div>

                    <div class = "form-group">
                        <label for = "sale-start-date">End Date</label>
                        <input type = "date" id="sale-end-date" name="sale_end_date">
                    </div>

                    <div class = "form-group">
                        <label for = "sale-start-time">End Time</label>
                        <input type = "time" id="sale-start-time" name="sale_end_time">
                    </div>

                    <button type="submit" class="review-button" name="submit">Review</button>
                </div>
            </form>   
        </div>
    </div>

    
</body>
</html>
