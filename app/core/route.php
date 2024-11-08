<?php



route('home','Home@index');


route('signin','Signin@index');
route('signup','Signup@index');

//route for events
route('create-event', 'event/Create@index');
route('event-review', 'event/Review@index');

//route for event collaborators
route('singer-profile','eventCollaborator/singerProfile@index');




//route for request
route('request','request/Request@index');

//route for singerdropdown
route('singerdropdown','request/Requestdropdown@index');


route('calender','calender/Calender@index');

//Routes for Ticket
route('create-ticket', 'ticket/TicketController@index');
route('view-tickets', 'ticket/TicketController@viewTickets');


//Route for purchaseticket
route('purchaseticket','ticket/PurchaseTicket@index');
route('successfullypaid','ticket/PurchaseTicket@index2');
route('upcommingevent','ticket/PurchaseTicket@index3');
route('ticketevent','ticket/PurchaseTicket@index4');
route('updateticket','ticket/PurchaseTicket@index5');


// Route for ticket holder
route('profile','ticketHolder/Profile@index');
route('update-profile','ticketHolder/UpdateProf@index');

// Route for event planners
route('event-planner-profile','eventPlanner/Profile@index');

