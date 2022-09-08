
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

mysqli_query($conn,"UPDATE friend_request
SET status = 2
WHERE (sent_by ='$user' AND sent_to ='$id' ) OR (sent_by ='$id' AND sent_to ='$user')");
echo "friend request sent.";
header('location:profile.php?user='.$user);
// echo "friend request sent.";
header('location:profile.php?user='.$user);