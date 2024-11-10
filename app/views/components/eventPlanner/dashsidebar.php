<!-- Sidebar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashsidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    
<aside class="sidebar">
        <ul class="sidebar-menu" id="sidebarMenu">
            <li><a href="event-planner-overview" class="menu-link"><i class="fas fa-chart-line"></i>   Overview</a></li>
            <li><a href="event-planner-createdevents" class="menu-link"><i class="fas fa-calendar-check"></i>   Created Events</a></li>
            <li><a href="event-planner-dashprofile" class="menu-link"><i class="fas fa-user"></i>   Profile</a></li>
            <li><a href="event-planner-payment" class="menu-link"><i class="fas fa-wallet"></i>   Payments</a></li>
           
        </ul>
    </aside>
    <script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>