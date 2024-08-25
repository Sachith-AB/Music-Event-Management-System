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
                        <img src="<?php echo $data['pro_pic'] ?>" alt="pro pic">
                    </div>
                    <div>
                        <p class="p1">Upload your photo</p>
                        <p class="p2">Your photo should be in PNG or JPG format</p>
                        

                    </div>
                </div>
                <div>
                    <form method="POST" class="form" enctype="multipart/form-data">

                        <div class="input-wrap">
                            <input type="file" name="pro_pic" id="fileInput" accept="image/*" value="">
                            <button type="submit" class="button" id="customButton" name="uploadImage">Upload File</button>
                        </div>

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