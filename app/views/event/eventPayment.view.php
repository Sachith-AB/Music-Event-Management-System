<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performer Payments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/payment.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/scheduledEvent.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/payment.js" defer></script>
</head>
<body>
    <section class="team-section">
        <h1>Performers' Payment Information</h1>
        <div>
            <table>
                <tbody>

                    <?php if (!empty($data['performers'])): ?>
                        <?php foreach ($data['performers'] as $performer): ?>

                            <tr>
                                <td>
                                    <img src="<?=ROOT?>/assets/images/user/<?php echo $performer['pro_pic'] ?>" alt="Performer">
                                    <span><?php echo $performer['name'] ?></span>
                                </td>
                                <td>
                                <form method = "POST" onsubmit="return validatePayment(this);">
                                    <input type="hidden" name="user_id" value="<?php echo $performer['id'] ?>">
                                    <input class="input-payment" type="number" name="payment" placeholder="Enter amount" min="1" step="0.01">
                                    <button type="submit" class="submit-btn" name="submit">Submit Payments</button>
                                    
                                </td>
                                </form>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No performers found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            
        </div>
        <button class="done-btn" onclick="goBack()">Done</button>
    </section>

    <div class="container1" style="justify-content: center;">
    <div class="chart-section">
        <h2 class="section-title">Total Payment</h2>
        <!--<pre><?php echo htmlspecialchars(json_encode($total_cost, JSON_PRETTY_PRINT)); ?></pre>--->
        <canvas id="paymentChart" 
            data-user_id='<?= json_encode($user_id) ?>' 
            data-total_cost='<?= json_encode($total_cost) ?>'>
        </canvas>

        </div>
        
    </div>

    <script>
        
        function goBack() {
            window.history.back();
        }

        function validatePayment(form) {
            const paymentInput = form.payment;
            const paymentValue = parseFloat(paymentInput.value);

            if (paymentValue <= 0) {
                alert("Please enter a payment amount greater than 0.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>