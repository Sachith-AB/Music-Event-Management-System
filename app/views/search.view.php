<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Search</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/search.css">
</head>
<body>
    <?php 
    // Set default value for showMore if not set
    $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false; 
    ?>
    <div class="container">
        <header>
            <h1>Search Event</h1>
            <form method="POST" class="search-bar">
                <input type="text" placeholder="Rock">
                <input type="text" placeholder="New York, NY">
                <button>Search</button>
            </form>
        </header>
        <div class="content">
            <form class="filter" method="POST">
                <h3>Filter</h3>
                <div class="filter-section">
                    <h4>Category</h4>
                    <label><input type="checkbox"> All</label>
                    <label><input type="checkbox"> Trending</label>
                    <label><input type="checkbox"> Upcoming</label>
                    <label><input type="checkbox"> Music</label>
                </div>
                <div class="filter-section">
                    <h4>Pricing</h4>
                    <label><input type="checkbox"> Free</label>
                    <label><input type="checkbox"> Paid</label>
                </div>
                <div class="filter-section">
                    <h4>Type</h4>
                    <label><input type="checkbox"> Indoor</label>
                    <label><input type="checkbox"> Outdoor</label>
                </div>
                <button class="apply-btn" type="submit" name="apply">Apply</button>
            </form>
            
            <main class="event-list">
                <?php 
                    // Limit events to 3 if showMore is false
                    $maxEvents = $showMore ? count($data) : 3;
                    $eventsDisplayed = 0;

                    foreach($data as $event): 
                        if ($eventsDisplayed >= $maxEvents) break;
                        $eventsDisplayed++;
                ?>

                <div class="event-card">
                    <img src="<?=ROOT?>/assets/images/landing/One Mic.png" alt="Event 2">
                    <div class="event-info">
                        <h3><?php echo $event->event_name ?></h3>
                        <p class="date">📅 <?php echo $event->eventDate ?> | <?php echo $event->start_time ?></p>
                        <p class="location">📍 New York, NY</p>
                        <span class="tag new">New Event</span>
                    </div>
                </div>
                <?php endforeach ?>
                <!-- Show More / Show Less button -->
                    <form method="POST" id="showMoreForm">
                        <input type="hidden" id="showMore" name="showMore" value="<?= $showMore ? 'true' : 'false' ?>">
                        <?php if (count($data) > 3): ?>
                            <button type="button" class="view-more" onclick="handleShowMore()">
                                <?= $showMore ? 'Show Less' : 'View More' ?>
                            </button>
                        <?php endif; ?>
                    </form>
            </main>
        </div>
    </div>
    <script>
        // JavaScript function to handle the "View More" / "Show Less" button
        function handleShowMore() {
            const showMoreInput = document.getElementById('showMore');
            showMoreInput.value = showMoreInput.value === 'true' ? 'false' : 'true';
            document.getElementById('showMoreForm').submit();
        }
    </script>

</body>
</html>
