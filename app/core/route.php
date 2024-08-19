<?php

route('home','Home@index');


route('signin','Signin@index');
route('signup','Signup@index');





route('create-event', 'event/Create@index');

route('purchaseticket','ticket/Ticket@index');
route('successfullypaid','ticket/Ticket@index2');
route('upcommingevent','ticket/Ticket@index3');

route('request','request/Request@index');

route('profile','ticketHolder/Profile@index');