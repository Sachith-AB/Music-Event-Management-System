<?php

route('home','Home@index');


route('signin','Signin@index');
route('signup','Signup@index');

//route for events
route('create-event', 'event/Create@index');

//Route for tickets
route('purchaseticket','ticket/Ticket@index');
route('successfullypaid','ticket/Ticket@index2');
route('upcommingevent','ticket/Ticket@index3');
route('ticketevent','ticket/Ticket@index4');

route('request','request/Request@index');

// Route for ticket holder
route('profile','ticketHolder/Profile@index');
route('update-profile','ticketHolder/UpdateProf@index');

// Route for event planners
route('event-planner-profile','eventPlanner/Profile@index');