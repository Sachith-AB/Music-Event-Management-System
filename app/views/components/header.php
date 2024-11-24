<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/landing.css">
</head>
<body>
<?php 
    if (!isset($_SESSION['USER'])) {
        $_SESSION['USER'] = null;
    }
    //show($_SESSION["USER"]);
?>
<header>
    <div class="logo-image">
        <img src = "<?=ROOT?>/assets/images/logo/logo.png" alt = "musicia" onclick="goToHome()"> 
    </div>
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
                    <li><a href="colloborator-dashboard">Dashboard</a></li>
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
</header>

    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <button class="close-btn" onclick="closeModal()">×</button>
            <h2>Select Your Role</h2>
            <a href="signup?role=planner" class="role-btn">Event Planner</a>
            <a href="signup?role=colloborator" class="role-btn">Collaborator</a>
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

</script>
</body>
</html>
