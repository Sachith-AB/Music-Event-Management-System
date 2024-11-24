<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? '';
$audience = $_SESSION['event_data']['audience'] ?? '';
$address = $_SESSION['event_data']['address'] ?? '';
$eventDate = $_SESSION['event_data']['eventDate'] ?? '';
$start_time = $_SESSION['event_data']['start_time'] ?? '';
$end_time = $_SESSION['event_data']['end_time'] ?? '';

// Track last visit time
$last_visit = $_SESSION['last_visit'] ?? "This is my first visit";
$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>
<?php include ('../app/views/components/CreateEventHeader.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Event</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventUpdate.css">
</head>
<body>
    <?php 
        $flag = htmlspecialchars($_GET['flag'] ?? 0);
        $error = htmlspecialchars($_GET['msg'] ?? '');
    ?>

    <div class="container">
        <div class = "popup">
            <div class="event-content">
                <h1 class="head1">Update Event Details</h1>
                
                

                <!-- Event Details Form -->
                <form method="POST" class="form">

                    <div class="input-wrap">
                        <label for = "event_name">Event Name</label>
                        <input name="event_name" type="text" placeholder="EventName" value="<?php echo $data['event_name'] ?>">
                    </div>

                    <div class="input-wrap">
                        <label for="description">Description</label>
                        <input name="description" type="text" placeholder="Description" value="<?php echo $data['description'] ?>">
                    </div>

                    <div class="input-wrap">
                        <label for="audience">Audience</label>
                        <input name="audience" type="number" placeholder="Audience" value="<?php echo $data['audience'] ?>">
                    </div>

                    <div class="input-wrap">
                        <label for = "city">Address</label>
                        <input name="address" type="text" placeholder="address" value="<?php echo $data['address'] ?>">
                    </div>

                    
                    <div class="input-wrap">
                        <label for="eventDate">Event Date</label>
                        <input name="eventDate" id="event-date" type="date" value="<?php echo $data ['eventDate'] ?>" required>
                    </div>

                    <div class="input-wrap">
                        <label for="start_time">Start Time</label>
                        <input id="start-time" name="starttime" type="time" value="<?php echo date('H:i', strtotime($data['start_time'])); ?>">
                    </div>

                    <div class="input-wrap">
                        <label for="end_time">End Time</label>
                        <input name="endtime" id="end-time" type="time" value="<?php echo date('H:i', strtotime($data['end_time'])); ?>">
                    </div>

                    <input type="hidden" id="hidden-start-time" name="start_time">
                    <input type="hidden" id="hidden-end-time" name="end_time">
                    <script src="<?= ROOT ?>/assets/js/event/createEvent.js"></script>

                    <input type="hidden" name="event_id" value="<?php echo $data['id'] ?>">

                    <!-- Action Buttons -->
                    <div class="button-wrap">
                        <button type="button" onclick="goBack()">Cancel</button>
                        <button type="submit" name="update">Done</button>
                    </div>
                </form>


                <!-- <form  method="post" enctype="multipart/form-data">
                    <div class="input-wrap">
                    <label for="images">Upload Images:</label>
                    <input type="file" id="images" name="cover_images" accept="image/*" multiple>
                    <input type="hidden" name="event_id" value="<?php echo $data['id'] ?>">
                    <button class="upload-button" type="submit" name="upload">Upload</button>
                    </div>
                </form> -->


                

            </div>
        </div>
    </div>


    <!-- Error Message Display -->
    <?php if ($flag == 1): ?>
        <?php
            $message = $error;
            include ("../app/views/components/r-message.php");
        ?>
    <?php endif; ?>

    <script src="<?= ROOT ?>/assets/js/message.js"></script>
    
    <!-- Script to go back to the previous page when cancel button is clicked -->
    <script>
        function goBack() {
            window.location.href = "event-review?event_name=<?php echo $data['event_name']?>";
            // window.history.back();
        }
    </script>


</body>
</html>

