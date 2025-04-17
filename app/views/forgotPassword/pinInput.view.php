<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter 4-Digit Code</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forgotpassword/pinInput.css">
</head>
<body>
    <div class="pin-container">
        <h2>Enter Verification Code</h2>
        <p>We’ve sent a 4-digit code to your email</p>
        <form class="pin-form" method="POST">
            <div class="pin-inputs">
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
            </div>
            <button type="submit">Verify Code</button>
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

</body>
</html>
