<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="1">  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia Signup</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signin-up.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">



    <!-- toast css ang icon library -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
<?php 

    //Get the pass data from URL for sign in part
    //To handle Errors
    $email = htmlspecialchars($_GET['email'] ?? '');
    $pass = htmlspecialchars($_GET['pass'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 2);
    $error = htmlspecialchars($_GET['error']?? '');
    $role = htmlspecialchars($_GET['role']?? '');
    // echo $email;
    // echo $pass;
    // echo $flag;
    // echo $error;
    //echo $role;
?>
    <!-- loading page -->
    
        <style>
            .page-content {
                display: flex;
            }
        </style>

    

    <div class="page-content">


        <!-- <div class="shep shep-1"></div>
        <div class="shep shep-2"></div> -->
        <main class="sign-up-mode">
            <div class="box">
                <div class="inner-box">
                    <div class="form-warp">
                        <form class="sign-up-form" id="signupForm" method="POST">
                            <div class="logo-image">
                                <img src= "<?=ROOT?>/assets/images/logo/logo.png" alt="company_logo">
                                <!-- <h4>Amoral</h4> -->
                                <span>
                                    <a href="<?= ROOT ?>/home">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                        <!-- <ion-icon name="chevron-back-circle-outline"></ion-icon> -->
                                        Back
                                    </a>
                                </span>
                            </div>

                            <div class="heading">
                                <h2>Get Started</h2>
                                <h6>Already Have an account ?</h6>
                                <a href="signin" class="toggle">Sign In</a>
                            </div>
                            <div class="actual-form">
                                <div class="input-wrap">
                                    <input type="text" name="name" class="input-field" >
                                    <label for="fullname">Name</label>
                                    <span id="nameError" class="error"></span>
                                </div>
                                <div class="input-wrap">
                                    <input type="text" name="email" class="input-field">
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-wrap">
                                    <input type="password" name="password" class="input-field" id="s-password" >
                                    <label for="pass">Password</label>
                                    <a href="#" class="hide active" onclick="togglePasswordVisibility('s-password','s-toggleIcon')">
                                        <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                                    </a>
                                </div>
                                <div class="input-wrap">
                                    <input type="password" name="confirm-password" class="input-field" id="c-password" >
                                    <label for="pass">Confirm Password</label>
                                    <a href="#" class="hide active" onclick="togglePasswordVisibility('c-password','c-toggleIcon')">
                                        <ion-icon name="eye-outline" id="c-toggleIcon"></ion-icon>
                                    </a>
                                </div>
                                <input type="hidden" name="role"  id="role" value="<?php echo $role ?>" >
                                <input type="submit" name="signUp" value="SignUp" class="sign-btn" id="sign-up-btn">
                                <!-- <button type="submit" name="signUp" value="SignUp" class="sign-btn" id="sign-up-btn">SignUp</button> -->

                            

                            </div>

                                
                            
                                <p class="text">
                                    By signing up, I agree to the
                                    <a href="#" class="toggle-1">Terms of Services</a> and
                                    <a href="#" class="toggle-1">Privacy Policy</a>
                                </p>
                            </div>
                        </form>
                    </div>

                    <!-- --------------------------
                    Images Slider
                ------------------------------- -->
                    <div class="carousel">
                        <div class="images-wrapper">

                            <img src="<?= ROOT ?>/assets/images/sign-in-up/image-2.jpg" class="image img-1" alt="">
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

                            <!-- --------------------------
                            Bullets
                        ------------------------------- -->
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

    <!-- Show error
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
    <?php endif ?> -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>

    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
    <script src="<?=ROOT?>/assets/js/message.js"></script>

</body>
</html>