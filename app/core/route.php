<?php

function getUserRole() {
    return isset($_SESSION['USER']) && isset($_SESSION['USER']->role) ? $_SESSION['USER']->role : null;
}

function isAdmin() {
    return isset($_SESSION['USER']) 
        && is_object($_SESSION['USER']) 
        && property_exists($_SESSION['USER'], 'is_admin') 
        && $_SESSION['USER']->is_admin == 1;
}

route('home','Home@index');
route('search','Search@index');


route('signin','Signin@index');
route('signup','Signup@index');

//route for forgot password
route('forgot-password','forgotPassword/ForgotPassword@index');
route('pin-input','forgotPassword/PinInput@index');
route('reset-password','forgotPassword/ResetPassword@index');


route('create-event', 'event/Create@index');  
route('event-review', 'event/Review@index'); 
route('event-update', 'event/Update@index');  
route('event-delete', 'event/Delete@index');  
route('view-event','event/ViewEvent@index');

route('processing-event-update','event/ProcessingEventUpdate@index');
route('processing-event-delete','event/ProcessingEventDelete@index');

route('event-report','event/Report@index');

route('event-payment','event/EventPayment@index');
route('event-view-payment','event/ViewEventPayment@index');

if(getUserRole() == 'collaborator' || isAdmin()){
    //route for event collaborators
    route('colloborator-profile','eventCollaborator/singerProfile@index');
    route('colloborator-dashboard','eventCollaborator/SingerDashboard@index');
    route('colloborator-request','eventCollaborator/SingerRequest@index');
    route('colloborator-updateprofile','eventCollaborator/SingerUpdateProf@index');
    route('colloborator-calendar','eventCollaborator/Calender@index');
    route('colloborator-events','eventCollaborator/SingerEvents@index');
    route('colloborator-pastevents','eventCollaborator/SingerPastEvents@index');
    route('colloborator-payments','eventCollaborator/SingerPayments@index');
    route('collaborator-viewprofile','eventCollaborator/ViewProfile@index');
    route('collaborator-eventdetails','eventCollaborator/EventDetails@index');
    route('collaborator-report','eventCollaborator/collaboratorReport@index');
    route('send-message','eventCollaborator/Chat@sendMessage');
    route('get-messages','eventCollaborator/Chat@getMessages');
}


//all routes for event planner
if (getUserRole() == 'planner' || isAdmin()){
    route('request','request/Requestview@index');
    route('profile','ticketHolder/Profile@index');
    //route for request
    route('request-singers','request/SingerRequest@index');
    route('request-bands','request/BandRequest@index');
    route('request-sounds','request/SoundRequest@index');
    route('request-decorators','request/DecoratorsRequest@index');
    route('request-stages','request/StageRequest@index');
    route('request-announcers','request/AnnouncerRequest@index');
    route('request-venues','request/VenueRequest@index');

    
    //Routes for Ticket
    route('create-ticket', 'ticket/TicketController@index');
    route('view-tickets', 'ticket/TicketController@viewTickets');
    route('update-ticket', 'ticket/TicketController@updateticket');
    route('delete-ticket', 'ticket/TicketController@deleteTicket');

    // Route for event planners
    route('event-planner-profile','eventPlanner/Profile@index');
    route('event-planner-dashboard','eventPlanner/EventPlannerDashboard@index');
    route('event-planner-calendar','eventPlanner/EventPlannerCalendar@index');
    route('event-planner-myevents','eventPlanner/EventPlannerMyEvents@index');
    route('event-planner-payment','eventPlanner/EventPlannerPayment@index');
    route('event-planner-messages','eventPlanner/EventPlannerMessage@index');
    route('event-planner-viewEvent','eventPlanner/EventPlannerViewEvent@index');
    route('event-planner-scheduledEvent','eventPlanner/EventPlannerScheduledEvent@index');
    route('edit-scheduled-event-ticket','eventPlanner/EditScheduledEventTicket@index');
    route('get-event-messages','eventPlanner/EventPlannerMessage@index');
    route('collaborator-payment','eventPlanner/CollaboratorPayment@index');
    route('event-planner-completedEvent','eventPlanner/EventPlannerCompletedEvent@index');
    route('event-planner-completedEventInfo','eventPlanner/EventPlannerCompletedEventInfo@index');
    route('calender','calender/Calender@index');

    route('collaborator-eventdetails','eventCollaborator/EventDetails@index');
}

//Route for purchaseticket
route('purchaseticket','ticket/PurchaseTicket@index');
route('payment-failure','ticket/PaymentFailure@index');
route('successfullypaid','ticket/Successfullypaid@index');
route('upcommingevent','ticket/UpcomingEvents@index');
route('ticketevent','ticket/PurchaseTicket@index4');

if(getUserRole() == 'holder' ||isAdmin()){
    // Route for ticket holder
    route('profile','ticketHolder/Profile@index');
    route('update-profile','ticketHolder/UpdateProf@index');
    route('ticket-holder-home','ticketHolder/TicketHolderHome@index');
    route('view-pastevent','ticketHolder/ViewPastevent@index');
    route('notification-event','ticketHolder/NotificationEvent@index');
    route('delete-buyticket','ticketHolder/Deletebuyticket@index');
    route('profile/markread','ticketHolder/ViewPastevent@markNotificationsRead');
}

if(isAdmin()){
    //Route for Admin
    route('admin-dashboard','admin/AdminDashboard@index');
    route('admin-eventplanners','admin/EventPlanners@index');
    route('admin-eventcollaborators','admin/EventCollaborators@index');
    route('admin-ticketholders','admin/TicketHolders@index');
    route('admin-vieweventplanner','admin/ViewEventPlanner@index');
    route('admin-event-report','admin/AdminEventReport@index');
    route('admin-ticket-report','admin/AdminTicketReport@index');
    route('admin-user-report','admin/AdminUserReport@index');
}
