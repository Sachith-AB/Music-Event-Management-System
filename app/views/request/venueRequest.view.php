<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/request/singerdropdown.css">
    <title>Request To Venue</title>
</head>

<body>

<?php include ('../app/views/components/sidebar.php');  ?>

    <!-- Main Content -->
    <div class="content">

    <h1>Venues</h1>
        <!-- Search Bar -->
        <div >
            <form method="POST" class="search">
                <input type="text" name="searchTerm" placeholder="Search..." class="search-bar">
                <button name="searchVenues" value="search" type="submit">SEARCH</button>
            </form>
        </div>

        <!-- Singers Section -->
        <section class="singers-section">

        <?php if(empty($data)): ?>
            <h2 class="p-tag">No Venues Yet...</h2>
        <?php endif ?>
            
            <div class="singers-grid">
                <?php foreach ($data as $singer):?>
                    <div class="singer-card">
                        <img src="<?=ROOT?>/assets/images/user/<?php echo $singer->pro_pic ?>" alt="Singer 2">
                        <h3><?php echo $singer->name ?></h3>
                        <p>Music Genre</p>
                        <div class="button-wrapper">
                            <button class="profile">Profile</button>
                            <form method = "POST">
                                <input name="event_id" type = "hidden" value="<?= htmlspecialchars($_GET["id"]) ?>">
                                <input name="collaborator_id" type = "hidden" value="<?php echo $singer->id ?>" >
                                <input name="role" type = "hidden" value="<?php echo $singer->user_role ?>">
                                <button name = "request" type = "submit" class="request">Request</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
        </section>
    </div>

<script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>
