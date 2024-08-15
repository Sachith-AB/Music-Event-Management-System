<?php

route('home','Home@index');


route('signin','Signin@index');
route('signup','Signup@index');





route('createEvent', 'event/Create@index');

route('purchaseticket','ticket/Ticket@index');
route('successfullypaid','ticket/Ticket@index2');
route('upcommingevent','ticket/Ticket@index3');