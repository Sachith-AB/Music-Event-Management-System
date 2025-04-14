
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Buyer Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <script src="<?=ROOT?>/assets/js/ticket_holder/profile.js"></script>
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
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[0]) ?> events</div>
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[1]) ?> tickets</div>
                    <div class="tag-item"><?= htmlspecialchars($ticketcount[2]) ?> price</div>
                </div>
                <form class="buttons" method="POST">
                    <button onclick="goToUpdate()" class="button button-1" type="button">Update</button>
                    <button class="button button-2" type="submit" name="logOut">Sign out</button>
                </form>
            </div>
            <?php if (!empty($pastTickets)): ?>
                <div class="upcommingeve-tickets">
                    <h2>My Events</h2>
                    <div class="tab-buttons">
                        <button class="tab-button active" onclick="showTab('past')">Past Events</button>
                        <button class="tab-button" onclick="showTab('upcoming')">Upcoming Events</button>
                    </div>

                    <!-- Past Events -->
                    <div id="past" class="tab-content">
                        <?php if (!empty($pastTickets)): ?>
                            <?php foreach ($pastTickets as $event): ?>
                                <a href="<?=ROOT?>/view-pastevent?id=<?= htmlspecialchars($event[0]->event_id) ?>" class="event-card-link">
                                    <div class="upcommingeve-ticket-card">
                                        <div class="event-status-process"><?= htmlspecialchars($event[0]->ticket_type) ?> - LKR<?= htmlspecialchars($event[0]->ticket_price) ?></div>
                                        <div class="upcommingeve-ticket-image">
                                            <img src="<?=ROOT?>/assets/images/events/<?= htmlspecialchars($event[0]->event_images) ?>" alt="Event Image">
                                        </div>
                                        <div class="upcommingeve-ticket-info">
                                            <h3><?= htmlspecialchars($event[0]->event_name) ?>: <?= htmlspecialchars($event[0]->event_description) ?></h3>
                                            <p>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event[0]->event_date))) ?></p>
                                            <p>📍 <?= htmlspecialchars($event[0]->address) ?></p>
                                            <div class="upcommingeve-ticket-meta"><?= htmlspecialchars($event['ticket_quantity']) ?> Tickets - LKR<?= htmlspecialchars($event['ticket_quantity'] * $event[0]->ticket_price) ?></div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="purchase-text">No past events found.</div>
                        <?php endif; ?>
                    </div>

                    <!-- Upcoming Events -->
                    <div id="upcoming" class="tab-content" style="display: none;">
                        <?php if (!empty($upcomingTickets)): ?>
                            <?php foreach ($upcomingTickets as $event): ?>
                                <div>
                                    <a href="<?=ROOT?>/view-event?id=<?= htmlspecialchars($event[0]->event_id) ?>" class="event-card-link">
                                        <div class="upcommingeve-ticket-card">
                                            <?php if(!empty($event['notifications'])): ?>
                                                <div class="notification-wrapper">
                                                    <button type="button" class="notificationBtn">
                                                        <div class="notification-icon">
                                                            <i class="fas fa-bell"></i>
                                                            <span class="notification-badge"><?= count($event['notifications']) ?></span>
                                                        </div>
                                                    </button>    
                                                </div>
                                            <?php endif; ?>

                                            <div class="event-status-process"><?= htmlspecialchars($event[0]->ticket_type) ?> - LKR<?= htmlspecialchars($event[0]->ticket_price) ?></div>
                                            <div class="upcommingeve-ticket-image">
                                                <img src="<?=ROOT?>/assets/images/events/<?= htmlspecialchars($event[0]->event_images) ?>" alt="Event Image">
                                            </div>
                                            <div class="upcommingeve-ticket-info">
                                                <h3><?= htmlspecialchars($event[0]->event_name) ?>: <?= htmlspecialchars($event[0]->event_description) ?></h3>
                                                <p>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event[0]->event_date))) ?></p>
                                                <p>📍 <?= htmlspecialchars($event[0]->address) ?></p>
                                                <div class="upcommingeve-ticket-meta"><?= htmlspecialchars($event['ticket_quantity']) ?> Tickets - LKR<?= htmlspecialchars($event['ticket_quantity'] * $event[0]->ticket_price) ?></div>
                                            </div>
                                            
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="purchase-text">No upcoming events found.</div>
                        <?php endif; ?>
                    </div>
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


    <script>
        document.querySelectorAll('.notificationBtn').forEach((btn, idx) => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation(); // Prevent from bubbling up to document

                const dropdown = this.nextElementSibling;

                // Close all other dropdowns
                document.querySelectorAll('.notificationDropdown').forEach(el => {
                    if (el !== dropdown) el.style.display = 'none';
                });

                // Toggle current
                dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
            });
        });

        // Hide dropdowns on clicking outside
        document.addEventListener('click', function () {
            document.querySelectorAll('.notificationDropdown').forEach(el => {
                el.style.display = 'none';
            });
        });
    </script>


    





    <script src="<?=ROOT?>/assets/js/message.js"></script>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>

