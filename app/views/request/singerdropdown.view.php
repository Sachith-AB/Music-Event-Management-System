<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/request/singerdropdown.css">
  <title>Event Planner Dashboard</title>
</head>

<body>

  <nav class="navbar">
    <a href="#" class="nav-link">Dashboard</a>
    <a href="#" class="nav-link dropdown-toggle" onclick="toggleDropdown()">Singers</a>
  </nav>

 
  <div id="singerDropdown" class="dropdown-content">

    <?php foreach($data as $singer): ?>

        <div class="singer-item">
          <img src="<?=ROOT?>/assets/images/user/<?php echo $singer->pro_pic ?>" alt="Singer Profile" class="profile-pic">
          <p><?php echo $singer->name ?> </p>
          <button onclick="viewProfile(1)"> Profile</button>
          <button onclick="requestSinger(1)">Request</button>
        </div>

    <?php endforeach; ?>

    

    
    
    




    <!-- Repeat for additional singers -->
  </div>

  <script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>

</body>
</html>
