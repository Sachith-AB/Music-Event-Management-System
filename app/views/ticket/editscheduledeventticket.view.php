<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/editticket.css">
</head>
<body>
<?php include ('../app/views/components/loading.php'); ?>

    <div class="container">
        <!--create main content -->
        <div class="main-content">
        <?php if (!empty($data)): ?>
                <form id="editticket" method="POST">
                    <div class="sale-ticket-container">
                        <div class="ticket-container">
                            <h3>Ticket</h3>
                            <!-- Hidden field to identify the ticket -->
                            <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($data[0]->id) ?>">

                            <input type="hidden" name="event_id" value="<?= htmlspecialchars($data[0]->event_id) ?>">

                            <!-- Quantity field with prefilled value -->
                            <div class="form-group">
                                <label for="quantity">Quantity:  </label>
                                <div><?= htmlspecialchars($data[0]->quantity) ?></div>
                                <input type="hidden" id="quantity" name="quantity" value="<?= htmlspecialchars($data[0]->quantity) ?>">
                            </div>

                            <!-- Price field with prefilled value -->
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <div><?= htmlspecialchars($data[0]->price) ?></div>
                                <input type="hidden" id="price" name="price" value="<?= htmlspecialchars($data[0]->price) ?>">
                            </div>

                            <div class="form-group">
                                <label for="price"><strong>Discount Amount:</strong></label>
                                <input type="number" id="discount" name="discount" value="<?= htmlspecialchars($data[0]->discount ?? 0) ?>">
                            </div>
                        </div>

                        <!-- Sale Date Section -->
                        <div class="ticket-container">
                            <h3>Sale Date</h3>

                            <!-- Start Date field with prefilled value -->
                            <div class="form-group">
                                <label for="sale-strt-date">Start Date</label>
                                <input type="date" id="sale-strt-date" name="sale_strt_date" value="<?= htmlspecialchars($data[0]->sale_strt_date) ?>">
                            </div>

                            <!-- Start Time field with prefilled value -->
                            <div class="form-group">
                                <label for="sale-strt-time">Start Time</label>
                                <input type="time" id="sale-strt-time" name="sale_strt_time" value="<?= htmlspecialchars($data[0]->sale_strt_time) ?>">
                            </div>

                            <!-- End Date field with prefilled value -->
                            <div class="form-group">
                                <label for="sale-end-date">End Date</label>
                                <input type="date" id="sale-end-date" name="sale_end_date" value="<?= htmlspecialchars($data[0]->sale_end_date) ?>">
                            </div>

                            <!-- End Time field with prefilled value -->
                            <div class="form-group">
                                <label for="sale-end-time">End Time</label>
                                <input type="time" id="sale-end-time" name="sale_end_time" value="<?= htmlspecialchars($data[0]->sale_end_time) ?>">
                            </div>
                        </div>
                    </div>
                    
                        <div class="button-container">
                            <div class="opportunity-container">
                                <h3>Restrictions</h3>
                                <?php if (!empty($data[0]->restrictions)): 
                                    $restrictions = json_decode($data[0]->restrictions, true); // Decode JSON to PHP array
                                    ?>
                                    <div id="opportunity-container">
                                        <?php foreach($restrictions as $restriction): ?>
                                            <div class="restriction-item"><?= htmlspecialchars($restriction) ?></div>
                                            <input type="hidden" name="restrictions[]" class="opportunity-input" value="<?= htmlspecialchars($restriction) ?>" >
                                        <?php endforeach; ?>
                                    </div>
                                    
                                <?php else: ?>
                                    <p>No restrictions defined. Add new restrictions below:</p>
                                <?php endif; ?>
                                
                            </div>
                            <button type="submit" class="review-button" name="update">Review</button>
                        </div>
                    

                </form>
            <?php else: ?>
                <p>No ticket data available to display.</p>
            <?php endif; ?>
        </div>

        <?php if(!empty($errors)): ?>
            <?php 
                $message = $errors['error'];
                
                include("../app/views/components/r-message.php")
            ?>
        <?php endif ?>
            
        <script src="<?= ROOT ?>/assets/js/ticker/ticket.js"></script>
        <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
        <script src="<?=ROOT?>/assets/js/message.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    </div>
    
    
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>