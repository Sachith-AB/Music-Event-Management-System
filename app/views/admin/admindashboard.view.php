<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/admindashboard.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
    <!-- Sidebar -->
    <?php include('../app/views/components/admin/dashsidebar.php'); ?>
    <div class="dashboard">
        <h2 class="content-header">Upcoming Events</h2>
        <div class="events-container">
            <!-- Upcoming Events Dummy Data -->
            
            <div class="event-card">
                <img src="https://image.jimcdn.com/app/cms/image/transf/dimension=1190x10000:format=jpg/path/sa6549607c78f5c11/image/i82f8384a1348ab84/version/1554202007/tomorrowland-best-summer-music-festivals-europe.jpg" alt="Event Image">
                <div>
                    <div>Global Beats Festival</div>
                    <div>
                        <div>📅 2024.12.13 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <div class="event-card">
                <img src="https://townsquare.media/site/15/files/2021/07/attachment-Brothers-Osborne-11.jpg?w=1200&h=0&zc=1&s=0&a=t&q=89&format=natural" alt="Event Image">
                <div>
                    <div>Rock Legends Live</div>
                    <div>
                        <div>📅 2024.12.1 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <div class="event-card">
                <img src="https://cdn.pixabay.com/photo/2016/11/23/15/48/audience-1853662_1280.jpg" alt="Event Image">
                <div>
                    <div>Jazz Under the Stars</div>
                    <div>
                        <div>📅 2024.12.21 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <div class="event-card">
                <img src="https://images.squarespace-cdn.com/content/v1/5f724c2854366f48cbcfa30c/5ae42751-7614-4d4b-8e00-f4fcd7d2da52/Streaming+%26+Virtual+Concerts+%7C+Music+Event+Production+%7C+Live+Music+Events" alt="Event Image">
                <div>
                    <div>EDM Night Bash</div>
                    <div>
                        <div>📅 2024.12.10 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <div class="event-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Weezer_Bethlehem_2019_5.jpg/1200px-Weezer_Bethlehem_2019_5.jpg" alt="Event Image">
                <div>
                    <div>Acoustic Vibes Evening</div>
                    <div>
                        <div>📅 2024.12.14 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <div class="event-card">
                <img src="https://tseentertainment.com/wp-content/uploads/elementor/thumbs/pexels-teddy-yang-2167382-scaled-pz2c4713hbwqqq3ebboldi94ueq4ot52secpafecug.jpg" alt="Event Image">
                <div>
                    <div>Hip-Hop Fest 2024</div>
                    <div>
                        <div>📅 2024.12.15 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: John Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            
        </div>
        <div class="view-more">
            <a href="#">View More Upcoming Events</a>
        </div>

        <h2 class="content-header">Already Held Events</h2>
        <div class="events-container">
            <!-- Already Held Events Dummy Data -->
            
            <div class="event-card">
                <img src="https://149347190.v2.pressablecdn.com/wp-content/uploads/2019/08/summer-festivals-thumbnail-846x564.jpg" alt="Event Image">
                <div>
                    <div>Summer Fest</div>
                    <div>
                        <div>📅 2024.11.22 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            <div class="event-card">
                <img src="https://i.ytimg.com/vi/7prcsluUGsY/sddefault.jpg" alt="Event Image">
                <div>
                    <div>Summer Fest</div>
                    <div>
                        <div>📅 2024.11.22 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            <div class="event-card">
                <img src="https://images.squarespace-cdn.com/content/v1/5a68f2eed0e6285be82a9fcc/1526807384376-0I1ETBFAM8MZHKOEPG8S/image2.jpeg" alt="Event Image">
                <div>
                    <div>Summer Fest</div>
                    <div>
                        <div>📅 2024.11.22 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            <div class="event-card">
                <img src="https://www.torrens.edu.au/-/media/project/laureate/apac/torrens/stories/business/how-the-worlds-biggest-music-events-are-managing-covid/how-the-worlds-biggest-music-events-are-managing-covid-lg.jpg?rev=3a7082f452be4b9fbfea019949782030" alt="Event Image">
                <div>
                    <div>Summer Fest</div>
                    <div>
                        <div>📅 2024.11.22 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            <div class="event-card">
                <img src="https://media.licdn.com/dms/image/D5612AQG50IKBQL7rNw/article-cover_image-shrink_720_1280/0/1722777660495?e=2147483647&v=beta&t=zwOYbsPOZ4XocTVJddf5yfaAEIu5Il0IAHZZOvVWhVw" alt="Event Image">
                <div>
                    <div>Summer Fest</div>
                    <div>
                        <div>📅 2024.11.22 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            <div class="event-card">
                <img src="https://www.oneplan.io/wp-content/uploads/2022/02/Real-event-image-1-scaled.jpg" alt="Event Image">
                <div>
                    <div>Summer Fest</div>
                    <div>
                        <div>📅 2024.11.22 | 10.00AM</div>
                        <div>📍 Location </div>
                        <div>👤 Created By: Jane Doe</div>
                    </div>
                </div>
                <div class="event-card-icons">
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            
            
        </div>
        <div class="view-more">
            <a href="#">View More Already Held Events</a>
        </div>
    </div>
</div>

</body>
</html>