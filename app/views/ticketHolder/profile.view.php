<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Buyer Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/profile.css">
</head>
<body>

<?php $id = htmlspecialchars($_GET['id']) ?>
    <div class="page-content">
        <h1 class="head1">My Ticket</h1>
        <div>
            <div class="container">
                <div class="avatar">
                    <img src="<?=$_SESSION['USER']->pro_pic ?>" alt="user image">
                </div>
                <h2 class="head2">Amanda Smith</h2>
                <h3 class="head3">amnd@gmail.com</h3>
                <div class="tag">
                    <div class="tag-item">24 Purchase</div>
                    <div class="tag-item">4 Following</div>
                    <div class="tag-item">10 Likes</div>
                </div>
                <a href="update-profile" class="button" type="button">Update Profile</a>
            </div>
            <div class="header-menu">
                <div class="header-menu-item selected">Upcoming</div>
                <div class="header-menu-item">Used</div>
            </div>
            <h3 class="event">4 Event</h3>
            <div class="textbox">
                <input type="text" name="search" id="search" placeholder="Search">
            </div>
            <div class="event-detail">
                <img class="event-image" src="https://media.istockphoto.com/id/613552524/photo/guitarist-on-stage-soft-and-blur-concept.jpg?s=612x612&w=0&k=20&c=_phKVgnj7AaY5TglzHdUZ4OgK4C_6Ly2iIIYuCS-Hi0=" alt="event" >
            </div>
        </div>
    </div>

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
    </script>
    
</body>
</html>

