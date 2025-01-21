<?php
// start session
session_start();

// Did they click submit?
if(ISSET($_POST['submitButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check for an empty field
    if(empty($username) OR empty($password)) {
        $msg = "fields are empty!";
    } else {
        // fields are full so validate against DB
        require('dbc.php');
        $query = "SELECT * FROM `users` where `users`.`username` = '" . $username . "';";
        $result = mysqli_query($conn, $query) or die('Bad Query');

        while($row = mysqli_fetch_array($result)) {
            $db_password = $row['password'];

            //validate passwords
            if(password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $username;
                $_SESSION['x'] = $row['x'];
                $_SESSION['y'] = $row['y'];
                $_SESSION['health'] = $row['health'];
                $_SESSION['shield'] = $row['shield'];
                $_SESSION['inventory'] = explode(",", $row['inventory']);
                header('location:index.php');
                $msg = "Passwords Match!";
            } else {
                $msg = "Passwords Do Not Match!";
            }
        }
    }
} else {
    $msg = "Please Login!!";
}
?>
<html>
<link rel="stylesheet" href="Styling.css">
<body>
<br><br><br><br><br><br><br><br><br><br><br>
    <h1>Login</h1>
    <p><?php echo $msg; ?></p>
    <p>Make sure to actually click register button!</p>
    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        Username: <br><input type="text" name="username"><br><br>
        Password: <br><input type="password" name="password"><br><br>
        

        <button>
            <span class="shadow"></span>
            <span class="edge"></span>
            <span class="front text">  <input type="submit" name="submitButton" value = "Login"> <br>
            </span>
        </button>

        <p>Need an account?<p>
    </form>


<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text">  <a href='register.php' alt='Broken Link'>Register</a>
  </span>
</button>

</body>  
</html>