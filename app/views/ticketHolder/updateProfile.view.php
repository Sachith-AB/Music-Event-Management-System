<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/updateProfile.css"> 
    <title>Update Profile</title>
</head>
<body>
    <div class="">
        <div class="page-content">
            <h1 class="head1">Edit profile</h1>
            <h3 class="head2">Profile Photo</h3>
            <div class="">
                <div class="image">
                    <div class="avatar">
                        <img src="https://www.shutterstock.com/image-photo/adult-female-avatar-image-on-260nw-2419909229.jpg" alt="pro pic">
                    </div>
                    <div>
                        <p class="p1">Upload your photo</p>
                        <p class="p2">Your photo should be in PNG or JPG format</p>
                        <input type="file" name="p_p" id="fileInput" action="image/*" value="">
                        <button type="button" class="button" id="customButton">Upload File</button>

                    </div>
                </div>
                <div>
                    <form method="POST" class="form">

                        <div class="input-wrap">
                            <!-- <label for="Name">Name</label> -->
                            <input name="name" type="text" placeholder="Name" value="<?php echo $data['name'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Email">Email</label> -->
                            <input name="email" type="email" placeholder="Email" value="<?php echo $data['email'] ?>">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="contact">Contact</label> -->
                            <input name="contact" type="text" placeholder="Contact" value="<?php echo $data['contact'] ?>">
                        </div>

                        <div class="button-wrap">
                            <button type="button" onclick="goToProfile()">Cancel</button>
                            <button type="sumbit" name="update">Save profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goToProfile() {
            window.location.href = "profile?id=<?php echo $data['id']?>";
        }
    </script>

</body>
</html>