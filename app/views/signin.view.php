<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/signin.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 class="head-1">Welcome Back</h1>
            <form>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" required>
                
                <div class="terms">
                    <input type="checkbox" id="agree" required>
                    <label for="agree">I agree with&nbsp;<a href="#">Terms & Conditions</a></label>
                </div>
                
                <button type="submit" class="sign-in-btn">Sign In</button>
                
                <p class="sign-in-link">Not Registerd Yet? <a href="#">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
