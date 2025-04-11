<?php
session_start();

$current_page = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['page_history'])) {
    $_SESSION['page_history'] = [];
}

if (end($_SESSION['page_history']) !== $current_page) {
    $_SESSION['page_history'][] = $current_page;
}

if (count($_SESSION['page_history']) > 10) {
    array_shift($_SESSION['page_history']); // Keep only the last 10 pages
}

// Map paths to display-friendly names
$pageNames = [
    'home' => 'Home',
    'search' => 'Explore',
    'event-planner-dashboard' => 'Dashboard',
    'event-planner-messages' => 'Messages',
    'event-planner-calendar' => 'Calendar',
    'view-event' => 'View Event',
    'colloborator-dashboard' => 'Dashboard',
    'create-event' => 'Create Event',
    'signin' => 'Sign In',
    'signup' => 'Sign Up',
    'profile' => 'Profile',
    'colloborator-profile' => 'Collaborator Profile'
];

// Function to extract the base path
function getPageKey($url) {
    $parts = explode('?', $url)[0]; // Remove query string
    $parts = explode('/', trim($parts, '/'));
    return end($parts); // Get last part
}


?>



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
        <!-- Breadcrumb -->
        <?php if (!empty($_SESSION['page_history'])): ?>
            <div class="breadcrumb">
                <?php
                $breadcrumbs = [];
                $lastPages = array_slice($_SESSION['page_history'], -5); // Get only last 5 pages
                foreach ($lastPages as $page) {
                    $key = getPageKey($page);
                    $name = isset($pageNames[$key]) ? $pageNames[$key] : ucfirst($key);
                    $breadcrumbs[] = "<a href='$page'>$name</a>";
                }
                echo implode(' <i class="fas fa-chevron-right" style="margin: 0 5px; color: #888;"></i> ', $breadcrumbs);
                ?>
            </div>
        <?php endif; ?>

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
    document.querySelectorAll('nav ul li a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelectorAll('nav ul li a').forEach(el => el.classList.remove('active'));

            this.classList.add('active');

            if (this.getAttribute('href').startsWith('#')) {
                document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            } else {
                window.location.href = this.getAttribute('href');
            }   
        });
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
