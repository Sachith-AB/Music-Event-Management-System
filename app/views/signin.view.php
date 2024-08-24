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
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">
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
                            <div class="logo">
                                <img src="<?= ROOT ?>/assets/images/" alt="company_logo">
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
                                <a href="signup" class="toggle">Sign Up</a>
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
                                    <a href="#" id="help" class="toggle-1">Get Help</a> Signing in
                                </p>

                            </div>
                        </form>
                    </div>

                    <!-- Image Slider -->
                    <div class="carousel">
                        <div class="images-wrapper">
                            <img src="<?= ROOT ?>/assets/images/Alee.png" class="image img-1 show" alt="">
                            <img src="<?= ROOT ?>/assets/images/signin-up/2.jpg" class="image img-2" alt="">
                            <img src="<?= ROOT ?>/assets/images/signin-up/3.jpg" class="image img-3" alt="">
                            <img src="<?= ROOT ?>/assets/images/signin-up/4.jpg" class="image img-4" alt="">
                        </div>
                        <div class="text-slider">
                            <div class="text-wrap">
                                <div class="text-group">
                                    <h2>Create Your Own Designs</h2>
                                    <h2>Customize as you like</h2>
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
        <div id="error-popup" class="popup">
            <ion-icon name="alert-circle-outline" style="font-size: 30px;"></ion-icon>
            <p id="error-message" class="p"><?php echo $data['error'] ?></p>
            <span id="countdown">5</span> sec
            </div>
        </div>

    <?php elseif($flag == 1): ?>
        <div id="error-popup" class="popup">
            <ion-icon name="alert-circle-outline" style="font-size: 30px;"></ion-icon>
            <p id="error-message" class="p"><?php echo $error ?></p>
            <span id="countdown">5</span> sec
            </div>
        </div>
    <?php endif ?>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>

</body>
</html>
