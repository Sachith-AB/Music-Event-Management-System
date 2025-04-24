<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Events</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/landing.css">
</head>
<body> 
<?php 
    include ('../app/views/components/loading.php');
    //Get the pass data from URL for sign in part
    //To handle Errors
    $email = htmlspecialchars($_GET['email'] ?? '');
    $pass = htmlspecialchars($_GET['pass'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 2);
    $error = htmlspecialchars($_GET['error']?? '');
    $role = htmlspecialchars($_GET['role']?? '');
?>

    <div class="block">
    <section id ="treanding" class="trending-events">
        <h1>Discover Unforgettable Experience at</h1>
        <h1 class="highlight">Musicia</h1>

        <div class="heading">
            <h2 class="top">Top 3</h2>
            <h2>trending events</h2>
        </div>
        <div class="events">
            <?php if (!empty($trendingEvents)): ?>
                <?php foreach ($trendingEvents as $event): ?>
                    <div class="event" onclick="location.href='<?= ROOT ?>/view-event?id=<?= $event->id ?>'">
                        <?php
                            $coverImages = json_decode($event->cover_images, true);
                            $firstImage = $coverImages[0] ?? ''; // fallback if empty
                        ?>
                        <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="<?= htmlspecialchars($event->event_name) ?>">
                        <div class="event-info">
                            <div class="event-details">
                                <h3><?= htmlspecialchars($event->event_name) ?></h3>
                                <p class="date-time"><?= date('D, F d, Y | h.i A', strtotime($event->start_time)) ?></p>
                                <p class="venue"><?= htmlspecialchars($event->address) ?></p>
                            </div>
                            <div class="pricing">
                                <?php if (!empty($event->pricing) && strtolower($event->pricing) != 'free'): ?>
                                    <p class="price-from">From LKR <?= number_format($event->audience * 10) ?></p> <!-- You can replace this with your real price logic -->
                                <?php else: ?>
                                    <p class="price-from">Free Entry</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No trending events available.</p>
        <?php endif; ?>
</div>

    </section>

    
    <!--Event Browsing-->
    <div id="new-events">

        <div class="events-container" id="events-container">
            <!-- Events will be dynamically inserted here -->
        </div>

    </div>
        <div class = "events-selection">
            <div class ="events-header">
                <h2>Recent Events</h2>
            </div>
            <?php include ('../app/views/components/eventCard.php'); ?>
        </div>
            
    </div>
    <!-- Show error -->
    <?php if (!empty($data['error'])): ?>
            <?php 
                $message = $data['error'];
                include("../app/views/components/r-message.php")
            ?>

        <?php elseif($flag == 1): ?>
            <?php 
                $message = $error;
                include("../app/views/components/r-message.php")
            ?>
        <?php endif ?>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
        <script src="<?=ROOT?>/assets/js/message.js"></script>

</body>
</html>

<?php include ('../app/views/components/footer.php'); ?>
