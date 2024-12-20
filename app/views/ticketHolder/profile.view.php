<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Buyer Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/profile.css">
</head>
<body>
    <?php include ('../app/views/components/loading.php'); ?>
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
                    <div class="tag-item">24 Purchase</div>
                    <div class="tag-item">4 Following</div>
                    <div class="tag-item">10 Likes</div>
                </div>
                <form class="buttons" method="POST">
                    <button onclick="goToUpdate()" class="button button-1" type="button">Update</button>
                    <button class="button button-2" type="submit" name="logOut">Sign out</button>
                </form>
            </div>
            <?php if (!empty($combinedTickets)): ?>
                <div class="upcommingeve-tickets">
                    <h2>My Tickets</h2>
                    <?php foreach ($combinedTickets as $event): ?>
                        <div class="upcommingeve-ticket-card">
                            <div class="upcommingeve-ticket-image">
                                <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Event Image">
                            </div>
                            <div class="upcommingeve-ticket-info">
                                <h3><?= htmlspecialchars($event[0]->event_name) ?>: <?= htmlspecialchars($event[0]->event_description) ?></h3>
                                <p>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event[0]->event_date))) ?></p>
                                <p>📍 <?= htmlspecialchars($event[0]->address) ?></p>
                                <div class="upcommingeve-ticket-meta"><?= htmlspecialchars($event['ticket_quantity']) ?> Tickets - LKR<?= htmlspecialchars($event['ticket_quantity'] * $event[0]->ticket_price) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="purchase-text">
                    No tickets have been purchased yet...
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if($flag == 2):?>
        <?php
            $message = $success;
            include ("../app/views/components/s-message.php")
            ?>
    <?php  endif ?>

    <script>
        const menuItems = document.querySelectorAll('.header-menu-item');
        
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove 'selected' class from all items
                menuItems.forEach(i => i.classList.remove('selected'));
                
                // Add 'selected' class to the clicked item
                this.classList.add('selected');
            });
        });

        function goToUpdate(){
            window.location.href = 'update-profile';
        }
    </script>

    <script src="<?=ROOT?>/assets/js/message.js"></script>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>

