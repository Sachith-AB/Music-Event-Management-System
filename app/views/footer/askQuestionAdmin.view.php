<?php include('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Admin - Music Event Management System</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/questionAdmin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>

<body>
    <div class="page-container">
        <div class="container">
            <!-- Include Back Button Component -->
            <?php include('../app/views/components/backbutton.view.php'); ?>
            <h1>Ask Questions</h1>

            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Question</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data) && is_array($data)): ?>
                        <?php foreach($data as $question): ?>
                            <tr>
                                <td><?php echo isset($question->name) ? $question->name : 'Guest'; ?></td>
                                <td><?php echo $question->email; ?></td>
                                <td><?php echo $question->subject; ?></td>
                                <td><?php echo $question->question; ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="no-data">No questions found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('../app/views/components/footer.php'); ?>
</body>
</html>