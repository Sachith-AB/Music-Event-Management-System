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
            <form>
                <div class="input-wrap">
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Name" required>

                </div>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" required>

                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" required>
                
                <label for="password">Confirm Password</label>
                <input type="password" id="password" placeholder="Confirm Password" required>

                <div class="terms">
                    <input type="checkbox" id="agree" required>
                    <label for="agree">I agree with&nbsp;<a href="#">Terms & Conditions</a></label>

                </div>
                
                <button type="submit" class="sign-up-btn">Sign Up</button>
                
                <p class="sign-in-link">Already have an account? <a href="signin">Log in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
