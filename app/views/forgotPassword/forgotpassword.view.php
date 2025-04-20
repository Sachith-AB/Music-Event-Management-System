<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forgotPassword/forgotpassword.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signin-up.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">

    <!-- Boxicons CSS for additional icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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

    <div class="container">
        <div class="logo-image">
            <img src="<?=ROOT?>/assets/images/logo/logo.png" alt="company_logo">
            <span>
                <a href="javascript:history.back()">
                    Back
                </a>
            </span>
        </div>
        <h2>Reset your password</h2>
        <h3>Forgot your password? 
            Please enter your email and we'll send you a 4-digit code.
        </h3>
        <form method="POST">
            <div class="input-wrap">
                <input type="text" name="email" class="input-field">
                <label for="email">Email</label>
            </div>
            <button type="submit" name="verify">Get 4-digit code</button>
        </form>
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

    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
</body>
</html>