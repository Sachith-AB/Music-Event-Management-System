<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signin-up.css">

    <!-- Boxicons CSS for additional icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">
</head>

<body>

    <?php 

    //Get the pass data from URL for sign in part
    $email = htmlspecialchars($_GET['email'] ?? '');
    $pass = htmlspecialchars($_GET['pass'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 2);
    $error = htmlspecialchars($_GET['error']?? '');
    // echo $email;
    // echo $pass;
    // echo $flag;
    // echo $error;
    ?>

    <style>
        .page-content {
            display: flex;
        }
    </style>
    <div class="page-content">
        <main>
            <div class="box">
                <div class="inner-box">
                    <div class="form-warp">
                        <!-- Sign-In Form -->
                        <form method="POST" class="sign-in-form" id="signinForm">
                            <div class="logo-image">
                                <img src="<?=ROOT?>/assets/images/logo/logo.png" alt="company_logo">
                                <span>
                                    <a href="<?= ROOT ?>/home">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                        Back
                                    </a>
                                </span>
                            </div>

                            <div class="heading">
                                <h2>Welcome Back</h2>
                                <h6>Not Registered Yet?</h6>
                                <a href="home" class="toggle">Home</a>
                            </div>
                            <div class="actual-form">
                                <div class="input-wrap">
                                    <input type="text" name="email" class="input-field">
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-wrap">
                                    <input type="password" name="password" class="input-field" id="s-password">
                                    <label for="pass">Password</label>
                                    <a href="#" class="hide active" onclick="togglePasswordVisibility('s-password','s-toggleIcon')">
                                        <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                                    </a>
                                </div>
                                <input type="submit" name="signIn" value="Sign In" class="sign-btn" id="sign-in-btn">

                                <p class="text">
                                    Forgot your password or your login details?
                                    <a href="forgot-password" id="help" class="toggle-1">Get Help</a> Signing in
                                </p>

                            </div>
                        </form>
                    </div>

                    <!-- Image Slider -->
                    <div class="carousel">
                        <div class="images-wrapper">

                            <img src="<?= ROOT ?>/assets/images/sign-in-up/image-2.jpg" class="image img-1 show" alt="">
                            <img src="<?= ROOT ?>/assets/images/sign-in-up/image-4.jpg" class="image img-2" alt="">
                            <img src="<?= ROOT ?>/assets/images/sign-in-up/image-3.jpg" class="image img-3" alt="">
                            <img src="<?= ROOT ?>/assets/images/sign-in-up/image-1.jpg" class="image img-4" alt="">
                        </div>
                        <div class="text-slider">
                            <div class="text-wrap">
                                <div class="text-group">
                                    <h2>Create Your Own Music Events</h2>
                                    <h2>Customize as you like</h2>
                                    <h2>Purchase Your Ticket With Ease</h2>
                                    <h2>Follow Us On All Social Media</h2>

                                </div>
                            </div>

                            <!-- Bullets for Slider -->
                            <div class="bullets">
                                <span class="bull-1 active" data-value="1"></span>
                                <span class="bull-2" data-value="2"></span>
                                <span class="bull-3" data-value="3"></span>
                                <span class="bull-4" data-value="4"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Show error -->
    <?php if (!empty($data['error'])): ?>
        <?php 
            $message = $data['error'];
            include("../app/views/components/r-message.php")
        ?>

    <?php elseif($flag == 1): ?>
        <?php 
            $message = $error;
            include("../app/views/components/r-message.php")
        ?>
    <?php endif ?>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
    <script src="<?=ROOT?>/assets/js/message.js"></script>

</body>
</html>
