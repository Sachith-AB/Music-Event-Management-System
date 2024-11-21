<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/admindashboard.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
    <!-- Sidebar -->
    <?php include('../app/views/components/admin/dashsidebar.php'); ?>
    <div class="dashboard">
        <h2 class="content-header">Upcoming Events</h2>
        <div class="events-container">
            <!-- Upcoming Events Dummy Data -->
            <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="event-card">
                <img src="https://image.jimcdn.com/app/cms/image/transf/dimension=1190x10000:format=jpg/path/sa6549607c78f5c11/image/i82f8384a1348ab84/version/1554202007/tomorrowland-best-summer-music-festivals-europe.jpg" alt="Event Image">
                <div>
                    <div>Event Name <?= $i ?></div>
                    <div>
                        <div>📅 2024.12.3<?= $i ?> | 10.00AM</div>
                        <div>📍 Location <?= $i ?></div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <div class="view-more">
            <a href="#">View More Upcoming Events</a>
        </div>

        <h2 class="content-header">Already Held Events</h2>
        <div class="events-container">
            <!-- Already Held Events Dummy Data -->
            <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="event-card">
                <img src="https://149347190.v2.pressablecdn.com/wp-content/uploads/2019/08/summer-festivals-thumbnail-846x564.jpg" alt="Event Image">
                <div>
                    <div>Event Name <?= $i ?></div>
                    <div>
                        <div>📅 2024.11.2<?= $i ?> | 10.00AM</div>
                        <div>📍 Location <?= $i ?></div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <div class="view-more">
            <a href="#">View More Already Held Events</a>
        </div>
    </div>
</div>

</body>
</html>