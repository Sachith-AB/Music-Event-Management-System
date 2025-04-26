<?php require_once '../app/helpers/load_notifications.php'; ?>


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
    include ('../app/views/components/loading.php');  show($_POST);
    // Set default value for showMore if not set
    $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false; 
    ?>
    <div class="container">
        <div>
            <h1>Search Event</h1>
            <div class="search-bar">
                <form method="POST" class="search-bar">
                    <input type="text" name="name" placeholder="Event name">
                    <input type="text" name="address" placeholder="Location">
                    <button type="submit" name="searchEvents" value="search">Search</button>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="content-all">
                <form class="filter" method="POST">
                    <h3>Filter</h3>
                    <div class="filter-section">
                        <h4>Category</h4>
                        <label><input type="checkbox" name="category"> All</label>
                        <label><input type="checkbox" name="category" value="trending"> Trending</label>
                    </div>
                    <div class="filter-section">
                        <h4>Pricing</h4>
                        <label>
                            <input type="checkbox" name="pricing" value="free" id="free-checkbox" > Free
                        </label>
                        <label>
                            <input type="checkbox" name="pricing" value="paid" id="paid-checkbox" > Paid
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

                <div class="event-list-container">
                    <main class="event-list">
                        <?php 

                            if (isset($_POST['category']) && $_POST['category'] == 'trending') {
                                // Sort events by averageRating descending
                                usort($data, function($a, $b) {
                                    return $b->averageRating <=> $a->averageRating;
                                });
                            }
                            // Limit events to 3 if showMore is false
                            $maxEvents = $showMore ? count($data) : 3;
                            $eventsDisplayed = 0;

                            foreach($data as $event): 
                                if ($eventsDisplayed >= $maxEvents) break;
                                $eventsDisplayed++;
                        ?>

                            <?php include ('../app/views/components/search/event-card.php'); ?>
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

<?php include ('../app/views/components/footer.php'); ?>


