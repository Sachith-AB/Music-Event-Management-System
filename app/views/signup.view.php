<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <meta http-equiv="refresh" content="1">  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia Signup</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signin-up.css">


    



    <!-- toast css ang icon library -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">

    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">


</head>

<body>
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

                        <!-- --------------------------
                        Sign-In Part
                    ------------------------------- -->
                        <form method="POST" class="sign-in-form" id="signinForm">
                            <div class="logo">
                                <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="company_logo">
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
                                <h2>Welcome Back</h2>
                                <h6>Not Registred Yet ?</h6>
                                <a href="#" class="toggle">Sign Up</a>
                            </div>
                            <div class="actual-form">
                                <div class="input-wrap">
                                    <input type="text" name="email" class="input-field">
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-wrap">
                                    <input type="password" name="password" class="input-field" id="s-password">
                                    <label for="pass">Password</label>
                                    <a href="#" class="hide active">
                                        <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                                    </a>


                                </div>
                                <input type="submit" name="signIn" value="SignIn" class="sign-btn" accesskey="enter">
                                <p class="text">
                                    Forget your password or your login details?
                                    <a href="#" id="help" class="toggle-1">Get Help</a> Signing in
                                </p>

                            </div>
                        </form>


                        <!-- --------------------------
                        Sign-Up Part
                    ------------------------------- -->
                        <form class="sign-up-form" id="signupForm" method="POST">
                            <div class="logo">
                                <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="company_logo">
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
                                    <input type="text" name="fullname" class="input-field" >
                                    <label for="fullname">Name</label>
                                </div>
                                <div class="input-wrap">
                                    <input type="text" name="email" class="input-field">
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-wrap">
                                    <input type="password" name="password" class="input-field" id="r-password" >
                                    <label for="pass">Password</label>
                                    <a href="#" class="hide active" onclick="togglePasswordVisibility('r-password','r-toggleIcon')">
                                        <ion-icon name="eye-outline" id="r-toggleIcon"></ion-icon>
                                    </a>
                                </div>
                                <div class="input-wrap">
                                    <input type="password" name="re-password" class="input-field" id="re-password" >
                                    <label for="pass">Confirm Password</label>
                                    <a href="#" class="hide active" onclick="togglePasswordVisibility('re-password','re-toggleIcon')">
                                        <ion-icon name="eye-outline" id="re-toggleIcon"></ion-icon>
                                    </a>
                                </div>
                                <input type="submit" name="signUp" value="SignUp" class="sign-btn" id="sign-up-btn">
                                <!-- <button type="submit" name="signUp" value="SignUp" class="sign-btn" id="sign-up-btn">SignUp</button> -->
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

                            <img src="<?= ROOT ?>/assets/images/" class="image img-1 show" alt="">
                            <img src="<?= ROOT ?>/assets/images/" class="image img-2" alt="">
                            <img src="<?= ROOT ?>/assets/images/" class="image img-3" alt="">
                            <img src="<?= ROOT ?>/assets/images/" class="image img-4" alt="">
                        </div>
                        <div class="text-slider">
                            <div class="text-wrap">
                                <div class="text-group">
                                    <h2>Create Your Own Music Event</h2>
                                    <h2>Customize as you like</h2>
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

    
    
</body>

</html>