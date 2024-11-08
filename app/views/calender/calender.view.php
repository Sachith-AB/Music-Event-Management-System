<!DOCTYPE html>
<html lang = "en">

<head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Calender </title>
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/calender/calender.css">

</head>

<body>
    <div class="calender-container">

        <h1>Calender</h1>

        <div class="filter">
                <input type="text" placeholder="Filter Date"/>
        </div>

        <table>
                <thead>
                        <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Actions</th>
                        </tr>
                </thead>

                <tbody>
                        <tr>
                                <td>2024-08-01</td>
                                <td>Wednesday</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td><button class = "action-btn disabled">N/A</button></td>
                        </tr>

                        <tr>
                                <td>2024-08-15</td>
                                <td>Thursday</td>
                                <td>Show in NYC</td>
                                <td>Confirmed</td>
                                <td><button class = "action-btn">View</button></td>
                        </tr>

                        <tr>
                                <td>2024-08-15</td>
                                <td>Thursday</td>
                                <td>Show in NYC</td>
                                <td>Confirmed</td>
                                <td><button class = "action-btn">View</button></td>
                        </tr>

                        <tr>
                                <td>2024-08-15</td>
                                <td>Thursday</td>
                                <td>Show in NYC</td>
                                <td>Confirmed</td>
                                <td><button class = "action-btn">View</button></td>
                        </tr>

                        <tr>
                                <td>2024-08-01</td>
                                <td>Wednesday</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td><button class = "action-btn disabled">N/A</button></td>
                        </tr>

                        <tr>
                                <td>2024-08-01</td>
                                <td>Wednesday</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td><button class = "action-btn disabled">N/A</button></td>
                        </tr>



                </tbody>

        </table>

    </div>

</body>

</html>