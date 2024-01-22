<?php
	/**
	* @brief Data Access Layer class
	* 
	* @details This utilitary class provides an access to the database and executes queries
	*/
	class DAL
	{
		/**
		* @var  string $userName 
		* the user's name
		*/
		private string $userName;
		/**
		* @var  string $userPassword 
		* the user's password
		*/
		private string $userPassword;
		/**
		* @var string $databaseAddress 
		* the database server's address
		*/
		private string $databaseAddress;
		/**
		* @var  string $databaseName 
		* the database's name
		*/
		private string $databaseName;
		/**
		* @var  int $databasePort 
		* the database server's port number
		*/
		private int $databasePort;
		/**
		* @var  string $databaseType
		* the database's type
		*/
		private string $databaseType;
		/**
		* @var  PDO $connectionHandler 
		* This has to be renamed and described
		*/
		private PDO $connectionHandler;

		/**
		* @brief This is the constructor
		* 
		* @details Nothing special to say about it, except it establishes the connection with the database
		* 
		* @throw Exception if the connection fails and we're in debug mode
		*/
		public function __construct (array $connectionInfo)
		{
			$this->setUserName ($connectionInfo ["user"] ["name"]);
			$this->setUserPassword ($connectionInfo ["user"] ["password"]);
			$this->setDatabaseAddress ($connectionInfo ["database"] ["address"]);
			$this->setDatabaseName ($connectionInfo ["database"] ["name"]);
			$this->setDatabasePort ($connectionInfo ["database"] ["port"]);
			$this->setDatabaseType ($connectionInfo ["database"] ["type"]);

			try
			{
				$this->setConnectionHandler (new PDO ($this->databaseType.":dbname=".$this->databaseName.";host=".$this->databaseAddress.";port=".strval ($this->databasePort).";charset=utf8mb4", $this->userName, $this->userPassword));
			}
			catch (Exception $e)
			{
				if ($GLOBALS ["configurator"]->getDebugMode ()===true)
				{
					throw $e;
				}
				else
				{
					http_response_code (500);
				}

				die ();
			}
		}

		/**
		* @brief Sets the user's name
		* 
		* @param string $newUserName the new user's name
		* 
		* @return nothing
		*/
		private function setUserName (string $newUserName): void
		{
			$this->userName=$newUserName;
		}

		/**
		* @brief Sets the user's password
		* 
		* @param string $newUserPassword the new user's password
		* 
		* @return nothing
		*/
		private function setUserPassword (string $newUserPassword): void
		{
			$this->userPassword=$newUserPassword;
		}

		/**
		* @brief Sets the database's address
		* 
		* @param string $newDatabaseAddress the new database's address
		* 
		* @return nothing
		*/
		private function setDatabaseAddress (string $newDatabaseAddress): void
		{
			$this->databaseAddress=$newDatabaseAddress;
		}

		/**
		* @brief Sets the database's name
		* 
		* @param string $newDatabaseName the new database's name
		* 
		* @return nothing
		*/
		private function setDatabaseName (string $newDatabaseName): void
		{
			$this->databaseName=$newDatabaseName;
		}

		/**
		* @brief Sets the database server's port number
		* 
		* @param int $newDatabasePort the new port number
		* 
		* @return nothing
		*/
		private function setDatabasePort (int $newDatabasePort): void
		{
			$this->databasePort=$newDatabasePort;
		}

		/**
		* @brief Sets the database's type
		* 
		* @param string $newDatabaseType the new database's type
		* 
		* @return nothing
		*/
		private function setDatabaseType (string $newDatabaseType): void
		{
			$this->databaseType=strtolower ($newDatabaseType);
		}

		/**
		* @brief Sets the connection handler
		* 
		* @param PDO $newConnectionHandler the new handler
		* 
		* @return nothing
		*/
		private function setConnectionHandler (PDO $newConnectionHandler): void
		{
			$this->connectionHandler=$newConnectionHandler;
		}

		/**
		* @brief Executes a query, then returns the result
		* 
		* @param string $query the query to execute
		* 
		* @retval array the query result
		*/
		public function executeQueryWithResult (string $query): array
		{
			$rawResult=$this->getQueryResult ($query);
			$result=$rawResult->fetchAll (PDO::FETCH_ASSOC);

			return ($result);
		}

		/**
		* @brief Executes a query, but doesn't return any result
		* 
		* @param string $query the query to execute
		* 
		* @return nothing
		*/
		public function executeQueryWithoutResult (string $query): void
		{
			$rawResult=$this->getQueryResult ($query);
		}

		/**
		* @brief Executes a query
		* 
		* @param string $query the query to execute
		* 
		* @retval PDOStatement the query result
		* 
		* @throw Exception if the query fails and we're in debug mode
		*/
		private function getQueryResult (string $query): PDOStatement
		{
			try
			{
				$result=$this->connectionHandler->query ($query);

				return ($result);
			}
			catch (Exception $e)
			{
				if ($GLOBALS ["configurator"]->getDebugMode ()===true)
				{
					throw $e;
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