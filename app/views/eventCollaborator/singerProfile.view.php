<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings Page</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/singerProfile.css">
</head>
<body>
  <div class="settings-container">
    <div class="sidebar">
      <ul>
        <li class="active">Profile</li>
        <li>Account</li>
        <li>Chat</li>
        <li>Voice & video</li>
        <li>Appearance</li>
        <li>Notification</li>
      </ul>
    </div>
    <div class="content">

      <div></div>
      <h2 class="settings-heading">Settings</h2>

      <div class="profile-section">
        <!-- Profile Picture and Buttons -->
        <div class="profile-image-section">
          <h3>Profile Picture</h3>
          <div class="profile-image-wrapper">
            <img src="profile-pic.jpg" alt="Profile Picture">
            <div class="profile-buttons">
              <button class="change-pic-btn">Change picture</button>
              <button class="delete-pic-btn">Delete picture</button>
            </div>
          </div>
        </div>
        <br>

        <!-- Profile Info Fields -->
        <div class="profile-info">
          <div class="input-group">
            <label for="profile-name">Profile name</label>
            <input type="text" id="profile-name" value="Kevin Heart">
          </div>
          <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" value="@kevinhuy" readonly>
            <small>Available change in 25/04/2024</small>
          </div>
          <div class="input-group">
            <label for="status">Status recently</label>
            <input type="text" id="status" value="On duty">
          </div>
          <div class="input-group">
            <label for="about">About me</label>
            <textarea id="about" rows="4">Discuss only on work hour, unless you wanna discuss about music 🙏🏻</textarea>
          </div>
          <button class="save-btn">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
