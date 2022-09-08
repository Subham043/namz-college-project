


<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sourcecodester_biobook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['id'])){
header('location:index.php');
}

if(empty($_GET['user'])){
    
    header('location:index.php');
}
$user = $_GET['user'];
$id = $_SESSION['id'];

$sql = "SELECT * FROM friend_request WHERE ( sent_by ='$user' AND sent_to ='$id' ) OR (sent_by ='$id' AND sent_to ='$user')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  echo "Friend request exist.";
} else {
    mysqli_query($conn,"INSERT INTO friend_request (sent_by,sent_to)
	VALUES ('$id','$user')");
    echo "friend request sent.";
    header('location:profile.php?user='.$user);
}
$conn->close();
?>

