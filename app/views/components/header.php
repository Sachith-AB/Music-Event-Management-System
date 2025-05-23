<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/header.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php 
    if (!isset($_SESSION['USER'])) {
        $_SESSION['USER'] = null;
    }
    
    if (!empty($notifications['newnotifications']) && is_array($notifications['newnotifications'])) {
        usort($notifications['newnotifications'], function($a, $b) {
            return strtotime($b->created_at) - strtotime($a->created_at);
        });
    }
    
    if (!empty($notifications['allnotifications']) && is_array($notifications['allnotifications'])) {
        usort($notifications['allnotifications'], function($a, $b) {
            return strtotime($b->created_at) - strtotime($a->created_at);
        });
    }
?>
<header>
    <!-- <nav>
        <ul>
            <li><a href = "#" onclick = "history.back()"> Back </a></li>
        </ul>
    </nav> -->
    <div class="logo-image">
        <img src = "<?=ROOT?>/assets/images/logo/logo.png" alt = "musicia" onclick="goToHome()"> 
    </div>
    <div class="nav-right">
        <nav>
            <ul>
                <li><a href="home">Home</a></li>
                <li><a href="search">Explore</a></li>
                <?php if($_SESSION['USER']): ?>
                    <?php if($_SESSION['USER']->role == 'planner'): ?>
                        <li><a href="event-planner-dashboard">Dashboard</a></li>
                    <?Php endif ?>    
                    <?php if($_SESSION['USER']->role == 'collaborator'): ?>
                        <li><a href="colloborator-dashboard?id=<?= $_SESSION['USER']->id ?>">Dashboard</a></li>
                    <?Php endif ?>

                    <?php if($_SESSION['USER']->is_admin == 1): ?>
                        <li><a href="admin-dashboard">Dashboard</a></li>
                    <?php endif ?>

                    <!-- Notifications Modal -->
                    <div class="notification-wrapper" style="position: relative;">
                        <button class="avatarbadge" id="notificationButton" type="button">
                            <i class="fas fa-bell"></i>
                            <?php if (!empty($notifications["newnotifications"])): ?>
                                <span class="notification-indicator">
                                    <?= count($notifications["newnotifications"]) ?>
                                </span>
                            <?php endif; ?>
                        </button>
                        <!-- Notifications Popup -->
                        <div id="notificationPopup" class="notification-popup" style="display: none;">

                            <?php if (!empty($notifications["allnotifications"]) && is_array($notifications["allnotifications"])): ?>
                                <ul>
                                    <?php foreach ($notifications["allnotifications"] as $note): ?>
                                        <li class="notification-item" onclick="window.location.href='<?= $note->link ?>&note_id=<?= $note->id ?>'">
                                            <strong><?= htmlspecialchars($note->title) ?></strong><br>
                                            <?php 
                                                $messages = json_decode($note->message);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($messages)) {
                                                    foreach ($messages as $msg) {
                                                        echo "<div>" . htmlspecialchars($msg) . "</div>";
                                                    }
                                                } else {
                                                    echo "<div>" . htmlspecialchars($note->message) . "</div>";
                                                }
                                            ?>
                                            <small><?= date('F j, Y, g:i a', strtotime($note->created_at)) ?></small>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No notifications found.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- js for header -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                        const notifButton = document.getElementById("notificationButton");
                        console.log("Notification button:", notifButton);
                        const popup = document.getElementById("notificationPopup");

                        notifButton.addEventListener("click", function () {
                        // Toggle popup
                        const isHidden = window.getComputedStyle(popup).display === "none";
                        popup.style.display = isHidden ? "block" : "none";


                        // Send POST request to mark as read
                        fetch(window.location.href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'changeread=true'
                        }).then(() => {
                            // Optionally remove the red indicator
                            const indicator = document.querySelector(".notification-indicator");
                            if (indicator) indicator.remove();
                            });
                        });    

                            // Hide popup when clicking outside
                            document.addEventListener('click', function (e) {
                                if (!notifButton.contains(e.target) && !popup.contains(e.target)) {
                                    popup.style.display = "none";
                                }
                            });
                        });
                    </script>

                    <?php
                    // Determine the appropriate function to call based on the user's role
                    $onClickFunction = $_SESSION['USER']->role === 'collaborator' ? 'goToColloboratorProfile()' : 'goToProfile()'?>
                    <img class="image" onclick="<?= $onClickFunction ?>"  src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="user profile">
                <?php else: ?>
                    <li><a href="signin" class="sign-up">Sign In</a></li>
                    <li><a class="sign-up" onclick="openModal()">Sign Up</a></li>
                <?php endif ?>
                
            </ul>
        </nav>
    </div>
</header>

    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <button class="close-btn" onclick="closeModal()">×</button>
            <h2>Select Your Role</h2>
            <a href="signup?role=planner" class="role-btn">Event Planner</a>
            <a href="signup?role=collaborator" class="role-btn">Collaborator</a>
            <a href="signup?role=holder" class="role-btn">Common User</a>
        </div>
    </div>

<script>


    // document.querySelectorAll('nav ul li a').forEach(link => {
    //     link.addEventListener('click', function(e) {
    //         e.preventDefault();

    document.addEventListener('DOMContentLoaded', function() {
        // Get all navigation links
        const navLinks = document.querySelectorAll('nav ul li a');
        const currentPath = window.location.pathname;


        // Function to set active state
        function setActiveLink() {
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                // Remove active class from all links
                link.classList.remove('active');
                
                // Check if the link's href matches the current path
                if (href === currentPath || 
                    (href.startsWith('#') && window.location.hash === href) ||
                    (currentPath.includes(href) && href !== '/')) {
                    link.classList.add('active');
                }
            });
        }

        // Set initial active state
        setActiveLink();

        // Handle click events
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // If it's a hash link, prevent default and scroll
                if (href.startsWith('#')) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({ 
                        behavior: 'smooth' 
                    });
                    // Update active state after scroll
                    setTimeout(setActiveLink, 100);
                } else {
                    // For regular links, update active state immediately
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Update active state on hash change
        window.addEventListener('hashchange', setActiveLink);
    });

    function goToProfile() {
        window.location.href = "profile";
    };

    function goToColloboratorProfile(){
        window.location.href = "colloborator-profile"
    }

    function goToHome (){
        window.location.href = "home"
    }

    // Function to open the modal
    function openModal() {
        document.getElementById('modalOverlay').style.display = 'flex';
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('modalOverlay').style.display = 'none';
    }

    <?php if (isset($backPath)): ?>
        <a href="<?= $backPath; ?>" >  Back </a>
    <?php endif ?>
    
</script>
</body>
</html>