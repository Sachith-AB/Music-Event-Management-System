<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner View Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/viewEvent.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php include ('../app/views/components/loading.php');?>
    <div class="container">
        <!-- Event Details -->
        <div class="section">
        <?php if(!empty($data['event'])): ?>
            <div class="details-section">
                <div >
                    <div class="back-button">
                        <?php include('../app/views/components/backbutton.view.php'); ?>
                        <h1 class="event-name"><?php echo $data['event']->event_name ?></h1>
                    </div>
                    
                    <p class="event-description"><?php echo $data['event']->description ?></p>
                    <div class="event-details">
                        <p><strong>Date:</strong> <?php echo $data['event']->eventDate ?></p>
                        <p><strong>Start Time:</strong> <?php echo $data['event']->start_time ?></p>
                        <p><strong>End Time:</strong> <?php echo $data['event']->end_time ?></p>
                        <p><strong>Audience:</strong> <?php echo $data['event']->audience ?></p>
                        <p><strong>Type:</strong> <?php echo $data['event']->type ?></p>
                        <p><strong>Location:</strong> <?php echo $data['event']->address ?></p>
                    </div>
                    <div class="button-group">
                        <button class="change-button" onclick="goUpdate()">Update</button>
                        <button class="remove-button" onclick="goDelete()">Draft</button>
                    </div>
                </div>

                <div class="right-section">
                <?php
                    $coverImages = json_decode($data['event']->cover_images, true);
                    $firstImage = $coverImages[0] ?? ''; // fallback if empty
                    ?>
                    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Cover" class="cover-image">
                </div>
            </div>
        <?php endif; ?>
        </div>

        <!-- Ticket Details -->
        <div class="sectionR">
            <h1 class="event-name">Tickets</h1>

            <?php if(!empty($data['tickets'])): ?>
                
                

                <div class="team-grid-scrollable">
                    <div class="team-grid">
                        
                        <?php foreach ($data['tickets'] as $ticket ): ?>
                            <div class="team-member">
                                <div class="update-icon material-icons" onclick="goUpdateTicket(<?php echo $ticket->id  ?>)">edit</div>
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
                                <?php $restrictions = json_decode($ticket->restrictions); ?>
                                    <p>
                                        <strong>Opportunities:</strong>
                                        <?php if (!empty($restrictions)): ?>
                                            <ul>
                                                <?php foreach ($restrictions as $opo): ?>
                                                    <li><?= htmlspecialchars($opo) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <p>No opportunities</p>
                                        <?php endif; ?>

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
            <!-- button to go ticket pages -->
            <div style="display: flex; justify-content: center; width: 100%;">
                <a href = "<?=ROOT?>/create-ticket?event_id=<?php echo $data['event']->id?>" style="text-decoration: none;" >
                    <button class="addbutton">Add Another Ticket</button>
                </a>
            </div>
        </div>

        <!-- Request section -->
        <div class="sectionR">
            <h1 class="event-name">Request Status</h1>
            <table class="request-table">
                <thead>
                    <tr>
                        <th>Event collaborator</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <?php if(!empty($data['requests'])): ?>

                    <?php foreach($data['requests'] as $request): ?>

                        <tbody>
                            <!-- Example row for collaborator request -->
                            <?php if($request->Status  == "pending"): ?>
                                <tr>
                                    <td class="collaborator-de"><img src="<?=ROOT?>/assets/images/user/<?php echo $request->pro_pic ?>" alt="Collaborator 1" class="profile-pic"><?php echo $request->name ?></td>
                                    <td class="status pending"><?php echo $request->Status ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if($request->Status  == "accepted"): ?>
                                <tr>
                                    <td class="collaborator-de"><img src="<?=ROOT?>/assets/images/user/<?php echo $request->pro_pic ?>" alt="Collaborator 2" class="profile-pic"><?php echo $request->name ?></td>
                                    <td class="status accepted"><?php echo $request->Status ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if($request->Status  == "rejected"): ?>
                                <tr>
                                    <td class="collaborator-de"><img src="<?=ROOT?>/assets/images/user/<?php echo $request->pro_pic ?>" alt="Collaborator 3" class="profile-pic"><?php echo $request->name ?></td>
                                    <td class="status rejected"><?php echo $request->Status ?></td>
                                </tr>
                            <?php endif; ?>

                        </tbody>

                    <?php endforeach; ?>

                <?php endif; ?>


            </table>

            <!-- button to go request pages -->
            <div style="display: flex; justify-content: center; width: 100%;">
                <a href = "<?=ROOT?>/request-singers?id=<?php echo $data['event']->id?>" style="text-decoration: none;" >
                    <button class="addbutton">Add More Requests</button>
                </a>
            </div>

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

            function goUpdateTicket(id){
                window.location.href = "<?=ROOT?>/update-ticket?ticket_id="+id;
            }
        </script>
        
    </div>
</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>