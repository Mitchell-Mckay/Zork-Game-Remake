<?php
session_start();

// check for login
if(!ISSET($_SESSION['username'])) {

    // login is not active - bounce to login
    header('location:login.php');
} else {

    //login is active
    $msg = "you are logged in! <br> Username: ";
}

?>

<html>
<link rel="stylesheet" href="Styling.css">
<body>
<br><br><br><br><br><br>
<img width = 500px src = "imgs/zork-logo.png">
<br>
<br>
<h2>
Welcome, <?php echo $_SESSION['username']; ?>!
<br>
<a href="gamehomepage.php"><img width = 300px src = "imgs/Playgame.png"></a>
<br><br>

<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text">  <a href='updateprofile.php' alt='Broken Link'>Update profile</a>
  </span>
</button>

<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text">  <a href='logout.php' alt='Broken Link'>Logout</a>
  </span>
</button>


</body>
</html>