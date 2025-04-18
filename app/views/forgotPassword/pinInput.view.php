<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter 4-Digit Code</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forgotpassword/pinInput.css">
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
    <div class="pin-container">
        <div class="logo-image">
            <img src="<?=ROOT?>/assets/images/logo/logo.png" alt="company_logo">
            <span>
                <a href="javascript:history.back()">
                    Back
                </a>
            </span>
        </div>
        <h2>Enter Verification Code</h2>
        <p>We’ve sent a 4-digit code to your email</p>
        <form class="pin-form" method="POST">
            <div class="pin-inputs">
                <input type="text" name="c1" maxlength="1" required>
                <input type="text" name="c2" maxlength="1" required>
                <input type="text" name="c3" maxlength="1" required>
                <input type="text" name="c4" maxlength="1" required>
            </div>
            <button type="submit" name="verifyCode">Verify Code</button>
        </form>
    </div>
    <script>
        const inputs = document.querySelectorAll('.pin-inputs input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>

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

</body>
</html>
