<link rel="stylesheet" href="<?=ROOT?>/assets/css/r-message.css">
<div id="error-popup" class="popup">
    <ion-icon name="alert-circle-outline" style="font-size: 30px;"></ion-icon>
    <p id="error-message" class="p"><?php echo $message?></p>
    <span id="countdown">5</span> sec

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="<?=ROOT?>/assets/js/message.js"></script>

</div>