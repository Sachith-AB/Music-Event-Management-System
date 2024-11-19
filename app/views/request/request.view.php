<!DOCTYPE html>
<html lang = "en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Event Requests</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/request/request.css">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



</head>


<body>

    

    <p>header in here</p>
    
    <br>

    <div class="search-container">

            <form action="/search" method = "GET" >

                <div class="search-box">

                        <span class="icon"><i class="fas fa-search"></i></span>
                        <input type="text" name = "query" placeholder = "Search....." required>

                </div>
                
            </form>

    </div>
            
    <br>

    <div class="container-table">

            <h1>Requests</h1>

            <br>

            <table>
                <tr>
                    <th>Page</th>                   
                    <th>Event name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Action</th>
                   
                </tr>

                <?php if(!empty($data['requests'])): ?>

                    <?php foreach( $data['requests'] as $request):?>
                        <tr>
                            <td><img class="cover-image" src ="<?=ROOT?>/assets/images/events/<?php echo $request->cover_images ?> " alt="cover image"/></td>
                            <td><?php echo $request->event_name?></td>
                            <td><?php echo $request->eventDate?></td>
                            <td><?php echo $request->venue_name?>,<?php echo $request->location?></td>

                            <td>

                                <form method = "POST" >
                                    <input type="hidden" name ="req_id" value = "<?php echo isset($request->request_id) ? $request->request_id : 0;?>">
                                    <input type="hidden" name ="Status" value = "accepted">
                                    <button name = "accept" type = "submit"  class = "accept">Accept</button>

                                </form>
                                

                                <form method = "POST" >
                                    <input type="hidden" name ="req_id" value = "<?php echo isset($request->request_id) ? $request->request_id : 0;?>">
                                    <input type="hidden" name ="Status" value = "rejected">
                                    <button name = "reject" type = "submit"  class = "reject">Reject</button>

                                </form>
                            </td>

                            
                           

                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>

                
            </table>


    </div>
    
    <br><br>


    <div class="container-table">

            <h1>Accepted Events</h1>
            <br>


            <table class="second" >
                <tr>
                    <th>Page</th> 
                    <th>Event name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    
                </tr>
                <?php if(!empty($data['accepted'])): ?>

                    <?php foreach($data['accepted'] as $request): ?>

                        <tr>
                            <td> <img class="cover-image"  src="<?=ROOT?>/assets/images/events/<?php echo $request->cover_images ?> " alt="cover image"></td>
                            <td><?php echo $request->event_name?></td>
                            <td><?php echo $request->eventDate?></td>
                            <td><?php echo $request->venue_name?>,<?php echo $request->location?></td>
                            
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>

            </table>
    
    </div>

    
    <br><br>

    <p>footer in here</p>


</body>