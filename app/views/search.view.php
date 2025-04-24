<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

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
    include ('../app/views/components/loading.php');
    // Set default value for showMore if not set
    $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false; 
    ?>
    <div class="container">
        <div>
            <h1>Search Event</h1>
            <div class="search-bar">
                <form method="POST" class="search-bar">
                    <input type="text" name="name" placeholder="Event name">
                    <input type="text" name="location" placeholder="Location">
                    <button type="submit" name="searchEvents" value="search">Search</button>
                </form>
            </div>
        </div>
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
                
            </form>

            <?php if(empty($data)): ?>
                    <h2>NO EVENTS YET</h2>
                <?php else:?>
            
            <main class="event-list">
            
                <?php 
                    // Limit events to 3 if showMore is false
                    $maxEvents = $showMore ? count($data) : 3;
                    $eventsDisplayed = 0;

                    foreach($data as $event): 
                        if ($eventsDisplayed >= $maxEvents) break;
                        $eventsDisplayed++;
                ?>

                <div class="event-card" onclick="window.location.href='view-event?id=<?= $event->id ?>'">
                    <?php
                    $coverImages = json_decode($event->cover_images, true);
                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                    ?>
                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Image">
                    <div class="event-info">
                        <h3><?php echo $event->event_name ?></h3>
                        <p class="date">📅 <?php echo $event->eventDate ?> | <?php echo $event->start_time ?></p>
                        <p class="location">📍 <?php echo $event->address ?></p>
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
                        <div class="star-rating">
                            <?php
                                $fullStars = floor($event->averageRating);
                                $halfStar = ($event->averageRating - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<span class="star full">&#9733;</span>'; // ★
                                }
                                if ($halfStar) {
                                    echo '<span class="star half">&#9733;</span>'; // Will style as half
                                }
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<span class="star empty">&#9733;</span>'; // ★ (faded)
                                }
                            ?>
                            <span class="rating-text">
                                <?= number_format($event->averageRating, 1) ?>/5 (<?= $event->totalReviews ?> reviews)
                            </span>
                        </div>
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
            <?php endif ?>
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

            function goToEventPage($event){
                window.location.href = window.location.href = "ticketevent?id=<?php $event->id?>";;
            }
            
        
        </script>

</body>
</html>

<?php include ('../app/views/components/footer.php'); ?>


