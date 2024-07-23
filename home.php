<?php include('components/header.php');?>

    <?php 
        if(isset($_SESSION['add-user'])){
            echo $_SESSION['add-user'];
            unset($_SESSION['add-user']);
        }

    ?>
        
        <!-- Main contanent -->
        <div class="main-content">
            <div class="wrapper">
                <div>
                    Home
                </div>
            </div>
        </div>
        <!--Main end -->

<?php include('components/footer.php');