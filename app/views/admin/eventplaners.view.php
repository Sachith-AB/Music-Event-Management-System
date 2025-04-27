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
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php if(!empty($data)): ?>
                    <!--  -->

                    <?php foreach($data as $planner): ?>

                        <?php if($planner->role == 'planner'): ?>

                                <tr>
                                    
                                    <td><?php echo $planner->name ?></td>
                                    <td><?php echo $planner->email ?></td>
                                    <td><?php echo $planner->contact ?></td>
                                    <td>
                                        <div class = "button-section">
                                            
                                                
                                            <button class="action-btn view" type = "submit" onclick="gotoplannerprofile(<?php echo $planner->id ?>)">View</button>
                                            
                                             
                                            <form method = "POST">
                                                <input type = "hidden" name = "user_id" value = "<?php echo $planner->id ?>">
                                                <input type = "hidden" name = "is_delete" value = '1' >
                                                <button type="button" name = "delete" class="action-btn delete" onclick="showConfirmation(this.form)">Delete</button>

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
    <script>
        function gotoplannerprofile(userid){
            window.location.href = "<?=ROOT?>/admin-vieweventplanner?id="+userid;
        }
    </script>

            <!-- Confirmation Modal -->
        <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; 
            width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); 
            justify-content: center; align-items: center; z-index: 1000;">
            <div style="background: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <p class="confirm-message">Are you sure you want to delete this event planner?</p>
                    <button class="confirm-btn submit-btn" onclick="submitConfirmedForm()">Yes</button>
                    <button class="confirm-btn cancel-btn" onclick="closeModal()">No</button>
            </div>
        </div>

        <script>
                                            let currentForm = null;

                                            function showConfirmation(form) {
                                                currentForm = form;
                                                document.getElementById('confirmModal').style.display = 'flex';
                                            }

                                            function closeModal() {
                                                document.getElementById('confirmModal').style.display = 'none';
                                                currentForm = null;
                                            }

                                            function submitConfirmedForm() {
                                                if (currentForm) {
                                                    currentForm.submit();
                                                }
                                                closeModal();
                                            }

                                            function confirmDelete(form) {
                                                // Prevent default submit and show confirmation modal instead
                                                return false;
                                            }
        </script>

</body>
<?php include ('../app/views/components/footer.php'); ?>
</html>

<!-- <script>
    document.querySelector('.action-btn view').addEventListener('click', () => {
        windows.location.href = "<?=ROOT?>/event-planner-profile?id=<?php echo $planner->id ?>";
    });
</script> -->