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
                    <th>Event name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Action</th>
                    <th>Info</th>
                </tr>

                <?php if(!empty($data)): ?>

                    <?php foreach( $data as $request):?>
                        <tr>
                            <td><?php echo $request->event_name?></td>
                            <td><?php echo $request->eventDate?></td>
                            <td><?php echo $request->name?>,<?php echo $request->location?></td>
                            <td><button class = "accept">Accept</button> <button class = "reject" >Reject</button></td>
                            <td><button>Event Page</button></td>

                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>

                
            </table>


    </div>
    
    <br><br>


    <div class="container-table">

            <h1>Accepted Events</h1>
            <br>


            <table>
                <tr>
                    <th>Event name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Info</th>
                </tr>
                <tr>
                    <td>JAZZ Night</td>
                    <td>25th October 2023</td>
                    <td>Blue Note Jazz Club, NY</td>
                    
                    <td><button>Event Page</button></td>

                </tr>

                <tr>
                    <td>JAZZ Night</td>
                    <td>25th October 2023</td>
                    <td>Blue Note Jazz Club, NY</td>
                    
                    <td><button>Event Page</button></td>

                </tr>

                <tr>
                    <td>JAZZ Night</td>
                    <td>25th October 2023</td>
                    <td>Blue Note Jazz Club, NY</td>
                    
                    <td><button>Event Page</button></td>

                </tr>


                <tr>
                    <td>JAZZ Night</td>
                    <td>25th October 2023</td>
                    <td>Blue Note Jazz Club, NY</td>
                    
                    <td><button>Event Page</button></td>

                </tr>

                <tr>
                    <td>JAZZ Night</td>
                    <td>25th October 2023</td>
                    <td>Blue Note Jazz Club, NY</td>
                    
                    <td><button>Event Page</button></td>
                    

                </tr>
            </table>
    
    </div>

    
    <br><br>

    <p>footer in here</p>


</body>