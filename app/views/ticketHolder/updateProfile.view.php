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
                    <form action="POST" class="form">

                        <div class="input-wrap">
                            <!-- <label for="Name">Name</label> -->
                            <input type="text" placeholder="Name">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="Email">Email</label> -->
                            <input type="email" placeholder="Email">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="contact">Contact</label> -->
                            <input type="text" placeholder="Contact">
                        </div>

                        <div class="input-wrap">
                            <!-- <label for="about">About me</label> -->
                            <textarea type="text" maxlength="255" placeholder="Tell something about yourself"></textarea>
                        </div>

                        <div class="button-wrap">
                            <button>Cancel</button>
                            <button>Save profile</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>