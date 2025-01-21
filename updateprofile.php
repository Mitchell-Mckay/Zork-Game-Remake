<?php

include('dbc.php') ;

session_start() ;

if(ISSET($_POST['update'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // check for empty fields
    if(empty($username) OR empty($password) OR empty($email)) {
        $msg = "fields are empty!";

    } else {

        // $duplicate = mysqli_query($conn, "SELECT * FROM `login` WHERE username = '$username';");
    
        // if(mysqli_num_rows($duplicate) > 1){
        //     die("username is taken") ;
        // }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE `users` SET `email` = '$email', `username` = '$username', `password` = '$hash' WHERE `users`.`user_id` = 1;" ;
        
        mysqli_query($conn, $query) or DIE('Bad query');

        if(ISSET($_POST['update'])){

            header('Location:index.php');
            
        }
    }
} else {
    $msg = "";
}   

?>

<html>
<link rel="stylesheet" href="Styling.css">
<br><br><br><br><br><br><br><br><br><br><br>
<body>

    <h1> <strong> Update Profile </strong> </h1>

    <form method= "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">

        E-mail: <br>
        <input type = "text" name= "email">
        <br><br>

        Username: <br>
        <input type = "text" name= "username">
        <br><br>

        Password: <br>
        <input type = "password" name= "password">
        <br><br><br>

        <button>
            <span class="shadow"></span>
            <span class="edge"></span>
            <span class="front text">  <input type = "submit" name = "update" value = "Update">
            </span>
        </button>

        <br><br>

        <?php echo $msg; ?>

    </form>

<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text">  <a href='index.php'>Cancel</a>
  </span>
</button>

</body>
</html>