<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/myevents.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>
        
        <div class="content">
            <h2 class="content-hearder">Newly Created Events</h2>
            <div class="events-container">
                <div class="event-card">
                    <div class="event-status-process">processing</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div>From LKR80</div>
                    </div>
                </div>

                <div class="event-card">
                    <div class="event-status-process">processing</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div>From LKR80</div>
                    </div>
                </div>

                <div class="event-card">
                    <div class="event-status-process">processing</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div >From LKR80</div>
                    </div>
                </div>
            
            </div>
            <a href="#" class="view-more">View more</a>
            <br/>
            <h2 class="content-hearder">Upcoming Events</h2>
            <div class="events-container">
                <div class="event-card">
                    <div class="event-status-scheduled">scheduled</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div>From LKR80</div>
                    </div>
                </div>

                <div class="event-card">
                    <div class="event-status-scheduled">scheduled</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div>From LKR80</div>
                    </div>
                </div>

                <div class="event-card">
                    <div class="event-status-scheduled">scheduled</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div >From LKR80</div>
                    </div>
                </div>
            
            </div>
            <a href="#" class="view-more">View more</a>
            <br/>

            <h2 class="content-hearder">Already hold Events</h2>
            <div class="events-container">
                <div class="event-card">
                    <div class="event-status-completed">completed</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div>From LKR80</div>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-status-completed">completed</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div>From LKR80</div>
                    </div>
                </div>

                <div class="event-card">
                    <div class="event-status-completed">completed</div>
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Musical Fusion Festival">
                    <div>
                        <div>Musical Fusion Festival</div>
                        <div>
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div >From LKR80</div>
                    </div>
                </div>
            
            </div>
        </div>
        
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
