<?php


route('home','Home@index');
route('search','Search@index');


route('signin','Signin@index');
route('signup','Signup@index');


route('create-event', 'event/Create@index');  // Route to handle event creation
route('event-review', 'event/Review@index');  // Route to view event details
route('event-update', 'event/Update@index');  // Route to update event details

//route for events
route('create-event', 'event/Create@index');
route('event-review', 'event/Review@index');
route('view-event','event/ViewEvent@index');

//route for event collaborators
route('singer-profile','eventCollaborator/singerProfile@index');
route('singer-dashboard','eventCollaborator/SingerDashboard@index');





//route for requestlist
route('request','request/Requestview@index');

//route for request
route('request-singers','request/SingerRequest@index');
route('request-bands','request/BandRequest@index');
route('request-sounds','request/SoundRequest@index');
route('request-decorators','request/DecoratorsRequest@index');
route('request-stages','request/StageRequest@index');
route('request-announcers','request/AnnouncerRequest@index');
route('request-venues','request/VenueRequest@index');


route('calender','calender/Calender@index');

//Routes for Ticket
route('create-ticket', 'ticket/TicketController@index');
route('view-tickets', 'ticket/TicketController@viewTickets');
route('update-ticket', 'ticket/TicketController@updateticket');
route('delete-ticket', 'ticket/TicketController@deleteTicket');


//Route for purchaseticket
route('purchaseticket','ticket/PurchaseTicket@index');
route('successfullypaid','ticket/Successfullypaid@index');
route('upcommingevent','ticket/UpcomingEvents@index');
route('ticketevent','ticket/PurchaseTicket@index4');



// Route for ticket holder
route('profile','ticketHolder/Profile@index');
route('update-profile','ticketHolder/UpdateProf@index');

// Route for event planners
route('event-planner-profile','eventPlanner/Profile@index');
route('event-planner-dashboard','eventPlanner/EventPlannerDashboard@index');
route('event-planner-calendar','eventPlanner/EventPlannerCalendar@index');
route('event-planner-myevents','eventPlanner/EventPlannerMyEvents@index');
route('event-planner-payment','eventPlanner/EventPlannerPayment@index');
route('event-planner-messages','eventPlanner/EventPlannerMessage@index');

