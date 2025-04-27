<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php');

$error = esc($_GET['error'] ?? '');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/request/singerdropdown.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <title>Request To Band</title>
</head>

<body>
    <div class="req-container">
    <?php include ('../app/views/components/sidebar.php');  ?>

<!-- Main Content -->
<div class="dashboard">
    <div class="back-button">
    <?php include('../app/views/components/backbutton.view.php'); ?>
        <h1>Bands</h1>
    </div>
    <!-- Search Bar -->
    <div>
        <form method="POST" class="search">
            <input type="text" name="searchTerm" placeholder="Search..." class="search-bar">
            <button name="searchBands" value="search" type="submit">SEARCH</button>
        </form>
    </div>

    <!-- Singers Section -->
    <section class="singers-section">

    <?php if(empty($data)): ?>
        <h2 class="p-tag">No Bands Yet...</h2>
    <?php endif ?>
        
        <div class="singers-grid">
            <?php foreach ($data['users'] as $singer):?>


            <?php
                
                //initialize variable to store request status of collaborator
                $requestStatus = null;

                //loop through requests available to find the one that matches this collaborator
                foreach($data['request'] as $request)
                {
                    if($request->collaborator_id == $singer->id)
                    {
                        $requestStatus = $request->Status;
                        break;// Exit loop once the matching request is found
                    }
                }
            ?>

                <div class="singer-card">
                    <img src="<?=ROOT?>/assets/images/user/<?php echo $singer->pro_pic ?>" alt="Singer 2">
                    <h3><?php echo $singer->name ?></h3>
                    <p>Music Genre</p>
                    <div class="button-wrapper">
                        <a href="collaborator-viewprofile?id=<?php echo $singer->id ?>" class="profile">Profile</a>
                        <form method = "POST">
                            <input name="event_id" type = "hidden" value="<?= htmlspecialchars($_GET["id"]) ?>">
                            <input name="collaborator_id" type = "hidden" value="<?php echo $singer->id ?>" >
                            <input name="role" type = "hidden" value="<?php echo $singer->user_role ?>">
                            <input name="Status" type = "hidden" value = "pending">
                            <input name="req_id" type="hidden" value = "<?php echo isset($request->id)? $request->id : 0; ?>">

                            <?php if($requestStatus=== null):?>
                                <!-- Show "Request" button if no request exists for this singer -->
                                <button name = "request" type = "submit" class="request">Request</button>

                            <?php elseif($requestStatus=== 'pending'):?>
                                <!-- Show "Cancel Request" button if the request is pending -->
                                <button name = "deleteRequest" type = "submit" class="cancel-request">Cancel Request</button>

                            <?php elseif($requestStatus === 'accepted'):?>
                                <!-- Show "Accepted" button (disabled) if the request is accepted -->
                                <button name = "request" type = "submit" class="accepted" disabled>Accepted</button>

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


    <?php if($error != ''): ?>
        <?php 
            $message = $error;
            include("../app/views/components/r-message.php")
        ?>
    <?php endif ?>

    <script>
        if (window.history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('flag');
            url.searchParams.delete('error');
            url.searchParams.delete('error_no');
            window.history.replaceState(null, '', url.toString());
        }
    </script>

<script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
    </div>
    
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>