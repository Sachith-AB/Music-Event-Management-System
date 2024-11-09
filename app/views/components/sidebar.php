<!-- Sidebar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/sidebar.css">
</head>
<body>
    <?php $id = htmlspecialchars($_GET['id'])?>
<aside class="sidebar">
        <ul class="sidebar-menu" id="sidebarMenu">
            <li><a href="request-singers?id=<?php echo $id?>" class="menu-link">Singers</a></li>
            <li><a href="request-bands" class="menu-link">Bands</a></li>
            <li><a href="#" class="menu-link">Sounds</a></li>
            <li><a href="#" class="menu-link">Descorators</a></li>
        </ul>
    </aside>
    <script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>