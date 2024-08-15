<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/signup.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>Get Started</h1>
            <form method="POST">
                <div class="input-wrap">
                    <label for="name">Name</label>
                    <input name="name" type="text" id="name" placeholder="Name" >

                </div>
                <label for="email">Email</label>
                <input name="email" type="email" id="email" placeholder="Email" >

                <label for="password">Password</label>
                <input name="password" type="password" id="password" placeholder="Password" >
                
                <label for="password">Confirm Password</label>
                <input name="confirm-password" type="password" id="confirm password" placeholder="Confirm Password" >

                <div class="terms">
                    <input name="agree" type="checkbox" id="agree">
                    <label for="agree">I agree with&nbsp;<a href="#">Terms & Conditions</a></label>
                </div>
                
                <button type="submit" class="sign-up-btn">Sign Up</button>
                
                <p class="sign-in-link">Already have an account? <a href="signin">Log in</a></p>

                <?php if(!empty($errors)): ?>
                    <div>
                        <?=implode("<br>",$errors)?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
