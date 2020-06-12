<?php 
require_once 'connection.php';
header('Content-Type: application/json');
/**
 * summary
 */
class User_reg
{
    private $db;
    private $connection;
    public function __construct() {
        $this->db = new DB_connection();
        $this->connection = $this->db->get_connection();
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
}
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = new User_reg();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    //check if file is available
    if (getimagesize($_FILES['image']['tmp_name']) !== false) {
    	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }
    else {
        echo "<br> Image invalid!";
    }
    //check existant users
    $check_exist = $user->user_exist($username, $password);
    if (!$check_exist) {
    	$query_reg = "INSERT INTO users (username, password, fname, lname, picture) VALUES ('$username', '$password', '$fname', '$lname', '$image')";
        $result = mysqli_query((new DB_connection())->get_connection(),$query_reg);
        if ($result) {
            $json['status'] = '200 OK';
            echo json_encode($json);
        }
        mysqli_close((new DB_connection())->get_connection());
    }
}
else {
    $json['status'] = '404 Not found';
    echo json_encode($json);
}
?>