<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forgotPassword/forgotpassword.css">
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/logo/logo.png">
</head>
<body>
    <div class="container">
        <h2>Reset your password</h2>
        <h3>Forgot your password? 
            Please enter your email and we'll send ypu a 4-digit code.
        </h3>
        <form method="POST">
            <div class="input-wrap">
                <input type="text" name="email" class="input-field">
                <label for="email">Email</label>
            </div>
            <button type="submit">Get 4-digit code</button>
        </form>
    </div>
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
</body>
</html>