<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/updateProfile.css"> 
    <title>Update Profile</title>
</head>
<body>
    
    <?php 
        $flag = htmlspecialchars($_GET['flag'] ?? 0);
        $error = htmlspecialchars($_GET['msg'] ?? '');
    ?>
    <div class="">
        <div class="page-content">
            <h1 class="head1">Edit profile</h1>
            <h3 class="head2">Profile Photo</h3>
            <div class="">
                <div class="image">
                    <div class="avatar">
                        <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="pro pic">
                    </div>
                    <div>
                        <p class="p1">Upload your photo</p>
                        <p class="p2">Your photo should be in PNG or JPG format</p>

                    </div>
                </div>

                <form  method="POST" enctype="multipart/form-data" class="image-form">
                    <div class="input-wrap">
                        <input type="file" name="pro_pic" id="fileInput">
                        <button type="submit" class="button" id="customButton" name="uploadImage">Upload File</button>
                    </div>
                </form>

                <div>
                    <form method="POST" class="form" >

                        <div class="input-wrap">
                            <!-- <label for="Name">Name</label> -->
                            <input name="name" type="text" placeholder="Name" value="<?php echo $_SESSION['USER']->name ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Email">Email</label> -->
                            <input name="email" type="email" placeholder="Email" value="<?php echo $_SESSION['USER']->email ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="contact">Contact</label> -->
                            <input name="contact" type="text" placeholder="Contact" value="<?php echo $_SESSION['USER']->contact ?>">
                        </div>

                        <div class="button-wrap">
                            <button type="button" onclick="goToProfile()">Cancel</button>
                            <button type="sumbit" name="update">Save profile</button>
                        </div>
                    </form>
                </div>
                <div class="change-password-container">
                        <h1 class="head1">Change Password</h1>
                        <form method="POST">
                            <div class="input-wrap">
                                <input name="password" type="password" placeholder="Enter Password" id="password">
                                <a href="#"  onclick="togglePasswordVisibility('password','toggleIcon')">
                                    <ion-icon name="eye-outline" id="toggleIcon"></ion-icon>
                                </a>
                            </div>
                            <div class="input-wrap">
                                <input name="n-password" type="password" placeholder="Enter New Password" id="s-password">
                                <a href="#"  onclick="togglePasswordVisibility('s-password','s-toggleIcon')">
                                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                                </a>
                            </div>
                            <div class="input-wrap">
                                <input name="c-password" type="password" placeholder="Confirm Password" id="c-password">
                                <a href="#" onclick="togglePasswordVisibility('c-password','c-toggleIcon')">
                                    <ion-icon name="eye-outline" id="c-toggleIcon"></ion-icon>
                                </a>
                            </div>
                            <div class="button-wrap">
                                <button type="button" >Forgot Password</button>
                                <button type="sumbit" name="change-password">Change Password</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <?php if($flag == 1):?>
        <?php
            $message = $error;
            include ("../app/views/components/r-message.php");
        ?>
    <?php elseif($flag == 2):?>
        <?php
            $message = $error;
            include ("../app/views/components/s-message.php");
        ?>
    <?php  endif ?>
    <?php if(!empty($data)): ?>
        <?php
            $message = $data['error'];
            include ("../app/views/components/r-message.php");
        ?>
    <?php  endif ?>

    <script>
        function goToProfile() {
            window.location.href = "profile?id=<?php echo $data['id']?>";
        }
    </script>

    <script src="<?=ROOT?>/assets/js/message.js"></script>
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>

    <!-- Ionicons Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>