<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner Scheduled Event</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/profit.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include('../app/views/components/admin/dashsidebar.php'); ?>
        <div class="container">
            <h1>Financial Summary</h1>
            
            <div class="search-container">
                <input type="text" id="eventSearch" placeholder="Search by event name..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Administrative Fee (LKR)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="profitTableBody">
                    <?php foreach($data['administrative_fee'] as $fee): ?>
                        <?php $fees =  htmlspecialchars(number_format($fee->administrative_fee, 2, '.', ',')); 
                            $fees < 0 ? $fees = $fees * -1 : $fees = $fees * 1;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($fee->event_name); ?></td>
                            <td>LKR <?= $fees; ?></td>
                            <td><?= htmlspecialchars((new DateTime($fee->updated_at))->format('Y-m-d')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('eventSearch');
                const tableBody = document.getElementById('profitTableBody');
                const rows = tableBody.getElementsByTagName('tr');

                searchInput.addEventListener('keyup', function() {
                    const searchText = this.value.toLowerCase();

                    for (let row of rows) {
                        const eventName = row.getElementsByTagName('td')[0].textContent.toLowerCase();
                        if (eventName.includes(searchText)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        </script>
    </div>
</body>
<?php include ('../app/views/components/footer.php'); ?>
</html>