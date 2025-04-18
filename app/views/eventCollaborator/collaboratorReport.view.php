
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Collaborator Report</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventCollaborators/report.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/eventplanner/complete.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<div class="pdf-container">

    <div class="date-range">

        <form method = "POST" >
            <label for= "from" >From : </label>
            <input type="date" id = "from" name = "start-date" value = "<?php echo htmlspecialchars($_POST['start-date'] ?? '', ENT_QUOTES); ?>" required>

            <label for= "to" >   To : </label>
            <input type="date" id = "to" name = "end-date" value = "<?php echo htmlspecialchars($_POST['end-date'] ?? '', ENT_QUOTES); ?>" required> <br><br>

            <button name = "generate-report" class = "submit-btn" type="submit">Generate report</button>

        </form>
    </div>

            <h1>Event Collaborator Report</h1>

            <h2>Event Requests by Collaborator</h2>

            <!-- <div class="Table-section"> -->

                <div class="collaborator-table">
                    <h3>Singers</h3>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Requests recieved</th>
                            <th>Pending requests</th>
                            <th>Accepted requests</th>
                            <th>Rejected requests</th>
                        </tr>

                        <?php $singerExists = false; // Flag to track if any singer is found ?>

                        <?php if(!empty($data)): ?>

                                <?php foreach($data as $request):?>
                                    
                                    <?php if($request->role == "singer"):?>

                                        <?php $singerExists = true; // Set flag to true ?>

                                        <tr>
                                            <td> <?php echo($request->name); ?> </td>
                                            <td> <?php echo($request->request_count); ?> </td>
                                            <td><?php echo($request->pending_count);?></td>
                                            <td><?php echo($request->accepted_count);?></td>
                                            <td><?php echo($request->rejected_count);?></td>
                                        </tr>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                                <?php if (!$singerExists): ?>
                                    <tr>
                                        <td colspan="5">No requests yet</td>
                                    </tr>
                                <?php endif; ?>

                        <?php else: ?>

                                <tr>
                                        <td colspan="5">No requests yet</td>
                                </tr>

                        <?php endif; ?>

                    </table>
                </div>

            

                <div class="collaborator-table">
                    <h3>Bands</h3>
                    <table>

                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Requests recieved</th>
                            <th>Pending requests</th>
                            <th>Accepted requests</th>
                            <th>Rejected requests</th>
                        </tr>

                    </thead>
                        

                        <?php $bandExists = false; // Flag to track if any band is found ?>

                        <?php if(!empty($data)): ?>

                                <?php foreach($data as $request):?>
                                
                                        <?php if($request->role == "band"):?>

                                            <?php $bandExists = true; // Set flag to true ?>
                                        
                                        <tbody>

                                            <tr>
                                                <td> <?php echo($request->name); ?> </td>
                                                <td> <?php echo($request->request_count); ?> </td>
                                                <td><?php echo($request->pending_count);?></td>
                                                <td><?php echo($request->accepted_count);?></td>
                                                <td><?php echo($request->rejected_count);?></td>
                                            </tr>


                                        </tbody>
                                            
                                        <?php endif; ?>

                                <?php endforeach; ?>


                                <?php if (!$bandExists): ?>

                                    <tbody>
                                        <tr>
                                            <td colspan="5">No requests yet</td>
                                        </tr>
                                    </tbody>

                                <?php endif; ?>
                        
                        <?php else: ?>

                                <tbody>
                                    <tr>
                                        <td colspan="5">No requests yet</td>
                                    </tr>
                                </tbody>

                        <?php endif; ?>

                    </table>

                </div>

                
                <div class="collaborator-table">
                    <h3>Sounds & DJ</h3>
                    <table>

                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Requests recieved</th>
                            <th>Pending requests</th>
                            <th>Accepted requests</th>
                            <th>Rejected requests</th>
                        </tr>

                    </thead>
                    

                        <?php $soundExists = false; // Flag to track if any band is found ?>

                            <?php if(!empty($data)): ?>

                                <?php foreach($data as $request):?>
                                    
                                        <?php if($request->role == "sound"):?>

                                            <?php $soundExists = true; // Set flag to true ?>
                                        
                                            <tbody>

                                                <tr>
                                                    <td> <?php echo($request->name); ?> </td>
                                                    <td> <?php echo($request->request_count); ?> </td>
                                                    <td><?php echo($request->pending_count);?></td>
                                                    <td><?php echo($request->accepted_count);?></td>
                                                    <td><?php echo($request->rejected_count);?></td>
                                                
                                                </tr>


                                            </tbody>
                                        
                                        <?php endif; ?>

                                <?php endforeach; ?>

                                <?php if (!$soundExists): ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="5">No requests yet</td>
                                        </tr>
                                    </tbody>
                                <?php endif; ?>

                            <?php else: ?>

                                    <tbody>
                                        <tr>
                                            <td colspan="5">No requests yet</td>
                                        </tr>
                                    </tbody>

                            <?php endif; ?>
                            
                            
                    </table>

                </div>

                <div class="collaborator-table">
                    <h3>Decorators</h3>
                    <table>

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Requests recieved</th>
                                <th>Pending requests</th>
                                <th>Accepted requests</th>
                                <th>Rejected requests</th>
                            </tr>

                        </thead>
                    

                        <?php $decoratorExists = false; // Flag to track if any band is found ?>

                        <?php if(!empty($data)): ?>

                                    <?php foreach($data as $request):?>
                                        
                                        <?php if($request->role == "decorator"):?>

                                            <?php $decoratorExists = true; // Set flag to true ?>

                                            <tbody>

                                                <tr>
                                                    <td> <?php echo($request->name); ?> </td>
                                                    <td> <?php echo($request->request_count); ?> </td>
                                                    <td><?php echo($request->pending_count);?></td>
                                                    <td><?php echo($request->accepted_count);?></td>
                                                    <td><?php echo($request->rejected_count);?></td>
                                                </tr>

                                            </tbody>
                                        
                                        <?php endif; ?>

                                    <?php endforeach; ?>


                                    <?php if (!$decoratorExists): ?>

                                        <tbody>
                                            <tr>
                                                <td colspan="5">No requests yet</td>
                                            </tr>

                                        </tbody>
                                        
                                    <?php endif; ?>
                        
                        <?php else: ?>

                                <tbody>
                                    <tr>
                                        <td colspan="5">No requests yet</td>
                                    </tr>

                                </tbody>


                        <?php endif; ?>


                    </table>

                </div>

                <div class="collaborator-table">
                    <h3>Stage Suppliers</h3>
                    <table>

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Requests recieved</th>
                                <th>Pending requests</th>
                                <th>Accepted requests</th>
                                <th>Rejected requests</th>

                            </tr>


                        </thead>
                            
                        
                        <?php $stageExists = false; // Flag to track if any band is found ?>

                            <?php if(!empty($data)): ?>

                                    <?php foreach($data as $request):?>
                                        
                                        <?php if($request->role == "stage"):?>

                                            <?php $stageExists = true; // Set flag to true ?>
                                        
                                        <tbody>

                                            <tr>
                                                <td> <?php echo($request->name); ?> </td>
                                                <td> <?php echo($request->request_count); ?> </td>
                                                <td><?php echo($request->pending_count);?></td>
                                                <td><?php echo($request->accepted_count);?></td>
                                                <td><?php echo($request->rejected_count);?></td>
                                            </tr>

                                        </tbody>
                                            
                                        <?php endif; ?>

                                    <?php endforeach; ?>


                                    <?php if (!$stageExists): ?>

                                        <tbody>
                                            <tr>
                                                <td colspan="5">No requests yet</td>
                                            </tr>

                                        </tbody>
                                        
                                    <?php endif; ?>

                            <?php else: ?>
                                      
                                        <tbody>
                                            <tr>
                                                <td colspan="5">No requests yet</td>
                                            </tr>

                                        </tbody>

                            <?php endif; ?>

                    </table>
                </div>

                <div class="collaborator-table">
                    <h3>Announcers</h3>
                    <table>

                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Requests recieved</th>
                            <th>Pending requests</th>
                            <th>Accepted requests</th>
                            <th>Rejected requests</th>
                        </tr>

                    </thead>
                        

                        <?php $announcerExists = false; // Flag to track if any band is found ?>

                        <?php if(!empty($data)): ?>

                            <?php foreach($data as $request):?>
                                
                                    <?php if($request->role == "announcer"):?>

                                        <?php $announcerExists = true; // Set flag to true ?>
                                    
                                        <tbody>

                                            <tr>
                                                <td> <?php echo($request->name); ?> </td>
                                                <td> <?php echo($request->request_count); ?> </td>
                                                <td><?php echo($request->pending_count);?></td>
                                                <td><?php echo($request->accepted_count);?></td>
                                                <td><?php echo($request->rejected_count);?></td>
                                            </tr>
                                        
                                        </tbody>

                                    <?php endif; ?>

                            <?php endforeach; ?>

                                <?php if (!$announcerExists): ?>

                                        <tbody>
                                            <tr>
                                                <td colspan="5">No requests yet</td>
                                            </tr>

                                        </tbody>

                                <?php endif; ?>


                        <?php else : ?>

                            <tbody>
                                <tr>
                                    <td colspan="5">No requests yet</td>
                                </tr>

                            </tbody>

                        <?php endif; ?>

                                
                    </table>
                </div>

            <!-- </div> -->

            <h1>Top Requested Collaborators</h1>

                <!-- <div class="Table-section"> -->

                    <div class="all-table">
                        <table>

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Requests recieved</th>
                                <th>Pending requests</th>
                                <th>Accepted requests</th>
                                <th>Rejected requests</th>
                            </tr>

                        </thead>
                            

                            <?php if(!empty($data)):?>

                                <?php foreach($data as $request):?>

                                    <tbody>

                                        <tr>
                                            <td><?php echo($request->name);?></td>
                                            <td><?php echo($request->role);?></td>
                                            <td><?php echo($request->request_count);?></td>
                                            <td><?php echo($request->pending_count);?></td>
                                            <td><?php echo($request->accepted_count);?></td>
                                            <td><?php echo($request->rejected_count);?></td>

                                        </tr>

                                    </tbody>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tbody>
                                    <tr>
                                        <td colspan=6>No requests yet</td>
                                    </tr>
                                    
                                </tbody>

                            <?php endif; ?>


                        </table>

                    </div>
                <!-- </div> -->

</div>

    <button class = "print-button" onclick="print()"><i class="fa-solid fa-download"></i></button>


        <script>
            function print() {
                const pdfContainer = document.querySelector('.pdf-container'); 
                const newWindow = window.open('', '_blank'); 
                newWindow.document.write('<html><head><title> Event Collaborator Report</title>');
                newWindow.document.write('<link rel="stylesheet" href="http://localhost/Music-Event-Management-System/public/assets/css/eventCollaborators/report.css">'); 
                newWindow.document.write('</head><body>');
                newWindow.document.write(pdfContainer.innerHTML);
                newWindow.document.write('</body></html>');
                newWindow.document.close(); 
                
                
                newWindow.onload = function() {
                    newWindow.print(); 
                    newWindow.close(); 
                };
            }
        </script>
    
</body>