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
            <li><a href="admin-dashboard" class="menu-link"><i class="fas fa-home"></i> Dashboard </a></li>
            <li><a href="admin-eventplanners" class="menu-link"><i class="fas fa-users-cog"></i> Event Planners </a></li>
            <li><a href="admin-eventcollaborators" class="menu-link"><i class="fas fa-handshake"></i> Event Collaborators </a></li>
            <li><a href="admin-ticketholders" class="menu-link"><i class="fas fa-ticket-alt"></i> Ticket Holders </a></li>
            <li>
                <a href="#reportSubMenu" class="menu-link" onclick="toggleSubMenu('reportSubMenu')">
                    <i class="fas fa-chart-line"></i> Reports <i class="fas fa-chevron-down" style="float:right;"></i>
                </a>
                <ul id="reportSubMenu" class="submenu" style="display: none;">
                    <li><a href="admin-user-report" class="menu-link"><i class="fas fa-user"></i> Users Report</a></li>
                    <li><a href="admin-event-report" class="menu-link"><i class="fas fa-calendar-alt"></i> Events Report</a></li>
                    <li><a href="admin-ticket-report" class="menu-link"><i class="fas fa-ticket-alt"></i> Tickets Report</a></li>
                </ul>
            </li>

        </ul>
    </aside>
    <script>
        function toggleSubMenu(id) {
            const submenu = document.getElementById(id);
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        }
    </script>

    <script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>