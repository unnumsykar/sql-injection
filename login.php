
/*session_start();
include "db_conn.php";

if (isset($_POST['uname']) OR isset($_POST['password'])){
    $uname = $_POST['uname'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$uname' OR password='$pass'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    header("Location: home.php");
    exit();

}
else{
    header("Location: index.php");
	exit();
}*/
<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'"; // vulnerable to sql injection
        //$sql = "SELECT * FROM users WHERE username='" . $_POST['uname'] . "' AND password='" . $_POST['password'] . "'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
				$_SESSION['username'] = $row['username'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}
// to check - '  OR 1=1 -- 