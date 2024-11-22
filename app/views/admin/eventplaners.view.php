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
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>0760000000</td>
                        <td>
                            <button class="action-btn view">View</button>
                            <button class="action-btn delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>