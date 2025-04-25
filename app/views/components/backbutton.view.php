<!-- backbutton.view.php -->
<div class="back-button">
    <a href="#" onclick="handleBack()" class="back-link">
        <i class="fas fa-chevron-left"></i>
    </a>
</div>

<script>
    function handleBack() {
        if (document.referrer && document.referrer !== window.location.href) {
            window.history.back();
        } else {
            // fallback if no history: redirect to dashboard or a safe route
            window.location.href = "<?= ROOT ?>/user/dashboard"; // update to your fallback route
        }
    }
</script>

