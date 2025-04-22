<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket holder Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/viewticketholder.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <script src="<?=ROOT?>/assets/js/ticket_holder/profile.js"></script>
    <?php 
    include ('../app/views/components/loading.php');
    // Set default value for showMore if not set
    $showMore = isset($_POST['showMore']) ? $_POST['showMore'] == 'true' : false; 
    ?>
    <?php //$id = $_SESSION['USER']->id;

    $success = htmlspecialchars($_GET['msg'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 0);
    //show($_SESSION['USER']);
    
    ?>
    <div class="page-content">
        <div class="all">
        <div class="container">
                <h2>My Profile</h2>
                
                
                    <div class="avatar">
                        <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="user image">        
                    </div>
                <div class="details">
                    <h2 class="head2"><?php echo $_SESSION['USER']->name ?></h2>
                    <h3 class="head3"><?php echo $_SESSION['USER']->email ?></h3>
                    <h3 class="head3"><?php  echo $_SESSION['USER']->contact ?></h3>
                </div>
                <div class="tag">
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[0]) ?> events</div>
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[1]) ?> tickets</div>
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[2]) ?> price</div>
                </div>
            </div>

        </div>
    </div>
</body>