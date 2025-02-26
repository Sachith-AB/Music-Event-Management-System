<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin ticketholders</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/ticketholders.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/admin/dashsidebar.php');  ?>
        <div class="dashboard">
        <h2 class="dashboard-title">Ticket Holders</h2>
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

                        <?php foreach($data as $holder): ?>
                            <?php if($holder->role == "holder"): ?>

                                <tr>
                                    <td><?php echo $holder->id ?></td>
                                    <td><?php echo $holder->name ?></td>
                                    <td><?php echo $holder->email ?></td>
                                    <td><?php echo $holder->contact ?></td>

                                    <td>

                                        <button class="action-btn view">View</button>

                                            <form  method="post">
                                                        <input type = 'hidden' name = 'user_id' value = "<?php echo $holder->id ?>" >
                                                        <input type = 'hidden' name = 'is_delete' value = "1" >
                                                        <button class="action-btn delete" name = 'delete' type = 'submit' >Delete</button>    
                                            </form>

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