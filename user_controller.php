<?php 
require 'connection.php';
require 'restful_api.php';
/**
 * summary
 */
class user_controller extends restful_api
{
    private $db;
    private $connection;
    public function __construct() {
        $this->db = new DB_connection();
        $this->connection = $this->db->get_connection();
        parent::__construct();
    }
    public function login_request() {
        $username = $this->params['username'];
        $password = $this->params['password'];
        $query = "SELECT * FROM users WHERE username = '".$username."' AND password  = '".$password."'";
    	$result = mysqli_query($this->connection, $query);
    	if (mysqli_num_rows($result) == 1) {
            mysqli_close($this->connection);
    		return $this->response(200);
    	}
    	else {
            mysqli_close($this->connection);
            return $this->response(400);
    	}
    }
}
$user_api = new user_controller();
?>