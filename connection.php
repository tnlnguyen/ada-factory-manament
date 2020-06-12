<?php 
	require_once 'conf.php';

	/**
	 * summary
	 */
	class DB_connection
	{
	    public function __construct()
	    {
	        $this->connect = mysqli_connect(hostname,dbuser,dbpass,dbname) or die("Database connection error!");
	    }
	    public function get_connection()
	    {
	    	return $this->connect;
	    }
	}
?>