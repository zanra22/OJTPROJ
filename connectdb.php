<?php

	define("HOSTNAME", "localhost");
	define("USERNAME", "root");
	define("PASSWORD", 'str0ngpa$$w0rd');
	define("DATABASE", "registration");

	$dbhandle = new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die("Unable to connect database");

?>