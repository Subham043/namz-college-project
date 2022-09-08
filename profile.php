<!DOCTYPE html>
<html>

<head>
    <title>Welcome To Studentogram - Sign up, Log in, Post </title>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>
    <?php include ('session.php');?>

    <div id="header">
        <div class="head-view">
            <ul>
                <li><a href="home.php" title="Studentogram"><b>Studentogram</b></a></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li><a href="timeline.php" title="<?php echo $username ?>"><label><?php echo $username ?></label></a>
                </li>
                <li><a href="home.php" title="Home"><label>Home</label></a></li>
                <li><a href="profile.php" title="Profile"><label class="active">Profile</label></a></li>
                <li><a href="photos.php" title="Settings"><label>Photos</label></a></li>
                <li><a href="logout.php" title="Log out"><button class="btn-sign-in" value="Log out">Log
                            out</button></a></li>
            </ul>
        </div>
    </div>

    <div id="container">

        <div id="left-nav">

            <div class="clip1">
                <a href="updatephoto.php" title="Change Profile Picture"><img
                        src="<?php echo $row['profile_picture'] ?>"><button>Update Picture</button></a>

            </div>

            <div class="user-details">
                <h3><?php echo $firstname ?>&nbsp;<?php echo $lastname ?></h3>
                <h2><?php echo $username ?></h2>
            </div>
        </div>



        <div id="right-nav">
            <h1>Personal Info</h1>
            <hr />
            <br />
            <?php
			include('includes/database.php');

			$result=mysqli_query($con,"SELECT * FROM user where user_id='$id' ");
			
			while($test = mysqli_fetch_array($result))
			{
				$id = $test['user_id'];	
				echo " <div class='info-user'>";
				echo " <div>";
				echo " <label>Firstname</label>&nbsp;&nbsp;&nbsp;<b>".$test['firstname']."</b>";
				echo "</div> ";
				echo "<hr /> ";		
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Lastname</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['lastname']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Username</label>&nbsp;&nbsp;&nbsp;<b>".$test['username']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Birthday</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['birthday']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['gender']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Number</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['number']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";	
				echo "</div> ";
				echo "<br /> ";		
				echo " <div class='edit-info'>";
				if(!empty($_GET['user'])){
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "sourcecodester_biobook";
					$conn = new mysqli($servername, $username, $password, $dbname);
					$user = $_GET['user'];
					$id = $_SESSION['id'];

					$sql = "SELECT * FROM friend_request WHERE ( sent_by ='$user' AND sent_to ='$id' ) OR (sent_by ='$id' AND sent_to ='$user')";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					
						while($row = $result->fetch_assoc()) {
							if($row["status"]==1){
								if($row["sent_by"]==$id){
									echo " <a href ='send_friend_request.php?user=$user'><button>Waiting for approval</button></a>";
								}else{
									echo " <a href ='accept_friend_request.php?user=$user'><button>Accept</button></a>";
									echo " <a href ='reject_friend_request.php?user=$user'><button>Reject</button></a>";
								}
								
							}else{
								echo " <a title='remove friend' href ='reject_friend_request.php?user=$user'><button>Already Friends</button></a>";
							}
						}
					} else {
						echo " <a href ='send_friend_request.php?user=$user'><button>Send Friend Request</button></a>";
					}
				}else{
					echo " <a href ='edit_profile.php?user_id=$id'><button>Edit Profile</button></a>";
				}
				echo "</div> ";
				if(empty($_GET['user'])){
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "sourcecodester_biobook";
					$conn = new mysqli($servername, $username, $password, $dbname);
					$id = $_SESSION['id'];

					$sql = "SELECT friend_request.*, user.firstname as sent_to_firstname, user.lastname as sent_to_lastname, user.username as sent_to_username, user.profile_picture as sent_to_profile_picture, us.firstname as sent_by_firstname, us.lastname as sent_by_lastname, us.username as sent_by_username, us.profile_picture as sent_by_profile_picture FROM friend_request LEFT JOIN user on user.user_id = friend_request.sent_to LEFT JOIN user us on us.user_id = friend_request.sent_by WHERE sent_to ='$id' OR sent_by ='$id'";
					$query=mySQLi_query($conn,$sql );
					echo "<h1>Friend List</h1>";
					echo "<hr />";
					echo "<br />";
					while($row=mySQLi_fetch_array($query)){
						if($row['sent_by']==$id){
						?>
						
						<div style="display:flex; justify-content:flex-start; align-items:center;margin-left:20px;margin-bottom:20px;">
							<img src="<?php echo $row['sent_to_profile_picture']; ?>" style="width:80px;height:80px;border-radius:40px;object-fit:cover;margin-right:20px;" />
							<div>
								<h3 style="margin:0"><?php echo $row['sent_to_firstname']." ".$row['sent_to_lastname']; ?></h3>
								<h5 style="margin:0"><?php echo $row['sent_to_username']; ?></h5>
							</div>
						</div>
						<?php }else{ ?>
							<div style="display:flex; justify-content:flex-start;margin-left:20px;margin-bottom:20px;">
								<img src="<?php echo $row['sent_by_profile_picture']; ?>" style="width:80px;height:80px;border-radius:40px;object-fit:cover;margin-right:20px;" />
								<div>
									<h3 style="margin:0"><?php echo $row['sent_by_firstname']." ".$row['sent_by_lastname']; ?></h3>
									<h5 style="margin:0"><?php echo $row['sent_by_username']; ?></h5>
								</div>
							</div>

					<?php }}
				}
				echo "<br /> ";	
				echo "<br /> ";	
			}
			?>


        </div>


    </div>





    </div>

</body>

</html>