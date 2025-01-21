<?php



// did they click submit?
if(ISSET($_POST['submitButton'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    // validate for empty fields
    if(!empty($email) && !empty($username) && !empty($password)) {
        // build a db connection, build a query, and then execute
        $conn = mysqli_connect('localhost', 'root', '', 'zork-game') or die('Could not connect to the Data Base');
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `health`) VALUES (NULL, '$email', '$username', '$hash', '100')";
        
        mysqli_query($conn, $query) or die("Bad query");
        header("location:login.php");
        $msg = "";
    } else {
        $msg = "pls fill out all fields";
    }
} else {
    $email = "";
    $password = "";
    $username = "";
    $msg = "";
}
echo $msg;

?>

<html>
<link rel="stylesheet" href="Styling.css">
<br><br><br><br><br><br><br><br><br><br><br>
<body>
    <h1>Registration</h1> <?php echo $msg; ?>
    <p>Complete all fields to register</p>
    <p>Make sure to actually click register button!</p>
    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        Email: <br><input type ="email" name = "email" value = "<?php echo $email ?>"><br><br>
        Username: <br><input type ="username" name = "username" maxlength="5" value = "<?php echo $username ?>"><br><br>
        Password: <br><input type ="password" name = "password" value = "<?php echo $password ?>"><br><br>

        <button>
            <span class="shadow"></span>
            <span class="edge"></span>
            <span class="front text">  <input type="submit" name="submitButton" value = "Register">
            </span>
        </button>

        <p>Already have an account?<p>
    </form> 

<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text">  <a href='login.php' alt='Broken Link'>Login</a>
  </span>
</button>

</body>
</html>