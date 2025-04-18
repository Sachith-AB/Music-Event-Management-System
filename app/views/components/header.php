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
    //show($_SESSION["USER"]);
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
                <li><a href="#new-events">Upcoming Events</a></li>
                <?php if($_SESSION['USER']): ?>
                    <?php if($_SESSION['USER']->role == 'planner'): ?>
                        <li><a href="event-planner-dashboard">Dashboard</a></li>
                    <?Php endif ?>    
                    <?php if($_SESSION['USER']->role == 'collaborator'): ?>
                        <li><a href="colloborator-dashboard?id=<?= $_SESSION['USER']->id ?>">Dashboard</a></li>
                    <?Php endif ?>
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
