<?php

// start session
session_start();
require('locations.php');
require('gamemovement.php');
require('gamemap.php');

// empty move
if(!ISSET($move)){
    $move = "";
}

if(ISSET($_POST['reset'])){
    $_SESSION['x'] = 0;
    $_SESSION['y'] = 0;
    $health = 100;
    $_SESSION['health'] = 100;
    $_SESSION['shield'] = 0;
    unset($_SESSION['inventory']);
    $title = $start_title;
    $desc = $start_desc;	
    $_SESSION['knighthp'] = 100;
    $_SESSION['goblinhp'] = 100;
}

// inventory imgs
if(in_array('shieldpotion', $inventory)) {
    $shieldimg = '<img style="width:50px; height:50px;"  src = "imgs/shieldpotion.png">';
} else {
    $shieldimg = "";
}
if(in_array('key', $inventory)) {
    $keyimg = '<img style="width:50px; height:50px;"  src = "imgs/key.png">';
} else {
    $keyimg = "";
}
if(in_array('gold', $inventory)) {
    $goldimg = '<img style="width:50px; height:50px;"  src = "imgs/gold.png">';
} else {
    $goldimg = "";
}
if(in_array('accuracypotion', $inventory)) {
    $accuracyimg = '<img style="width:50px; height:50px;"  src = "imgs/greenpotion.png">';
} else {
    $accuracyimg = "";
}
if(in_array('dagger', $inventory)) {
    $daggerimg = '<img style="width:50px; height:50px;"  src = "imgs/dagger.png">';
} else {
    $daggerimg = "";
}
if(in_array('mace', $inventory)) {
    $maceimg = '<img style="width:50px; height:50px;"  src = "imgs/mace.png">';
} else {
    $maceimg = "";
}
if(in_array('sword', $inventory)) {
    $swordimg = '<img style="width:50px; height:50px;"  src = "imgs/sword.png">';
} else {
    $swordimg = "";
}
if(in_array('healthpotion', $inventory)) {
    $healthimg = '<img style="width:50px; height:50px;"  src = "imgs/redpotion.png">';
} else {
    $healthimg = "";
}
?>

<html>
<link rel="stylesheet" href="Styling.css">
<br><br>
<body>

<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <span class="front text" style = "padding: 12px 20px; font-weight: 600; font-size: 18px;"> Username: <?php echo $_SESSION['username']; ?>
  </span>
</button>

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

    <br><br>
    <p>
    <div class = "outer">
    <div class = "inner"><?php echo "Health:" . $health?></div>
    </div>
    </p>

    <p>
    <div class = "outerenemy">
    <div class = "innerenemy"><?php echo "EnemyHealth:" . $enemyhealth?></div>
    </div></p>

    <p>Shield: <?php echo $_SESSION['shield'] ?></p>

    <p> Location: 
    X: <?php echo $_SESSION['x']; ?> 
    Y: <?php echo $_SESSION['y']; ?> <br> </p>

    <p> <?php if($move == 'help' or $move == '?') {
        $desc = $help;
    } elseif($move == 'look') {
        $desc = $desc;
    }
    ?> </p>

    <p><?php if(ISSET($emsg)){ echo "Error: " . $emsg;} ?> </p>

    <p><?php if(ISSET($msg)){ echo $msg;} ?> </p>

    <?php
    //prevent duplicate items
    $inventory2 = array_unique($inventory);
    $inventory3 = implode(", ", $inventory2);
    ?></p> 
    <?php
    echo $shieldimg;
    echo $keyimg;
    echo $goldimg;
    echo $accuracyimg;
    echo $daggerimg;
    echo $maceimg;
    echo $swordimg;
    echo $healthimg;
    ?>

    <p> <?php echo "Location: " . $title ; ?> </p>
 
    <p> <?php echo $desc; ?> </p>

    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    <p style='position:fixed; top:75%; left:45%;'>Type Move: <br><input type = "text" name = "movement"> </p>
    <br><br>

    <button style='position:fixed; top:89%; left:40%;'>
        <span class="shadow"></span>
        <span class="edge"></span>
        <span class="front text"> <input type = "submit" name = "reset" value = "Reset Game">
        </span>
    </button>

    <button style='position:fixed; top:89%; left:52%;'>
        <span class="shadow"></span>
        <span class="edge"></span>
        <span class="front text"> <input type = "submit" name = "movebutton" value = "Submit">
        </span>
    </button>
    
    </form>
</body>
</html>

<?php 
$userid = $_SESSION['user_id'];
$x = $_SESSION['x'];
$y = $_SESSION['y'];
require('dbc.php');
$query = "UPDATE `users` SET `x` = '$x', `y` = '$y', `health` = '$health', `shield` = '$shield', `inventory` = '$inventory3' WHERE `users`.`user_id` = '$userid';" ;

mysqli_query($conn, $query) or die("no connection to query");
?>

<style type="text/css">
.outer{
    height: 25px;
    width: 475px;
    border: solid 1px #000;
    text-align: left;
    border-radius: 5px; 
}
.inner {
    height: 25px;
    width:<?php echo $health?>%;
    border-right: solid 1px #000;
    background-color: #009966;
    border-radius: 5px;
}
.outerenemy{
    height: 25px;
    width: 475px;
    border: solid 1px #000;
    text-align: left;
    border-radius: 5px; 
}
.innerenemy {
    height: 25px;
    width:<?php echo $enemyhealth?>%;
    border-right: solid 1px #000;
    background-color: #C41E3A;
    border-radius: 5px;
}
</style>
