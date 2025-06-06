<DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/footer.css">
        <title>Musicia</title>
        <link rel = "stylesheet" href = "css/style.css">
    </head>
    <body>
        
        <section class="footer">
        <div class="box-container">

        <div class="box">
        <h3>EXTRA LINKS</h3>
        <?php if(isset($_SESSION['USER']) && $_SESSION['USER']->is_admin): ?>
            <a href="ask-question-admin"><i class="fas fa-angle-right"></i>Ask Questions</a>
        <?php else: ?>
            <a href="ask-question"><i class="fas fa-angle-right"></i>Ask Questions</a>
        <?php endif; ?>
            <a href="about-us"><i class="fas fa-angle-right"></i>About Us</a>
            <a href="privacy"><i class="fas fa-angle-right"></i>Privacy Policy</a>
            <a href="terms-of-use"><i class="fas fa-angle-right"></i>Terms of Use</a>
        </div>


            <div class ="box">
            <h3>FOLLOW US</h3>
                <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i>Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i>Linkedin</a>
            </div>
        </div>

        <div class="credit"> created by <span> team 404 </span> | © 2024 Musicia. All rights reserved.</div>
        </section>

        <link rel="stylesheet" href="<?=ROOT?>/assets/css/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </body>
</html>