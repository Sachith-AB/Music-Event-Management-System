<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/dashboard.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>
        
        <div class="dashboard">
            <div class="header">
                <h1>Dashboard</h1>
            </div>

            <div class="stats">
                <div class="stat-item">
                    <div class="dolar-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h2 class="dolar-h2">LKR 5,000</h2>
                    <p>Revenue</p>
                </div>
                <div class="stat-item">
                    <div class="ticket-icon">
                        <i class="fas fa-ticket"></i>
                    </div>
                    <h2 class="ticket-h2">420/900</h2>
                    <p>Tickets Sold</p>
                </div>
                <div class="stat-item">
                    <div class="viewer-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h2 class="viewer-h2">1,000</h2>
                    <p>Event Views</p>
                </div>
                <div class="stat-item">
                    <div class="share-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h2 class="share-h2">200</h2>
                    <p>Event Shares</p>
                </div>
            </div>

            <div class="section sales">
                <h3>Sales by event</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date of the Event</th>
                            <th>Ticket Sold</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="event-info">
                                    <img class="eventimage" src="<?=ROOT?>/assets/images/eventplanner/event1.png" alt="Event Image">
                                    Event: A Fusion of Power and Passion
                                </div>
                            </td>
                            <td>Monday, June 10</td>
                            <td>320/500</td>
                            <td>LKR 2,500</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="event-info">
                                    <img class="eventimage" src="<?=ROOT?>/assets/images/eventplanner/event1.png" alt="Event Image">
                                    Rock Beat Extravaganza
                                </div>
                            </td>
                            <td>Tuesday, June 21 <span class="tag">In 2 weeks</span></td>
                            <td>100/300</td>
                            <td>LKR 1,250</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="event-info">
                                    <img class="eventimage" src="<?=ROOT?>/assets/images/eventplanner/event1.png" alt="Event Image">
                                    A Legendary Gathering of Rock Icons
                                </div>

                            </td>
                            <td>Friday, July 15 <span class="tag">In 5 weeks</span></td>
                            <td>0/100</td>
                            <td>LKR 0</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="section purchases">
                <h3>Recent purchases</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Buyer</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Ticket Sold</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#R39823894</td>
                            <td>Ashley Wilson</td>
                            <td>10/10/2023</td>
                            <td>11:25 PM</td>
                            <td>1</td>
                            <td>LKR25</td>
                        </tr>
                        <tr>
                            <td>#R30983203</td>
                            <td>Anna Hernandez</td>
                            <td>10/10/2023</td>
                            <td>11:20 PM</td>
                            <td>2</td>
                            <td>LKR50</td>
                        </tr>
                        <tr>
                            <td>#R30823412</td>
                            <td>Elizabeth Bailey</td>
                            <td>10/10/2023</td>
                            <td>10:55 PM</td>
                            <td>1</td>
                            <td>LKR25</td>
                        </tr>
                        <tr>
                            <td>#R30792341</td>
                            <td>John Edwards</td>
                            <td>10/10/2023</td>
                            <td>07:25 AM</td>
                            <td>2</td>
                            <td>LKR50</td>
                        </tr>
                        <tr>
                            <td>#R30580414</td>
                            <td>Jacob Jackson</td>
                            <td>10/09/2023</td>
                            <td>02:45 PM</td>
                            <td>1</td>
                            <td>LKR25</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
