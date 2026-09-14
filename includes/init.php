<?php
############################################################################
// initialize database

// load config
        require_once('includes/config.php');

        // load db class -- supports only mysql at the moment
        require_once('includes/db_mysql.php');
		require_once('includes/functions.php');
	

        $DB_site = new DB_Sql_vb;
        $ums_fun= new fun_check;
        $DB_site->appname = 'Adham_Abohatem';
        $DB_site->appshortname = 'Adham_Abohatem';
        $DB_site->database = $dbname;

        $DB_site->connect($servername, $dbusername, $dbpassword,$dbname, $usepconnect);

        unset($servername, $dbusername, $dbpassword, $usepconnect);
        // end init db
?>