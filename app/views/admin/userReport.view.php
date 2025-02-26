<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Event Report</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>User Report</h1>

    <div class = "pdf-container">

    <!-- Total Users Table -->
    <h2>Total Users</h2>
    <?php if (!empty($data['totalUsers'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>User Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['totalUsers'] as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->role); ?></td>
                        <td><?php echo htmlspecialchars($user->user_count); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Total Users by Month Table -->
    <h2>Total Users by Month</h2>
    <?php if (!empty($data['totalUsersByMonth'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Registration Year</th>
                    <th>Registration Month</th>
                    <th>Registration Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['totalUsersByMonth'] as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->role); ?></td>
                        <td><?php echo htmlspecialchars($user->reg_year); ?></td>
                        <td><?php echo htmlspecialchars($user->reg_month); ?></td>
                        <td><?php echo htmlspecialchars($user->registration_count); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>

    <button class = "print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>

    <script>
        function print() {
            const pdfContainer = document.querySelector('.pdf-container'); 
            const newWindow = window.open('', '_blank'); 
            newWindow.document.write('<html><head><title>Musicial - User Report</title>');
            newWindow.document.write('<link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">'); 
            newWindow.document.write('</head><body>');
            newWindow.document.write(pdfContainer.innerHTML);
            newWindow.document.write('</body></html>');
            newWindow.document.close(); 
            
            
            newWindow.onload = function() {
                newWindow.print(); 
                newWindow.close(); 
            };
        }
    </script>

    

    
    
        
</body>