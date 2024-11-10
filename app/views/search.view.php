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
                <input type="text" name="name" placeholder="Rock">
                <input type="text" name="location" placeholder="New York, NY">
                <button type="submit" name="searchEvents" value="search">Search</button>
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
                    <label>
                        <input type="checkbox" name="pricing" value="free" id="free-checkbox" onclick="toggleCheckbox('free')"> Free
                    </label>
                    <label>
                        <input type="checkbox" name="pricing" value="paid" id="paid-checkbox" onclick="toggleCheckbox('paid')"> Paid
                    </label>
                </div>
                <div class="filter-section">
                    <h4>Type</h4>
                    <label>
                        <input type="checkbox" name="type" value="indoor" id="indoor-checkbox" onclick="toggleCheckbox('type', 'indoor')"> Indoor
                    </label>
                    <label>
                        <input type="checkbox" name="type" value="outdoor" id="outdoor-checkbox" onclick="toggleCheckbox('type', 'outdoor')"> Outdoor
                    </label>
                </div>
                <button class="apply-btn" type="submit" value="apply" name="apply">Apply</button>
                <?php show($_POST) ?>
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
                        <?php if($event->pricing == 'paid'):?>
                            <span class="pricing paid"><?php echo "PAID" ?></span> 
                        <?php else:?>
                            <span class="pricing free"><?php  echo "FREE" ?></span>
                        <?php endif?>

                        <?php if($event->type == 'indoor'):?>
                            <span class="pricing indoor"><?php echo "INDOOR" ?></span> 
                        <?php else:?>
                            <span class="pricing outdoor"><?php echo "OUTDOOR" ?></span>
                        <?php endif?>
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

        <script>
            function toggleCheckbox(category,selected) {
                const freeCheckbox = document.getElementById('free-checkbox');
                const paidCheckbox = document.getElementById('paid-checkbox');

                if (selected === 'free') {
                    paidCheckbox.checked = false;
                    paidCheckbox.disabled = freeCheckbox.checked;
                } else if (selected === 'paid') {
                    freeCheckbox.checked = false;
                    freeCheckbox.disabled = paidCheckbox.checked;
                }

                if (category === 'type') {
                    const indoorCheckbox = document.getElementById('indoor-checkbox');
                    const outdoorCheckbox = document.getElementById('outdoor-checkbox');

                    if (selected === 'indoor') {
                        outdoorCheckbox.checked = false;
                        outdoorCheckbox.disabled = indoorCheckbox.checked;
                    } else if (selected === 'outdoor') {
                        indoorCheckbox.checked = false;
                        indoorCheckbox.disabled = outdoorCheckbox.checked;
                    }
                }
            }

            
        
        </script>

</body>
</html>
