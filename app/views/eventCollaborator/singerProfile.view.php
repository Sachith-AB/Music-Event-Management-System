<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings Page</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/singerProfile.css">
</head>
<body>

  <?php 
  // Capture success message and flag from GET request if available
  $success = htmlspecialchars($_GET['msg'] ?? '');
  $flag = htmlspecialchars($_GET['flag'] ?? 0);
  ?>



 

  <div class="dash-container">
    <!-- Include sidebar for navigation -->
    <?php include ('../app/views/components/collaborator/singersidebar.php'); ?>

    <div class="dashboard">
      <!-- Left section containing user profile information -->
      
      <div class="update-login-info">
        <form id="profiledetails" method="POST">
          <section class="headersection">
            <!-- Header section with background image -->
            
            <img src="<?=ROOT?>/assets/images/eventCollaborators/blue_cover_pic.jpg" alt="Musical Fusion Festival" class="headersection-img">
            <div class="uppersec">
              <div class="profile-info">
                <!-- Display user role selection if not already set -->
                <?php if (empty($profiledata['profile']['user_role'])): ?>
                  <label for="user_role">Select Collaborator Type:</label>
                  <select name="user_role" id="user_role" required>
                    <option value="singer">Singer</option>
                    <option value="band">Band</option>
                    <option value="announcer">Announcer</option>
                    <option value="sound">Sound And DJ</option>
                    <option value="decorator">Decoration</option>
                    <option value="stage">Stage Suppliers</option>
                  </select>
                <?php else:?>
                  <input type="hidden" value="<?php echo $profiledata['profile']['user_role'] ?? ''; ?>" name="user_role">
                <?php endif; ?>
                <?php if (!empty($profiledata['profile']['id'])): ?>
                  <input type="hidden" value="<?php echo $profiledata['profile']['id'] ?? ''; ?>" name="id">
                <?php endif; ?>
                <!-- Input for music genres -->
                <p><input type="text" name="music_genres" value="<?php echo $profiledata['profile']['music_genres'] ?? ''; ?>" placeholder="Enter your music genres (for singers and bands)..."></p>
              </div>
            </div>
          </section>

          <div class="profile-section">
            <div class="profile-left">
              <!-- About Me Section -->
              <div class="about-me">
                <h2>About me</h2>
                <textarea name="biography"  placeholder="Enter your biography here..." rows="4"><?php echo $profiledata['profile']['biography'] ?? ''; ?></textarea>
              </div>
              <br/>

              <!-- Skills Section -->
              <div class="skills">
                <h3>Skills</h3>
                <input type="text" name="skills" value="<?php echo $profiledata['profile']['skills'] ?? ''; ?>" placeholder="Enter your skills..." class="skill-tags">
              </div>

              <!-- Social Links Section -->
              <div class="social-links">
                <h3>Connect with me</h3>
                <div class="social-icons">
                  <div class="social-icons-input">
                    <i class="fab fa-facebook"></i>
                    <input type="text" name="fb" placeholder="Facebook URL" value="<?php echo $profiledata['profile']['fb'] ?? ''; ?>">
                  </div>
                  <div class="social-icons-input">
                    <i class="fab fa-twitter"></i>
                    <input type="text" name="twitter" placeholder="Twitter URL" value="<?php echo $profiledata['profile']['twitter'] ?? ''; ?>">
                  </div>
                  <div class="social-icons-input">
                    <i class="fab fa-instagram"></i>
                    <input type="text" name="insta" placeholder="Instagram URL" value="<?php echo $profiledata['profile']['insta'] ?? ''; ?>">
                  </div>
                  <div class="social-icons-input">
                    <i class="fab fa-youtube"></i>
                    <input type="text" name="youtube" placeholder="YouTube URL" value="<?php echo $profiledata['profile']['youtube'] ?? ''; ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" value="<?php echo $profiledata['profile']['userID'] ?? ''; ?>" name="userID">

          <!-- Submit Button -->
          <button type="submit" class="button" name="submit">Submit</button>
        </form>
        <br><br>
        <!-- Right Section with Skills and Social Links -->
        <div class="profile-right">
          <!-- Experiences Section -->
          <div class="experience">
            <h3>Experiences and Special Moments</h3>
            <?php if (!empty($profiledata['past_works'])): ?>
              <ul>
                <?php foreach ($profiledata['past_works'] as $work): ?>
                <li class="experiencepoint"><?php echo $work['past_work']; ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <div class="profile-experience">
              <form method="POST">
                <input type="text" name="experience" placeholder="Add a new experience">
                <button class="add-button" name="add_experience">Add this experience</button>
              </form>
                  
            </div>
          </div>    

          <!-- Services Section -->
          <div class="experience">
            <h3>Services</h3>
            <?php if (!empty($profiledata['services'])): ?>
              <ul>
                <?php foreach ($profiledata['services'] as $service): ?>
                  <li class="experiencepoint"><?php echo $service['service']; ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <div class="profile-experience">
              <form method="POST">
                <input type="text" name="service" placeholder="Add a new service">
                <button class="add-button" name="add_service">Add this service</button>
              </form>
            </div>
          </div>
        </div>  
      </div>
      

      <!-- Section for updating profile information -->
      <div class="update-profile-info">
        <h2>Update Profile Information</h2><br/>
        <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?? 'default.png'; ?>" alt="Profile Picture" class="profile-picture">
        <br/>
        <div class="input-group">
          <label for="name">Username:</label>
          <div class="input-text"><?php echo $_SESSION['USER']->name ?? 'N/A'; ?></div>
        </div>
        <div class="input-group">
          <label for="email">Email:</label>
          <div class="input-text"><?php echo $_SESSION['USER']->email ?? 'N/A'; ?></div>
        </div>
        <form method="POST"  class='buttons'>
          <a href="update-profile" class="button button-1" type="button">Update Profile</a>
          <button  class="button button-2" name="signOut" type="submit">Sign Out</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Display success message if flag is set -->
  <?php if ($flag == 2): ?>
    <?php 
    $message = $success;
    include ("../app/views/components/s-message.php"); 
    ?>
  <?php endif; ?>

  <!-- JavaScript Section -->
  <script>
    // Menu item selection handler
    const menuItems = document.querySelectorAll('.header-menu-item');
    menuItems.forEach(item => {
      item.addEventListener('click', function() {
        menuItems.forEach(i => i.classList.remove('selected'));
        this.classList.add('selected');
      });
    });
  </script>

  <!-- Message handling script -->
  <script src="<?=ROOT?>/assets/js/message.js"></script>

  <!-- Ionicons script for icons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>
