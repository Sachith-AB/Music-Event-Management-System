<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin collaborators</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/collaborators.css">
    <script>
        function toggleSection(sectionId, iconId) {
            const section = document.getElementById(sectionId);
            const icon = document.getElementById(iconId);
            if (section.style.display === "none") {
                section.style.display = "block";
                icon.classList.remove("fa-chevron-down");
                icon.classList.add("fa-chevron-up");
            } else {
                section.style.display = "none";
                icon.classList.remove("fa-chevron-up");
                icon.classList.add("fa-chevron-down");
            }
        }

    </script>
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/admin/dashsidebar.php');  ?>
        <div class="dashboard">
            <h2 class="dashboard-title">Event Collaborators</h2>
            
            <!-- singers -->
            <div class="collaborator-section">
                <div class="section-header">
                    <h3><i class="fas fa-microphone"></i>  Singers</h3>
                    <i id="toggle-icon-1" class="fa-solid fa-chevron-up toggle-icon" 
                    onclick="toggleSection('collaborator-content-1', 'toggle-icon-1')"></i>
                </div>
                <div id="collaborator-content-1" class="section-content">
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
                                <td>3</td>
                                <td>Jane Smith</td>
                                <td>janesmith@example.com</td>
                                <td>0760000000</td>
                                <td>
                                    <button class="action-btn view">View</button>
                                    <button class="action-btn delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
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
            
            <!-- Bands -->
            <div class="collaborator-section">
                <div class="section-header">
                    <h3><i class="fas fa-guitar"></i>  Bands</h3>
                    <i id="toggle-icon-2" class="fa-solid fa-chevron-up toggle-icon" 
                    onclick="toggleSection('collaborator-content-2', 'toggle-icon-2')"></i>
                </div>
                <div id="collaborator-content-2" class="section-content">
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
                                <td>3</td>
                                <td>Jane Smith</td>
                                <td>janesmith@example.com</td>
                                <td>0760000000</td>
                                <td>
                                    <button class="action-btn view">View</button>
                                    <button class="action-btn delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
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
            <!-- sounds -->
            <div class="collaborator-section">
                <div class="section-header">
                    <h3><i class="fas fa-volume-up"></i>  Sound and DJ</h3>
                    <i id="toggle-icon-3" class="fa-solid fa-chevron-up toggle-icon" 
                    onclick="toggleSection('collaborator-content-3', 'toggle-icon-3')"></i>
                </div>
                <div id="collaborator-content-3" class="section-content">
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
                                <td>3</td>
                                <td>Jane Smith</td>
                                <td>janesmith@example.com</td>
                                <td>0760000000</td>
                                <td>
                                    <button class="action-btn view">View</button>
                                    <button class="action-btn delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
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
            <!-- Decorators -->
            <div class="collaborator-section">
                <div class="section-header">
                    <h3><i class="fas fa-paint-brush"></i>  Decorators</h3>
                    <i id="toggle-icon-4" class="fa-solid fa-chevron-up toggle-icon" 
                    onclick="toggleSection('collaborator-content-4', 'toggle-icon-4')"></i>
                </div>
                <div id="collaborator-content-4" class="section-content">
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
                                <td>3</td>
                                <td>Jane Smith</td>
                                <td>janesmith@example.com</td>
                                <td>0760000000</td>
                                <td>
                                    <button class="action-btn view">View</button>
                                    <button class="action-btn delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
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
            <!-- Stages -->
            <div class="collaborator-section">
                <div class="section-header">
                    <h3><i class="fas fa-theater-masks"></i>  Stage Supliers</h3>
                    <i id="toggle-icon-5" class="fa-solid fa-chevron-up toggle-icon" 
                    onclick="toggleSection('collaborator-content-5', 'toggle-icon-5')"></i>
                    
                </div>
                <div id="collaborator-content-5" class="section-content">
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
                                <td>3</td>
                                <td>Jane Smith</td>
                                <td>janesmith@example.com</td>
                                <td>0760000000</td>
                                <td>
                                    <button class="action-btn view">View</button>
                                    <button class="action-btn delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
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
            <!-- announcers -->
            <div class="collaborator-section">
                <div class="section-header">
                    <h3><i class="fas fa-bullhorn"></i>  Announcers</h3>
                    <i id="toggle-icon-6" class="fa-solid fa-chevron-up toggle-icon" 
                    onclick="toggleSection('collaborator-content-6', 'toggle-icon-6')"></i>
                    
                </div>
                <div id="collaborator-content-6" class="section-content">
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
                                <td>3</td>
                                <td>Jane Smith</td>
                                <td>janesmith@example.com</td>
                                <td>0760000000</td>
                                <td>
                                    <button class="action-btn view">View</button>
                                    <button class="action-btn delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
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

        </div>
    </div>
</body>
</html>