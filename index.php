<?php
	require_once ("controllers/util/configurator.php");
	require_once ("controllers/util/router.php");
	require_once ("controllers/util/DAL.php");

	global $configurator;
	$configurator=new configurator ();

	$configurator->configure ();
	global $DAL;
	$DAL=null;
	$router=null;

	if ($DAL===null)
	{
		$DAL=new DAL ($GLOBALS ["configurator"]->appSettings ["database"]);
	}

	if ($router===null)
	{
		$router=new router ($GLOBALS ["configurator"]->appSettings ["routes"]);
	}

	$route="home/index";
	$message=null;

	switch ($_SERVER ["REQUEST_METHOD"])
	{
		case "GET":
			if (isset ($_GET ["route"])===true)
			{
				$route=$_GET ["route"];
			}

			if (isset ($_GET ["message"])===true)
			{
				$message=$_GET ["message"];
			}

			break;
		case "POST":
			if (isset ($_POST ["route"])===true)
			{
				$route=$_POST ["route"];
			}

			if (isset ($_POST ["message"])===true)
			{
				$message=$_POST ["message"];
			}

			break;
		default: //for AJAX calls
			echo "This method is not allowed here. Use GET or POST instead";
			die ();
	}

	$router->route ($route, $message);
?>