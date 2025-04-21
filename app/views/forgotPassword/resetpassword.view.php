<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forgotpassword/resetpassword.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">

    <!-- Boxicons CSS for additional icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="password-reset-container">
        <div class="logo-image">
            <img src="<?=ROOT?>/assets/images/logo/logo.png" alt="company_logo">
            <span>
                <a href="javascript:history.back()">
                    Back
                </a>
            </span>
        </div>

        <h2>Set New Password</h2>
        <p>Enter your new password below</p>
        <form method="POST">
            <div class="input-wrap">
                <input type="password" name="password" class="input-field" id="s-password" >
                <label for="pass">Password</label>
                <a href="#" class="hide active" onclick="togglePasswordVisibility('s-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                </a>
            </div>
            <div class="input-wrap">
                <input type="password" name="c-password" class="input-field" id="c-password" >
                <label for="pass">Confirm Password</label>
                <a href="#" class="hide active" onclick="togglePasswordVisibility('c-password','c-toggleIcon')">
                    <ion-icon name="eye-outline" id="c-toggleIcon"></ion-icon>
                </a>
            </div>
            <button type="submit" name="change-password">Reset Password</button>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>

    <!-- Custom JS for password visibility toggle -->
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
</body>
</html>