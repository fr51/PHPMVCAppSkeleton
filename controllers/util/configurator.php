<?php
	/**
	* @brief application configuration class
	* 
	* @details This utilitary class loads the settings from corresponding JSON files (located in \"<code>/cfg</code>\")
	*/
	class configurator
	{
		/**
		* @var  bool $debugMode 
		* Is the debug mode enabled? I.e., do we show exceptions for developers (<code>true</code>), or do we send http codes for users (<code>false</code>)?
		*
		* @remark This has to be used as a constant
		*/
		private bool $debugMode=true;
		/**
		* @var  array $appSettings
		* a dictionary gathering all the settings from the configuration files
		*/
		public array $appSettings=[];

		/**
		* @brief This is the constructor
		* 
		* @details Nothing special to say about it, except it sets the parameters gathered from the JSON files
		*/
		public function __construct ()
		{
		}

		/**
		* @brief Tells us if we're in debug mode or not
		* 
		* @retval bool the debug mode currently set
		*/
		public function getDebugMode (): bool
		{
			return ($this->debugMode);
		}

		/**
		* @brief Checks the file extensions are "json", then delegates the loading
		* 
		* @throws Exception if one of the files isn't a JSON one, and we're in debug mode
		* 
		* @remarks Whether the filename is upper- or lowercase doesn't matter
		*/
		public function configure (): void
		{
			$configFolder=getcwd ()."/cfg";
			$configFolderContent=scandir ($configFolder);

			if ($configFolderContent===false)
			{
				if ($this->debugMode===true)
				{
					throw new Exception ("Directory scan failed!");
				}
				else
				{
					http_response_code (500);
				}

				die ();
			}

			for ($i=2; $i<sizeof ($configFolderContent); $i++)
			{
				if (str_ends_with ($configFolderContent [$i], ".json")===false && str_ends_with ($configFolderContent [$i], ".JSON")===false)
				{
					if ($this->debugMode===true)
					{
						throw new Exception ("The \"".$configFolderContent [$i]."\" file isn't a JSON one!");
					}
					else
					{
						http_response_code (500);
					}

					die ();
				}

				$this->loadFile ($configFolder."/".$configFolderContent [$i]);
			}
		}

		/**
		* @brief Loads information from a specified configuration file
		* 
		* @details Reads a configuration file, then makes the content available, via a public array (used as a dictionary)
		* 
		* @param string $JSONFileName the name of the settings file to parse
		* 
		* @throw Exception if the file reading/parsing fails and we're in debug mode
		* 
		* @remark The filename provided has to exist in \"<code>/cfg</code>\"
		* @remark The dictionary key is the file name, e.g. \"<code>database</code>\" for \"<code>database.json</code>\", \"<code>routes</code>\" for \"<code>routes.json</code>\"
		*/
		private function loadFile (string $JSONFileName): void
		{
			try
			{
				$rawFileContent=file_get_contents ($JSONFileName);
				$fileContent=json_decode ($rawFileContent, true, 512, JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR);
			}
			catch (Exception $e)
			{
				if ($this->debugMode===true)
				{
					throw $e;
				}
				else
				{
					http_response_code (500);
				}

				die ();
			}

			$key=strrchr ($JSONFileName, "/");
			$key=str_replace ("/", "", $key);
			$key=str_ireplace (".json", "", $key);
			$this->appSettings [$key]=$fileContent;
		}
	}
?>