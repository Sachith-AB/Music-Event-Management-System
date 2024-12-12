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
            
            <?php if(!empty($data['upcoming'])): ?>

                <?php foreach($data['upcoming'] as $event): ?>

                            <div class="event-card">
                                <img src="<?=ROOT?>/assets/images/events/<?php echo $event->cover_images ?>" alt="Event Image">
                                <div>
                                    <div><?php echo $event->event_name?></div>
                                    <div>
                                        <div>📅 <?php echo $event->eventDate?> | <?php echo substr($event->start_time, 11);?> </div>
                                        <div>📍 Location:  <?php echo $event->address?> </div>
                                        <div>👤 Created By: <?php echo $event->user_name ?> </div>
                                    </div>
                                </div>
                                <div class="event-card-icons">
                                    <a href="<?=ROOT?>/view-event?id=<?php echo $event->event_id ?>" ><i class="fas fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p> No upcoming events events yet </p>

            <?php endif; ?>

        </div>

        <div class="view-more">
            <a href="#" class ="view-more-events">View More Upcoming Events</a>
        </div>

        <!-- <script>
            let offset = 6;

            $(document).on('click', '.view-more-events', function(e){
                e.preventDefault();

                $.ajax ({
                    url: 'Event.php',
                    type: 'GET',
                    data: { offset: offset},
                    success: function(response) {
                        const events = JSON.parse(response);

                        if(events.length > 0) {
                            events.forEach( event => {
                                $('.event-container').append(`
                                    <div class = "event-card">
                                       <img src="<?=ROOT?>/assets/images/events/<?php echo $event->cover_images ?>" alt="Event Image">
                                            <div>
                                                <div><?php echo $event->event_name?></div>
                                                <div>
                                                    <div>📅 <?php echo $event->eventDate?> | <?php echo $event->start_time?> </div>
                                                    <div>📍 Location:  <?php echo $event->address?> </div>
                                                    <div>👤 Created By: <?php echo $event->name ?> </div>
                                                </div>
                                            </div>
                                        <div class="event-card-icons">
                                            <a href="#"><i class="fas fa-eye"></i></a>
                                            <a href="#"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                    ` );

                            });

                            offset += events.length;

                        } else {

                            $('.view-more-events').text('No more events to display').prop('disabled', true);
                        }
                    }

                });

            });

        </script> -->


        <h2 class="content-header"><br>Already Held Events</h2>
        <div class="events-container">
            <!-- Already Held Events Dummy Data -->

            <?php if(!empty($data['held'])): ?>

                <?php foreach($data['held'] as $event): ?>

                    <div class="event-card">
                        <img src="<?=ROOT?>/assets/images/events/<?php echo $event->cover_images ?>" alt="Event Image">
                        <div>
                            <div><?php echo $event->event_name ?></div>
                            <div>
                                <div>📅 <?php echo $event->eventDate ?>| <?php echo substr($event->start_time, 11) ?></div>
                                <div>📍 Location: <?php echo $event->address ?></div>
                                <div>👤 Created By: <?php echo $event->user_name ?></div>
                            </div>
                        </div>
                        <div class="event-card-icons">
                            <a href="<?=ROOT?>/view-event?id=<?php echo $event->event_id ?>" > <i class="fas fa-eye"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else : ?>
                <p> No any events are held yet </p>
            
            <?php endif; ?>

             
        </div>

        <div class="view-more">
            <a href="#">View More Already Held Events</a>
        </div>
    </div>

</div>

</body>
</html>