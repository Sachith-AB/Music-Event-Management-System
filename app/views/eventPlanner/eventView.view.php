<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner View Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/viewEvent.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php include ('../app/views/components/loading.php');?>
    <div class="container">
        <!-- Event Details -->
        <div class="section">
        
        <?php if(!empty($data['event'])): ?>

            <div class="left-section">
                <img src="<?=ROOT?>/assets/images/events/<?php echo $data['event']->cover_images ?>" alt="Event Cover" class="cover-image">
            </div>

            <div class="right-section">
                <h1 class="event-name"><?php echo $data['event']->event_name ?> </h1>
                <p class="event-description"><?php echo $data['event']->description ?> </p>
                <div class="event-details">
                    <p><strong>Date:</strong> <?php echo $data['event']->eventDate ?> </p>
                    <p><strong>Start Time:</strong> <?php echo $data['event']->start_time ?></p>
                    <p><strong>End Time:</strong> <?php echo $data['event']->end_time ?></p>
                    <p><strong>Audience:</strong> <?php echo $data['event']->audience ?></p>
                    <p><strong>Type:</strong> <?php echo $data['event']->type ?></p>
                    <p><strong>Location:</strong> <?php echo $data['event']->address ?></p>
                </div>
                <button class="change-button" onclick = "goUpdate()">Update</button>
                <button class = "remove-button" onclick="goDelete()">Draft</button>
            </div>

        <?php endif; ?>    
        
        </div>

        <!-- Ticket Details -->
        <div class="sectionR">
            <h1 class="event-name">Tickets</h1>

            <?php if(!empty($data['tickets'])): ?>
                
                

                <div class="team-grid-scrollable">
                    <div class="team-grid">
                        <?php show($data['tickets']) ?>
                        <?php foreach ($data['tickets'] as $ticket ): ?>
                            <div class="team-member">
                                <div class="update-icon material-icons">edit</div>
                                <h2 class="ticket-name"><?php echo $ticket->ticket_type  ?></h2>
                                <div class="ticket-price">
                                    <span class="price-label">Price:</span>
                                    <span class="price-value"> <?php echo $ticket->price  ?></span>
                                </div>
                                <div class="ticket-icon">
                                    <div class="silver-card">
                                        <span class="material-icons">star</span>
                                    </div>
                                </div>
                                <div class="ticket-details">
                                    <p>
                                        <strong>Opportunities:</strong>
                                        <ul>
                                            <li>Access to VIP lounge</li>
                                            <li>Free drinks</li>
                                            <li>Priority entry</li>
                                        </ul>
                                    </p>
                                    <p>
                                        <strong>Sale Start:</strong>
                                        <span><?php echo $ticket->sale_strt_date ?></span>
                                    </p>
                                    <p>
                                        <strong>Sale End:</strong>
                                        <span><?php echo $ticket->sale_end_date ?></span>
                                    </p>
                                    <p>
                                        <strong>Quantity:</strong>
                                        <span><?php echo $ticket->quantity ?></span>
                                    </p>
                                </div>

                            </div>

                        <?php endforeach; ?>
                            
                    </div>
                </div>


            <?php endif; ?>
        </div>



        <!-- Request section -->
        <!-- Request section -->
        <div class="sectionR">
            <h1 class="event-name">Request Status</h1>
            <table class="request-table">
                <thead>
                    <tr>
                        <th>Profile Picture</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <?php if(!empty($data['requests'])): ?>

                    <?php foreach($data['requests'] as $request): ?>

                        <tbody>
                            <!-- Example row for collaborator request -->
                            <?php if($request->Status  == "pending"): ?>
                                <tr>
                                    <td><img src="<?=ROOT?>/assets/images/user/<?php echo $request->pro_pic ?>" alt="Collaborator 1" class="profile-pic"></td>
                                    <td><?php echo $request->name ?></td>
                                    <td class="status pending"><?php echo $request->Status ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if($request->Status  == "accepted"): ?>
                                <tr>
                                    <td><img src="<?=ROOT?>/assets/images/user/<?php echo $request->pro_pic ?>" alt="Collaborator 2" class="profile-pic"></td>
                                    <td><?php echo $request->name ?></td>
                                    <td class="status accepted"><?php echo $request->Status ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if($request->Status  == "rejected"): ?>
                                <tr>
                                    <td><img src="<?=ROOT?>/assets/images/user/<?php echo $request->pro_pic ?>" alt="Collaborator 3" class="profile-pic"></td>
                                    <td><?php echo $request->name ?></td>
                                    <td class="status rejected"><?php echo $request->Status ?></td>
                                </tr>
                            <?php endif; ?>

                        </tbody>

                    <?php endforeach; ?>

                <?php endif; ?>


            </table>

            <!-- button to go request pages -->
            <a href = "<?=ROOT?>/request-singers?id=<?php echo $data['event']->id?>" style="text-decoration: none;" >
                    <button class="addbutton" >Add More Requests</button>
            </a>

        </div>
        
        <form  method = "POST" >
            <input type="hidden" name = "id" value = "<?php echo $data['event']->id?>" >
            <input type="hidden" name = "status" value = "scheduled" >
            <button class="finishbutton" name ="schedule" type = "submit"  >Move to Scheduled</button>
        </form>
        
        <script>
            function goUpdate(){
                window.location.href = "<?=ROOT?>/processing-event-update?event_id=<?php echo $data['event']->id?>";
            }

            function goDelete(){
            window.location.href = "<?=ROOT?>/processing-event-delete?event_id=<?php echo $data['event']->id?>";
        }
        </script>
        
    </div>
</body>
</html>
