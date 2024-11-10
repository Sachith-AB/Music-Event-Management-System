<?php include ('../app/views/components/CreateEventHeader.php'); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? 'Event Title';
$description = $_SESSION['event_data']['description'] ?? 'No description provided';
$audience = $_SESSION['event_data']['audience'] ?? 'N/A';
$city = $_SESSION['event_data']['city'] ?? 'N/A';
$province = $_SESSION['event_data']['province'] ?? 'N/A';
$eventDate = $_SESSION['event_data']['eventDate'] ?? 'N/A';
$start_time = $_SESSION['event_data']['start_time'] ?? 'N/A';
$end_time = $_SESSION['event_data']['end_time'] ?? 'N/A';

// Track last visit time
if (isset($_SESSION['last_visit'])) {
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
    <title>Review Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventUpdate.css">
</head>
<?php $event_name = htmlspecialchars($_GET['event_name']?? '');
//show ($data);
?>
<body>
    <?php 
        $flag = htmlspecialchars($_GET['flag'] ?? 0);
        $error = htmlspecialchars($_GET['msg'] ?? '');
    ?>

    <div class="">
        <div class="event-content">
            <h1 class="head1">Edit Event</h1>
            
            <!-- <div class="">
                <div class="image">
                    <div class="avatar">
                        <img src="<?=ROOT?>/assets/images/user/<?php echo $data['pro_pic'] ?>" alt="pro pic"> -->
                    <!-- </div>
                    <div>
                        <p class="p1">Upload event photo</p>
                        <p class="p2">Event photo should be in PNG or JPG format</p>

                    </div>
                </div> -->

                <form  method="POST" enctype="multipart/form-data">
                    <div class="input-wrap">
                        <input type="file" name="event_pic" id="fileInput">
                        <button type="submit" class="button" id="customButton" name="uploadImage">Upload File</button>
                    </div>
                </form>

                <div>
                    <form method="POST" class="form" >

                        <div class="input-wrap">
                            <!-- <label for="EventName">Event Name</label> -->
                            <input name="vent_name" type="text" placeholder="EventName" value="<?php echo $data['event_name'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Audience">Audience</label> -->
                            <input name=e"audience" type="audience" placeholder="Audience" value="<?php echo $data['audience'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="City">City</label> -->
                            <input name="city" type="city" placeholder="City" value="<?php echo $data['city'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Province">Province</label> -->
                            <input name="province" type="province" placeholder="Province" value="<?php echo $data['province'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Event Date">Event Date</label> -->
                            <input name="eventDate" type="eventDate" placeholder="eventDate" value="<?php echo $data['eventDate'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Start Time">Start Time</label> -->
                            <input name="start_time" type="start_time" placeholder="Start Time" value="<?php echo $data['start_time'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="End Time">End Time</label> -->
                            <input name="end_time" type="end_time" placeholder="End Time" value="<?php echo $data['end_time'] ?>">
                        </div>

                        <div class="button-wrap">
                            <button type="button" name = "cancel">Cancel</button>
                            <button type="submit" name="update">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if($flag == 1):?>
        <?php
            $message = $error;
            include ("../app/views/components/r-message.php");
        ?>
    <?php  endif ?>

    <script>
        function Event() {
            window.location.href = "event?event_name=<?php echo $data['event_name']?>";
        }
    </script>

    <script src="<?=ROOT?>/assets/js/message.js"></script>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>