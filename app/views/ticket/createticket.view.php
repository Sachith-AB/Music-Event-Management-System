<!-- <?php include ('../app/views/components/CreateEventHeader.php'); ?> -->


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
                    <!-- <div class="form-group">
                        <input type="radio" id="paid-ticket" name="ticket_type" value="paid">
                        <lable for="paid-ticket">Paid</lable>
                        <input type="radio" id="free-ticket" name="ticket_type" value="free">
                        <lable for="free-ticket">Free</lable>
                    </div> -->

                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                        <input type="text" id="event_name" name="event_name" 
                            value="<?= $_SESSION['event_data']['event_name'] ?? '' ?>" 
                            <?= isset($_SESSION['event_data']) ? 'readonly' : '' ?>>
                    </div>

                    <div class = "form-group">
                        <label for="sale-strt-date">Sale Start Date</label>
                        <input type="date" id="sale-strt-date" name="sale_strt_date" 
                            value="<?= $_SESSION['event_data']['sale_strt_date'] ?? '' ?>" 
                            <?= isset($_SESSION['event_data']) ? 'readonly' : '' ?>>
                    </div>

                    <div class = "form-group">
                        <label for="sale-strt-time">Sale Start Time</label>
                        <input type="time" id="sale-strt-time" name="sale_strt_time" 
                            value="<?= $_SESSION['event_data']['sale_strt_time'] ?? '' ?>" 
                            <?= isset($_SESSION['event_data']) ? 'readonly' : '' ?>>
                    </div>

                    <div class = "form-group">
                        <label for="sale-end-date">Sale End Date</label>
                        <input type="date" id="sale-end-date" name="sale_end_date" 
                            value="<?= $_SESSION['event_data']['sale_end_date'] ?? '' ?>" 
                            <?= isset($_SESSION['event_data']) ? 'readonly' : '' ?>>
                    </div>

                    <div class = "form-group">
                        <label for="sale-end-time">Sale End Time</label>
                        <input type="time" id="sale-end-time" name="sale_end_time" 
                            value="<?= $_SESSION['event_data']['sale_end_time'] ?? '' ?>" 
                            <?= isset($_SESSION['event_data']) ? 'readonly' : '' ?>>
                    </div>

                    <div class="form-group">
                        <label for="ticket_type">Ticket Type</label>
                        <select id="ticket_type" name="ticket_type">
                            <?php
                                $ticketTypes = ['platinum', 'gold', 'silver'];
                                foreach ($ticketTypes as $type) {
                                    $disabled = in_array($type, $_SESSION['event_data']['created_ticket_types'] ?? []) ? 'disabled' : '';
                                    echo "<option value='$type' $disabled>" . ucfirst($type) . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price">
                    </div>

                    <button type="submit" class="review-button" name="add_another">Add Another Type of Ticket</button>
                    <button type="submit" class="review-button" name="submit">Review</button>
                </div>
            </form>   
        </div>
        <script src="<?= ROOT ?>/assets/js/ticker/ticket.js"></script>
    </div>

    
</body>
</html>
