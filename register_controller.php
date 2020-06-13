<?php 
require_once 'connection.php';
require 'restful_api.php';
/**
 * summary
 */
class register_controller extends restful_api
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
    		return true;
    	}
    	else {
            mysqli_close($this->connection);
            return false;
    	}
    }
    public function register_request() {
        if (!empty($this->params['username']) && !empty($this->params['password'])) {
            //check existant users
            $check_exist = $this->user_exist($this->params['username'], $this->params['password']);
            if (!$check_exist) {
                $username = $this->params['username'];
                $password = $this->params['password'];
                $fname = $this->params['fname'];
                $lname = $this->params['lname'];
                $type = "";
                if (isset($this->params['qlk'])) {
                    $type = $this->params['qlk'];
                }
                else if (isset($this->params['bpk'])) {
                    $type = $this->params['bpk'];
                }
                else if (isset($this->params['ql'])) {
                    $type = $this->params['ql'];
                }
                $query_reg = "INSERT INTO users (username, password, fname, lname, chucvu) VALUES ('$username', '$password', '$fname', '$lname', '$type')";
                $result = mysqli_query((new DB_connection())->get_connection(),$query_reg);
                if ($result) {
                    return $this->response(200);
                }
                mysqli_close((new DB_connection())->get_connection());
            }
            else {
                return $this->response(405, "User existed");
            }
        }
        else {
            return $this->response(404);
        }
    }
}
$reg = new register_controller();
?>