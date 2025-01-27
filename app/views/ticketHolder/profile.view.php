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
        <h1 class="head1">My Profile</h1>
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
            <div class="header-menu">
                <div class="header-menu-item selected">Upcoming</div>
                <div class="header-menu-item">Used</div>
            </div>
            <h3 class="event">4 Event</h3>
            <div class="textbox">
                <input type="text" name="search" id="search" placeholder="Search">
            </div>
            <!-- <div class="event-detail">
                <div>
                    <img class="event-image" src="<?=ROOT?>/assets/images/events/image-1.jpg" alt="event" >
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

