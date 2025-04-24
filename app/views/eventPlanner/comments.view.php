<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner comments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/comments.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>

<body>
        <?php include ('../app/views/components/loading.php');  ?>

           
                <div class="dash-container">
                    <!-- Sidebar -->
                    <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>

                        <div class="dashboard">
                                <!-- Comments Section -->
                                <?php if (!empty($plannerComments)): ?>
                                    
                                    <div class="back-button">
                                        <!-- Include Back Button Component -->
                                        <?php include('../app/views/components/backbutton.view.php'); ?>
                                        <div class="header">
                                            <h1>Comments</h1>
                                        </div>

                                    </div>

                                    <div class="comments-container">
                                        

                                        <!-- Comments -->
                                        <?php foreach ($plannerComments as $comment): ?>
                                            <div class="comment">
                                                <img src="<?=ROOT?>/assets/images/user/<?php echo $comment->sender_pro_pic ?>" alt="User Avatar" class="comment-avatar">
                                                <div class="comment-content">
                                                    <div class="comment-header">
                                                        <span class="comment-author"><?php echo $comment->sender_name ?></span>
                                                        <span class="comment-date"><?= date('jS F Y, H:i A', strtotime($comment->created_at)) ?></span>
                                                    </div>
                                                    <p class="comment-text"><?php echo htmlspecialchars($comment->content) ?></p>
                                                    <!-- <div class="comment-actions">
                                                        <button class="like-btn">👍 <?php echo $comment->num_likes ?></button> -->
                                                        <!-- <button class="reply-btn">Reply</button> -->
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        
                                    </div>

                                <?php else: ?>

                                    <div>
                                        <p>No any comments yet</p>
                                    </div>
                                
                                <?php endif; ?>
                        

                        </div>

                    </div>

        <?php include ('../app/views/components/footer.php'); ?>

        <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>

