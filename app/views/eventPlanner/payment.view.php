<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashboard.css">
</head>
<body>
<?php include ('../app/views/components/loading.php');?>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>
        
        
        
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>
