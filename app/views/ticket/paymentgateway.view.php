<?php
$merchant_id = "1229373";
$merchant_secret = "MTk2MTI2MTY0MzQ3ODM5NjY0MzU0ODYwNjE5OTEzODAzMTkzOTc=";
$order_id = 1;
$amount = 3050.00;
$curreny = "LKR";
$hash_string = strtoupper(
    md5(
        $merchant_id .
            $order_id .
            number_format($amount, 2, '.', '') .
            $curreny .
            strtoupper(md5($merchant_secret))
    )
);
?>

<div class="payment-btn-div">
    <div>
        <a href="<?php echo ROOT; ?>setappoinment">
            <button class="payment-btn">Edit</button>
        </a>
    </div>
    <div>
        <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
            <input type="hidden" name="merchant_id" value="<?= $merchant_id ?>"> <!-- Replace with your Merchant ID -->
            <input type="hidden" name="return_url" value="<?php echo ROOT; ?>/payment_success?appo_id=<?php echo $_SESSION['appo_id'] ?>">
            <input type="hidden" name="cancel_url" value="<?php echo ROOT; ?>/payment_cancal">
            <input type="hidden" name="notify_url" value="<?php echo ROOT; ?>/payment_notify">

            <input type="hidden" name="order_id" value="<?= $order_id ?>">
            <input type="hidden" name="items" value="Appointment Payment"><br>
            <input type="hidden" name="currency" value="<?= $curreny ?>">
            <input type="hidden" name="amount" value="<?= $amount ?>">

            <input type="hidden" name="hash" value="<?php echo $hash_string; ?>">

            <input type="hidden" name="first_name" value="<?php echo $_SESSION['user']['firstName']; ?>">
            <input type="hidden" name="last_name" value="<?php echo $_SESSION['user']['lastName']; ?>">
            <input type="hidden" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
            <input type="hidden" name="phone" value="<?php echo $_SESSION['user']['phoneNumber']; ?>">
            <input type="hidden" name="address" value="<?php echo $_SESSION['user']['address']; ?>">
            <input type="hidden" name="city" value="Colombo">
            <input type="hidden" name="country" value="LK">

            <button type="submit" class="payment-btn2">Pay Now</button>
        </form>
    </div>
</div>