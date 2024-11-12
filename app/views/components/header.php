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
?>
<header>
    <div class="logo">
        <img src = "logo.png" alt = "musicia" onclick="goToHome()"> 
    </div>
    <nav>
        <ul>
            <li><a href="search">Explore</a></li>
            <li><a href="#new-events">Upcoming Events</a></li>
            <?php if($_SESSION['USER']): ?>
                <img class="image" onclick="goToProfile()" src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="user profile">
            <?php else: ?>
                <li><a href="signup" class="sign-up">Sign Up</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>

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

    function goToHome (){
        window.location.href = "home"
    }
</script>
</body>
</html>
