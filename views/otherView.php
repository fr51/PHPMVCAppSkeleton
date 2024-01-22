<?php
	/**
	* @brief "other" view class
	* 
	* @details This is the view corresponding to the "other" controller (\"<code>otherController</code>\")
	*/
	class otherView
	{
		/**
		* @var  string $header 
		* some boilerplate HTML code (before the content itself)
		*/
		private string $header="<!DOCTYPE html>
<html>
	<head>
		<title>
			other - testApp
		</title>
		<link rel='stylesheet' href='views/css/style.css'>
		<script type='text/javascript' src='views/js/jquery-3.7.0.min.js'>
		</script>
		<script type='text/javascript' src='views/js/otherView.js'>
		</script>
		<script type='text/javascript' src='views/js/sweetalert2.all.min.js'>
		</script>
	</head>
	<body>
		<div id='content'>
			";
		/**
		* @var  string $footer 
		* some boilerplate HTML code (after the content itself)
		*/
		private string $footer="
		</div>
	</body>
</html>";

		/**
		* @brief This is the constructor
		* 
		* @details Nothing special about it, except it triggers the view rendering
		*/
		public function __construct ()
		{
			$this->render ();
		}

		/**
		* @brief renders the view
		* 
		* @details renders the whole view, especially the content
		* 
		* @return void
		*/
		private function render (): void
		{
			echo $this->header;
			echo "<h1>
				Other Page
			</h1>
			<a href='index.php?route=home/index'>
				Go to Home Page
			</a>
			<br>
			<input type='button' id='button1' value='launch POST AJAX call'>";
			echo $this->footer;
		}
	}
?>