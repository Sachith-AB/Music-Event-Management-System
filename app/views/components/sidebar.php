<!-- Sidebar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <?php $id = htmlspecialchars($_GET['id'])?>
<aside class="sidebar">
        <ul class="sidebar-menu" id="sidebarMenu">
            <li><a href="request-singers?id=<?php echo $id?>" class="menu-link"><i class="fas fa-microphone"></i>  Singers</a></li>
            <li><a href="request-bands?id=<?php echo $id?>" class="menu-link"><i class="fas fa-guitar"></i>  Bands</a></li>
            <li><a href="request-sounds?id=<?php echo $id?>" class="menu-link"><i class="fas fa-volume-up"></i>  Sounds</a></li>
            <li><a href="request-decorators?id=<?php echo $id?>" class="menu-link"><i class="fas fa-paint-brush"></i>  Decorators</a></li>
            <li><a href="request-stages?id=<?php echo $id?>" class="menu-link"><i class="fas fa-theater-masks"></i>  Stages</a></li>
            <li><a href="request-announcers?id=<?php echo $id?>" class="menu-link"><i class="fas fa-bullhorn"></i>  Announcers</a></li>
        </ul>
    </aside>
    <script src="<?=ROOT?>/assets/js/request/singerdropdown.js"></script>
</body>
</html>