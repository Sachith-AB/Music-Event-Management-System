<?php 

if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('ROOT','http://localhost/musica/public');
    /**
     * database config
     */
    define('DBNAME','eventease');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');
}else{
    define('ROOT', 'https://www.websitename.com');

    define('DBNAME','eventease');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');
}

define('APP_NAME',"My website");
define('APP_DESC',"this is best website in world");

//true mean show errors
define('DEBUG',true);
