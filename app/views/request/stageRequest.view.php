<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/request/singerdropdown.css">
    <title>Request To Stage</title>
</head>

<body>

<?php include ('../app/views/components/sidebar.php');  ?>

    <!-- Main Content -->
    <div class="content">

    <h1>Stages</h1>
        <!-- Search Bar -->
        <header>
            <form method="POST">
                <input type="text" name="searchTerm" placeholder="Search..." class="search-bar">
                <button name="searchStages" value="search" type="submit">SEARCH</button>
            </form>
        </header>

        <!-- Singers Section -->
        <section class="singers-section">

        <?php if(empty($data)): ?>
            <h2 class="p-tag">No Stages Yet...</h2>
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
