<?php
	require_once (getcwd ()."/views/homeView.php");

	/**
	* @brief "home" controller class
	* 
	* @details This is the controller corresponding to the "home" page (\"<code>homeView</code>\")
	*/
	class homeController
	{
		/**
		* @brief This is the constructor
		*/
		public function __construct ()
		{
		}

		/**
		* @brief renders the view
		* 
		* @param string|null $data [not used] This is the data transmitted from AJAX calls. See the \"<code>@link router::route router->route@endlink</code>\"'s "Remarks" section for more information
		* 
		* @return void
		* 
		* @see router::route
		*/
		public function render (?string $data): void
		{
			$homeView=new homeView ();
		}

		/**
		* @brief sample method used by an AJAX call
		* 
		* @param string|null $data The data used to retrieve other data
		* 
		* @return void
		* 
		* @throw Exception if the response encoding fails and we're in debug mode
		*/
		public function getHomeData (?string $data): void
		{
			$responseContent=["sampleMessage"=>$data];

			try
			{
				echo json_encode ($responseContent, JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR);
			}
			catch (Exception $e)
			{
				if ($GLOBALS ["configurator"]->getDebugMode ()===true)
				{
					echo $e->getMessage ()."\n".$e->getTraceAsString ();
				}
				else
				{
					http_response_code (500);
				}

				die ();
			}
		}
	}
?>