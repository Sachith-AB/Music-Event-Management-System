<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forgotpassword/resetpassword.css">
</head>
<body>
    <div class="password-reset-container">
        <h2>Set New Password</h2>
        <p>Enter your new password below</p>
        <form method="POST">
        <div class="input-wrap">
                <input type="text" name="n-password" class="input-field" id="n-password">
                <label for="new-password">New Password</label>
                <a href="#" class="hide active" onclick="togglePasswordVisibility('n-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                </a>
            </div>
            <div class="input-wrap">
                <input type="text" name="c-password" class="input-field" id="c-password">
                <label for="confirm-password">Confirm Password</label>
                <a href="#" class="hide active" onclick="togglePasswordVisibility('c-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                </a>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Custom JS for password visibility toggle -->
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
</body>
</html>