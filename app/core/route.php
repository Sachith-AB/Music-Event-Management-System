<?php

route('home','Home@index');


route('signin','Signin@index');
route('signup','Signup@index');

//route for events
route('create-event', 'event/Create@index');



//Routes for Ticket


//Route for purchaseticket
route('purchaseticket','ticket/PurchaseTicket@index');
route('successfullypaid','ticket/PurchaseTicket@index2');
route('upcommingevent','ticket/PurchaseTicket@index3');
route('ticketevent','ticket/PurchaseTicket@index4');
route('updateticket','ticket/PurchaseTicket@index5');
route('create-ticket', 'ticket/TicketController@index');

route('request','request/Request@index');

// Route for ticket holder
route('profile','ticketHolder/Profile@index');
route('update-profile','ticketHolder/UpdateProf@index');

// Route for event planners
route('event-planner-profile','eventPlanner/Profile@index');