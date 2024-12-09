<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/createticket.css">
</head>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    
    <div class="container">

        <!--create main content -->
        <div class="main-content">
            <form id="createticket" method="POST">
                <div class="ticket-container">
                    <h3>Create Tickets for Your Event</h3>
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
                        <input type="TEXT" id="type" name="ticket_type">
                    </div>

                    <div class="form-group">
                        <label>Opportunities</label>
                        <div id="opportunity-container">
                            <!-- Default input field -->
                            <input type="text" name="restrictions[]" class="opportunity-input" >
                        </div>
                        <button type="button" id="add-opportunity" class="review-button">Add More Opportunities</button>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price">
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="review-button" name="add_another">Add Another Type of Ticket</button>
                        <button type="submit" class="review-button" name="submit">Review</button>
                    </div>
                    
                </div>
            </form>   
        </div>
        <script src="<?= ROOT ?>/assets/js/ticker/ticket.js"></script>
    </div>

    
</body>
</html>
