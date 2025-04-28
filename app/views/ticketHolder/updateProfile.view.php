<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/updateProfile.css">
</head>
<body>

<?php include ('../app/views/components/loading.php'); ?>

<?php 
    $flag = htmlspecialchars($_GET['flag'] ?? 0);
    if($flag == 1){
        $error = htmlspecialchars($_GET['msg'] ?? '');
    }else{
        $error = htmlspecialchars($_GET['msg'] ?? '');
    }
?>

<div class="up-main">
    <div class="up-container">
        <h1 class="up-title">Edit Profile</h1>

        <div class="up-container-child">
            <div class="personal-info">
                <!-- Profile Image Upload -->
                <div class="up-section">
                    <h3 class="up-subtitle">Profile Photo</h3>
                    <div class="up-avatar-section">
                        <div class="up-avatar">
                            <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="Profile Picture">
                        </div>
                        <div class="up-avatar-text">
                            <p>Upload your photo</p>
                            <span>PNG or JPG format</span>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="up-form-image">
                        <div class="up-input-file">
                            <input type="file" name="pro_pic" id="fileInput">
                            <button type="submit" name="uploadImage" class="up-btn">Upload</button>
                        </div>
                    </form>
                </div>

                <!-- Profile Edit Form -->
                <form method="POST" class="up-form">

                    <div class="up-input-wrap">
                        <input name="name" type="text" placeholder="First Name" value="<?php echo $_SESSION['USER']->name ?>">
                    </div>

                    <div class="up-input-wrap">
                        <input name="last_name" type="text" placeholder="Last Name" value="<?php echo $_SESSION['USER']->last_name ?>">
                    </div>

                    <div class="up-input-wrap">
                        <input name="email" type="email" placeholder="Email" value="<?php echo $_SESSION['USER']->email ?>">
                    </div>

                    <div class="up-input-wrap">
                        <input name="contact" type="text" placeholder="Contact Number" value="<?php echo $_SESSION['USER']->contact ?>">
                    </div>

                    <div class="up-button-group">
                        <button type="submit" name="update" class="up-btn">Save Changes</button>
                        <button type="button" class="up-btn-secondary" onclick="goToProfile()">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Change Password Section -->
            <div class="up-section change-password">
                <h1 class="up-title">Change Password</h1>
                <form method="POST" class="up-form">
                    <div class="up-input-wrap">
                        <input name="password" type="password" placeholder="Current Password" id="password">
                        <a href="#" onclick="togglePasswordVisibility('password','toggleIcon')">
                            <ion-icon name="eye-outline" class="up-password-icon" id="toggleIcon"></ion-icon>
                        </a>
                    </div>

                    <div class="up-input-wrap">
                        <input name="n-password" type="password" placeholder="New Password" id="s-password">
                        <a href="#" onclick="togglePasswordVisibility('s-password','s-toggleIcon')">
                            <ion-icon name="eye-outline" class="up-password-icon" id="s-toggleIcon"></ion-icon>
                        </a>
                    </div>

                    <div class="up-input-wrap">
                        <input name="c-password" type="password" placeholder="Confirm Password" id="c-password">
                        <a href="#" onclick="togglePasswordVisibility('c-password','c-toggleIcon')">
                            <ion-icon name="eye-outline" class="up-password-icon" id="c-toggleIcon"></ion-icon>
                            <ion-icon name="eye-outline" class="up-password-icon" id="c-toggleIcon"></ion-icon>
                        </a>
                    </div>

                    <div class="up-button-group">
                        <button type="submit" name="change-password" class="up-btn">Change Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function goToProfile() {
        window.location.href = "profile";
    }
    if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('flag');
        url.searchParams.delete('error');
        url.searchParams.delete('success');
        url.searchParams.delete('error');
        url.searchParams.delete('id');
        url.searchParams.delete('success_no');
        url.searchParams.delete('msg');
        window.history.replaceState(null, '', url.toString());
    }
</script>

<?php if (!empty($data['error'])): ?>
    <?php
        $message = $data['error'];
        include ("../app/views/components/r-message.php");
    ?>
<?php elseif ($flag == 1): ?>
    <?php
        $message = $error;
        include ("../app/views/components/r-message.php");
    ?>
<?php elseif ($flag == 2): ?>
    <?php
        $message = $error;
        include ("../app/views/components/s-message.php");
    ?>
<?php endif ?>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="<?=ROOT?>/assets/js/signin-up.js"></script>

</body>
</html>

<?php include ('../app/views/components/footer.php'); ?>
