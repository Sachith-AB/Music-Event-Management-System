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
            <li><a href="colloborator-dashboard?id=<?= $_SESSION['USER']->id ?>" class="menu-link"><i class="fas fa-chart-line"></i> Dashboard </a></li>
            <li><a href="colloborator-calendar" class="menu-link"><i class="fas fa-calendar-alt"></i> Calendar </a></li>
            <li><a href="colloborator-requests" class="menu-link"><i class="fas fa-clipboard-list"></i> Requests </a></li>
            <li><a href="colloborator-payments" class="menu-link"><i class="fas fa-wallet"></i> Payment </a></li>
            <li><a href="colloborator-events" class="menu-link"><i class="fas fa-bullhorn"></i> Future Events </a></li>
            <li><a href="colloborator-profile?id=<?= $_SESSION['USER']->id ?>" class="menu-link"><i class="fas fa-user"></i> Profile </a></li>
        </ul>
    </aside>
    <script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>