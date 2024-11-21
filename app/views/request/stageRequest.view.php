<?php include ('../app/views/components/header.php'); ?>
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
        <div >
            <form method="POST" class="search">
                <input type="text" name="searchTerm" placeholder="Search..." class="search-bar">
                <button name="searchVenues" value="search" type="submit">SEARCH</button>
            </form>
        </div>

        <!-- Singers Section -->
        <section class="singers-section">

        <?php if(empty($data)): ?>
            <h2 class="p-tag">No Stages Yet...</h2>
        <?php endif ?>
            
            <div class="singers-grid">
                <?php foreach ($data['users'] as $singer):?>


                <?php 
                    // Initialize a variable to store the request status for this singer
                    $requestStatus = null;
                    
                    // Loop through the requests to find one that matches the singer
                    foreach ($data['requests'] as $request) {
                        if ($request->collaborator_id == $singer->id) {
                            $requestStatus = $request->Status;
                            break; // Exit loop once the matching request is found
                        }
                    }
                ?>

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
                                <input type="hidden" name="Status" value="pending">
                                <input type="hidden" name="req_id" value="<?php echo isset($request->id) ? $request->id : 0; ?>">

                                <?php if ($requestStatus === null): ?>
                                    <!-- Show "Request" button if no request exists for this singer -->
                                    <button name="request" type="submit" class="request">Request</button>
                                <?php elseif ($requestStatus === 'pending'): ?>
                                    <!-- Show "Cancel Request" button if the request is pending -->
                                    <button  type="submit" class="cancel-request" name="deleteRequest">Cancel Request</button>
                                <?php elseif ($requestStatus === 'accepted'): ?>
                                    <!-- Show "Accepted" button (disabled) if the request is accepted -->
                                    <button name="request" type="submit" class="accepted" disabled>Accepted</button>
                                <?php elseif ($requestStatus === 'rejected'): ?>
                                    <!-- Show "Rejected" button (disabled) if the request is rejected -->
                                    <button name="request" type="submit" class="rejected" disabled>Rejected</button>
                            
                                <?php endif ?>

                                
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
