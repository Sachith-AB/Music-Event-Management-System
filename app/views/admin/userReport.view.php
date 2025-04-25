<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Event Report</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="back-button">
        <?php include('../app/views/components/backbutton.view.php'); ?>
        <h1 class="usertext">User Report</h1>

    </div>
    
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
    
    <!-- Filter Controls -->
    <div class="filter-controls">
        <div class="filter-group">
            <label for="filterYear">Year:</label>
            <select id="filterYear" onchange="filterUsersByMonth()">
                <option value="">All Years</option>
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= $currentYear - 5; $year--) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="filter-group">
            <label for="filterMonth">Month:</label>
            <select id="filterMonth" onchange="filterUsersByMonth()">
                <option value="">All Months</option>
                <?php
                $months = [
                    '01' => 'January', '02' => 'February', '03' => 'March',
                    '04' => 'April', '05' => 'May', '06' => 'June',
                    '07' => 'July', '08' => 'August', '09' => 'September',
                    '10' => 'October', '11' => 'November', '12' => 'December'
                ];
                foreach ($months as $num => $name) {
                    echo "<option value='$num'>$name</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <?php if (!empty($data['totalUsersByMonth'])): ?>
        <table id="usersByMonthTable">
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
                    <tr class="user-month-row" 
                        data-year="<?= htmlspecialchars($user->reg_year) ?>"
                        data-month="<?= htmlspecialchars($user->reg_month) ?>">
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
        function filterUsersByMonth() {
            const year = document.getElementById('filterYear').value;
            const month = document.getElementById('filterMonth').value;
            
            const rows = document.querySelectorAll('.user-month-row');
            
            rows.forEach(row => {
                const rowYear = row.getAttribute('data-year');
                const rowMonth = row.getAttribute('data-month');
                
                // Convert month names to numbers for comparison
                const monthMap = {
                    'January': '01', 'February': '02', 'March': '03',
                    'April': '04', 'May': '05', 'June': '06',
                    'July': '07', 'August': '08', 'September': '09',
                    'October': '10', 'November': '11', 'December': '12'
                };
                
                // Convert month name to number if needed
                const normalizedRowMonth = monthMap[rowMonth] || rowMonth;
                
                const yearMatch = !year || rowYear === year;
                const monthMatch = !month || normalizedRowMonth === month;
                
                if (yearMatch && monthMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

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
</html>