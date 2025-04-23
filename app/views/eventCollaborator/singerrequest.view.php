<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/singerrequest.css">
</head>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    <?php 
  // Capture success message and flag from GET request if available
    $success = htmlspecialchars($_GET['msg'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 0);
    ?>

    <div class="dash-container">
        <!-- Include sidebar for navigation -->
        <?php include ('../app/views/components/collaborator/singersidebar.php'); ?>
        <div class="dashboard">
            <div class="container-table">
                <h1>Requests</h1>
                <br>
                <table class="rtable">
                    <thead>
                        <tr>
                            <th>Cover Image</th>                   
                            <th>Event name</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($data['requests'])): ?>
                        
                        <?php foreach( $data['requests'] as $request):?>
                            <tr onclick="viewEventDetails(<?php echo $request->event_id; ?>,<?php echo $_SESSION['USER']->id; ?>)">
                                <td><?php
                                $coverImages = json_decode($request->cover_images, true);
                                $firstImage = $coverImages[0] ?? ''; // fallback if empty
                                ?>
                                <img class="cover-image" src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="cover image"/></td>
                                <td><?php echo $request->event_name?></td>
                                <td><?php echo $request->eventDate?></td>
                                <td class="truncate-text"><?php echo $request->address?></td>

                                <td>

                                    <form method = "POST" >
                                        <input type="hidden" name ="req_id" value = "<?php echo isset($request->request_id) ? $request->request_id : 0;?>">
                                        <input type="hidden" name ="Status" value = "accepted">
                                        <button name = "accept" type = "submit"  class = "accept">Accept</button>

                                    </form>
                                    

                                    <form method = "POST" >
                                        <input type="hidden" name ="req_id" value = "<?php echo isset($request->request_id) ? $request->request_id : 0;?>">
                                        <input type="hidden" name ="Status" value = "rejected">
                                        <button name = "reject" type = "submit"  class = "reject">Reject</button>

                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>

                    
                </table>
                <script>
                    function viewEventDetails(eventId,sender_id) {
                        window.location.href = `collaborator-eventdetails?event_id=${eventId}&sender_id=${sender_id}`;
                    }
                </script>
            </div>
            <br><br>
            <div class="container-table">
            <h1>Accepted Events</h1>
            <br>
            <table class="rtable" class="second" >
                <thead>
                    <tr>
                        <th>Cover Image</th> 
                        <th>Event name</th>
                        <th>Date</th>
                        <th>Venue</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data['accepted'])): ?>

                        <?php foreach($data['accepted'] as $request): ?>

                        <tr onclick="viewEventDetails(<?php echo $request->event_id; ?>,<?php echo $_SESSION['USER']->id; ?>)">
                            <td> <?php
                            $coverImages = json_decode($request->cover_images, true);
                            $firstImage = $coverImages[0] ?? ''; // fallback if empty
                            ?>
                            <img class="cover-image" src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?> " alt="cover image"></td>
                            <td><?php echo $request->event_name?></td>
                            <td><?php echo $request->eventDate?></td>
                            <td class="truncate-text"><?php echo $request->address?></td>
                        </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <br><br>

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