<?php 
require 'connection.php';
require 'restful_api.php';
/**
 * summary
 */
class User extends restful_api
{
    private $db;
    private $connection;
    public function __construct() {
        $this->db = new DB_connection();
        $this->connection = $this->db->get_connection();
        parent::__construct();
    }
    public function user_exist($username, $password) {
    	$query = "SELECT * FROM users WHERE username = '".$username."' AND password  = '".$password."'";
    	$result = mysqli_query($this->connection, $query);
    	if (mysqli_num_rows($result) == 1) {
            mysqli_close($this->connection);
    		return $this->response(200);
    	}
    	else {
            mysqli_close($this->connection);
            return $this->reponse(400);
    	}
    }
}
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = new User();
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $user->user_exist($username, $password);
}

?>