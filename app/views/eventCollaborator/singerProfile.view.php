<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings Page</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/singerProfile.css">
</head>
<body>
  <div class="dash-container">
    <?php include ('../app/views/components/collaborator/singersidebar.php');  ?>
      <div class="dashboard">
        <!-- left section -->
        <div class="update-login-info">
          <section class="headersection">
            <img src="<?=ROOT?>/assets/images/eventCollaborators/blue_cover_pic.jpg" alt="Musical Fusion Festival" class="headersection-img">
            <div class="uppersec">
              <div class="profile-info">
                <h1><input type="text" name="name" value="Mina Winkel" required></h1>
                <p><input type="text" name="genres" value="Jazz, Pop Singer"></p>
              </div>
            </div>    
          </section>

          <div class="profile-section">
            <div class="profile-left">
              <div class="about-me">
                <h2>About me</h2>
                <textarea name="bio" rows="4">I'm a singer based in [Location]. I specialize in [genres] and have a passion for delivering unforgettable performances...</textarea>
              </div>
              <br/>
              <div class="experience">
                <h3>Experiences and Special Moments</h3>
                <div class="singerimages">
                  <div class="image image1">
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Image 1" class="img">
                  </div>
                  <div class="image image2">
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent2.jpeg" alt="Image 2" class="img">
                  </div>
                  <div class="image image3">
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Image 3" class="img">
                  </div>
                  <div class="image image4">
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent4.jpg" alt="Image 4" class="img">
                  </div>
                </div>
              </div>
            </div>

            <div class="profile-right">
              <div class="skills">
                <h3>Skills</h3>
                <input type="text" name="skills" value="Singing, Songwriting, Live Performance" class="skill-tags">
              </div>
              <div class="contact-info">
                <h3>Email</h3>
                <input type="email" name="email" value="hello@mysingerwebsite.com">
              </div>
              <div class="social-links">
                <h3>Connect with me</h3>
                <div class="social-icons">
                  <div class="social-icons-input"><i class="fab fa-facebook"></i><input type="url" name="facebook" placeholder="Facebook URL" value="https://www.facebook.com"></div>
                  <div class="social-icons-input"><i class="fab fa-twitter"></i><input type="url" name="twitter" placeholder="Twitter URL" value="https://www.twitter.com"></div>
                  <div class="social-icons-input"><i class="fab fa-instagram"></i><input type="url" name="instagram" placeholder="Instagram URL" value="https://www.instagram.com"></div>
                  <div class="social-icons-input"><i class="fab fa-youtube"></i><input type="url" name="youtube" placeholder="YouTube URL" value="https://www.youtube.com"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Section for updating Profile Information -->
        <div class="update-profile-info">
          <h2>Update Profile Information</h2><br/>
            <form method="POST" enctype="multipart/form-data">
              <img src="<?=ROOT?>/assets/images/ticket/profilepic-icon.jpg" alt="Profile Picture" class="profile-picture">
              <br/>
              <div class="input-group">
                <label for="name">Username:</label>
                <input type="text" name="name" id="name" value="" required>
              </div>
              <div class="input-group">
                <label for="password">Password:</label>
                <input name="password" id="password"></input>
              </div>
              <div class="input-group">
                <label for="email">Email:</label>
                <input name="email" id="email"></input>
              </div>
              <button type="submit">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</body>
</html>
