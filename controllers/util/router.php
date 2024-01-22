<?php
	/**
	* @brief router class
	* 
	* @details This utilitary class calls the right controller and method according to the current URL
	*/
	class router
	{
		/**
		* @var  array $routes 
		* the routes list
		*/
		private array $routes;

		/**
		* @brief This is the constructor
		* 
		* @details Nothing special to say about it, except it gets the routes from the configurator
		* 
		* @param array $routes the routes to map
		*/
		public function __construct (array $routes)
		{
			$this->setRoutes ($routes);
		}

		/**
		* @brief Sets the routes
		* 
		* @param array $routes the routes to map
		* 
		* @return nothing
		*/
		private function setRoutes (array $routes): void
		{
			$this->routes=$routes;
		}

		/**
		* @brief the router core
		* 
		* @details As said in the class description, this method calls the right controller and method with a given route
		* 
		* @param string $route the route to follow
		* @param string|null $message [for AJAX calls] the message to transmit
		* 
		* @return nothing
		* 
		* @throw Exception if the route doesn't exist and we're in debug mode
		* 
		* @remark In a simplification purpose, I call the method with a possible message (used by AJAX calls). That's why I declared the message as nullable
		*/
		public function route (string $route, ?string $message): void
		{
			if (array_key_exists ($route, $this->routes)===true)
			{
				$routeComponents=explode ("::", $this->routes [$route]);
				$controllerName=$routeComponents [0];
				$methodName=$routeComponents [1];

				include_once ("controllers/{$controllerName}.php");

				$controller=new $controllerName ();
				$controller->$methodName ($message);
			}
			else
			{
				if ($GLOBALS ["configurator"]->getDebugMode ()===true)
				{
					throw new Exception ("The \"{$route}\" route doesn't exist");
				}
				else
				{
					http_response_code (404);
				}

				die ();
			}
		}
	}
?>