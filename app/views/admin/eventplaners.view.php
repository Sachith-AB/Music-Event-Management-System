<?php include ('../app/views/components/header.php'); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin eventplanners</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/eventplanners.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/admin/dashsidebar.php');  ?>
        <div class="dashboard">
        <h2 class="dashboard-title">Event Planners</h2>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php if(!empty($data)): ?>

                    <?php foreach($data as $planner): ?>

                        <?php if($planner->role == 'planner'): ?>

                                <tr>
                                    <td><?php echo $planner->id ?></td>
                                    <td><?php echo $planner->name ?></td>
                                    <td><?php echo $planner->email ?></td>
                                    <td><?php echo $planner->contact ?></td>
                                    <td>
                                        <div class = "button-section">
                                            <form action="<?=ROOT?>/admin-vieweventplanner" method = "POST">
                                                <input type = "hidden" name ="user_id" value = "<?php echo $planner->id ?>">
                                                <button class="action-btn view" type = "submit" >View</button>
                                            </form>
                                             
                                            <form method = "POST">
                                                <input type = "hidden" name = "user_id" value = "<?php echo $planner->id ?>">
                                                <input type = "hidden" name = "is_delete" value = '1' >
                                                <button name = "delete" class="action-btn delete" type = "submit" >Delete</button>
                                            </form>
                                                
                                        </div> 
                                    </td>
                                </tr>

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php endif; ?>
                      
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<!-- <script>
    document.querySelector('.action-btn view').addEventListener('click', () => {
        windows.location.href = "<?=ROOT?>/event-planner-profile?id=<?php echo $planner->id ?>";
    });
</script> -->