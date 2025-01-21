<?php

//locations
$title = NULL;

$desc = NULL;

if(empty($_SESSION['x'])) {

    $_SESSION['x'] = 0;

}

if(empty($_SESSION['y'])) {

    $_SESSION['y'] = 0;
    
}

// SET MAP PARIMETERS // 

//limits for west and east
if($_SESSION['x'] < -3){

    $emsg = "You can't go that way!";
    $_SESSION['x'] = -3;

} elseif($_SESSION['x'] > 0){

    $emsg = "You can't go that way!";
    $_SESSION['x'] = 0;

}

//limits for north and south

if($_SESSION['y'] > 0){

    $emsg = "You can't go that way!";
    $_SESSION['y'] = 0;
}

if($_SESSION['y'] < -3){

    $emsg = "You can't go that way!";
    $_SESSION['y'] = -3;

}


////////////////////////////////////////////////////////////////

// Start
if($_SESSION['x'] == 0 && $_SESSION['y'] == 0) {
    $title = $start_title;
    $desc = $start_desc;
} 

// treasury
if($_SESSION['x'] == -3 && $_SESSION['y'] == -3) {
    $title = $treasury_title;
    $desc = $treasury_desc;
} 

 // gate
if($_SESSION['x'] == -3 && $_SESSION['y'] == 0 OR $_SESSION['x'] == -2 && $_SESSION['y'] == -2) {
    $title = $gate_title;
    $desc = $gate_desc;
} 

// bridge
if($_SESSION['x'] == 0 && $_SESSION['y'] == -1) {
    $title = $bridge_title;
    $desc = $bridge_desc;
}

// The great chamber
if($_SESSION['x'] == -2 && $_SESSION['y'] == 0) {
    $title = $chamber_title;
    $desc = $chamber_desc;
}

// goblin
if($_SESSION['x'] == -1 && $_SESSION['y'] == -1) {
    $title = $goblin_title;
    $desc = $goblin_desc;
}

// guard
if($_SESSION['x'] == 0 && $_SESSION['y'] == -3) {
    $title = $guard_title;
    $desc = $guard_desc;
}

// castle
if($_SESSION['x'] == -1 && $_SESSION['y'] == -3) {
    $title = $castle_title;
    $desc = $castle_desc;
}

// cave
if($_SESSION['x'] == -1 && $_SESSION['y'] == 0) {
    $title = $cave_title;
    $desc = $cave_desc;
}

// grand hall
if($_SESSION['x'] == -2 && $_SESSION['y'] == -1) {
    $title = $grandhall_title;
    $desc = $grandhall_desc;
}

// tool room
if($_SESSION['x'] == 0 && $_SESSION['y'] == -2) {
    $title = $toolshed_title;
    $desc = $toolshed_desc;
}

?>