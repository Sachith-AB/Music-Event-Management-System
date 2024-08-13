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
            <h1>Create an Account</h1>
            <form>
                <label for="name">Full Name</label>
                <input type="text" id="name" placeholder="Enter your full name" required>

                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Choose a username" required>

                <label for="email">Email</label>
                <input type="email" id="email" placeholder="example.email@gmail.com" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter at least 8+ characters" required>
                
                <div class="terms">
                    <input type="checkbox" id="agree" required>
                    <label for="agree">I agree with <a href="#">Terms & Conditions</a></label>
                </div>
                
                <button type="submit" class="sign-up-btn">Sign Up</button>
                
                <div class="alternative-signup">
                    <p>Or sign up with</p>
                    <div class="social-buttons">
                        <button class="google-btn">G</button>
                        <button class="facebook-btn">f</button>
                    </div>
                </div>
                
                <p class="sign-in-link">Already have an account? <a href="#">Log in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
