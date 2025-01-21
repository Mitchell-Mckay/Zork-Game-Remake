<?php

$help = "- Type your intended move in the box below" . "<br>" . 
        "- Type all moves in lowercase, or type first letter of move such as 'n' for north" . "<br>" . 
        "- Available moves: north, south, east, west" . "<br>" . 
        "- Available actions: hit 'ITEM', pickup 'ITEM', drink 'ITEM', use 'ITEM', leave, engage, look (opens location desc)";

// Set specific moves and health

if(ISSET($_SESSION['health'])){
    $health = $_SESSION['health'];
}else{
    $health = 100;
}

if(ISSET($_SESSION['shield'])){
    $shield = $_SESSION['shield'];
} else {
    $shield = 0;
}

if(ISSET($_SESSION['inventory'])){
    $inventory = $_SESSION['inventory'];
}
else{
    $inventory = array();
}

$key = 0;

//item stats

if(ISSET($_SESSION['daggerdmg'])){
    $daggerdmg = $_SESSION['daggerdmg'];
}else{
    $daggerdmg = 25;
}

if(ISSET($_SESSION['macedmg'])){
    $macedmg = $_SESSION['macedmg'];
}else{
    $macedmg = 35;
}

if(ISSET($_SESSION['sworddmg'])){
    $sworddmg = $_SESSION['sworddmg'];
}else{
    $sworddmg = 50;
}

// goblin stats
if(ISSET($_SESSION['goblindmg'])){
    $goblindmg = $_SESSION['goblindmg'];
}else{
    $goblindmg = 30;
}

if(ISSET($_SESSION['goblinhp'])){
    $goblinhp = $_SESSION['goblinhp'];
}else{
    $goblinhp = 100;
}

// guard stats

if(ISSET($_SESSION['guarddmg'])){
    $guarddmg = $_SESSION['guarddmg'];
}else{
    $guarddmg = 15;
}

if(ISSET($_SESSION['guardhp'])){
    $guardhp = $_SESSION['guardhp'];
}else{
    $guardhp = 100;
}

// knight stats

if(ISSET($_SESSION['knightdmg'])){
    $knightdmg = $_SESSION['knightdmg'];
}else{
    $knightdmg = 60;
}

if(ISSET($_SESSION['knighthp'])){
    $knighthp = $_SESSION['knighthp'];
}else{
    $knighthp = 100;
}



// check for movement input

// check for button press
if(ISSET($_POST['movebutton'])){
    
    // available moves
    $availmoves = array('east', 'e', 'west', 'w', 'north', 'n', 'south', 's', 'help', '?', 'hit', 'pickup', 'use', 'drink', 'drink shield', 'drink health', 'leave', 
    'drink shieldpotion', 'drink healthpotion', 'engage', 'pickup potion', 'pickup shieldpotion', 'pickup healthpotion', 'pickup gold', 'pickup key', 'pickup dagger', 'pickup key', 'pickup mace', 
    'pickup sword', 'hit dagger', 'hit mace', 'pickup accuracypotion', 'drink accuracypotion', 'drink accuracy', 'use key', 'use gold', 'bribe guard', 'hit sword', 'look');
    $move = $_POST['movement'];

    // navigation
    if(in_array($move, $availmoves)){
        if($move == 'n' or $move == 'north') {

            if($_SESSION['x'] == -1 and $_SESSION['y'] == -3) {
                $_SESSION['x'] == -1;
                $_SESSION['y'] == -3;
                $emsg = "You cannot leave";

            } elseif($_SESSION['x'] == -3 and $_SESSION['y'] == -3) {
                $_SESSION['y'] = $_SESSION['y'] + 3;
                
            } else {
                $_SESSION['y'] = $_SESSION['y'] + 1;
            }

        } elseif($move == 'w' or $move == 'west') {
    
            if($_SESSION['x'] == -2 and $_SESSION['y'] == -1){
                $_SESSION['x'] == -2;
                $_SESSION['y'] == -1;
                $emsg = "You cannot leave";
    
            } elseif($_SESSION['x'] == -2 and $_SESSION['y'] == -2) {
                $_SESSION['x'] == -2;
                $_SESSION['y'] == -2;
                $emsg = "You cannot leave";

            } elseif($_SESSION['x'] == 0 and $_SESSION['y'] == -3) {
                if(in_array("gold", $inventory)) {
                    $_SESSION['x'] = $_SESSION['x'] - 1;
                } else {
                    $_SESSION['x'] == -1;
                    $_SESSION['y'] == -3; 
                    $emsg = "You must bribe the guard to pass!!";
                }

            } elseif($_SESSION['x'] == -1 and $_SESSION['y'] == -3) {
                $_SESSION['x'] == -1;
                $_SESSION['y'] == -3;
                $emsg = "You cannot leave";

            }elseif($_SESSION['x'] == 0 and $_SESSION['y'] == -2) {
                $_SESSION['x'] = $_SESSION['x'] - 2;
            } else {
                $_SESSION['x'] = $_SESSION['x'] - 1;
            }

        } elseif($move == 'e' or $move == 'east') {

            if($_SESSION['x'] == -2 and $_SESSION['y'] == -3){
                $_SESSION['x'] == -2;
                $_SESSION['y'] == -3;
                $emsg = "You cannot leave";

            } elseif($_SESSION['x'] == -3 and $_SESSION['y'] == -3) {
                $_SESSION['x'] = $_SESSION['x'] + 1;
                $_SESSION['y'] = $_SESSION['y'] + 1;

            } elseif($_SESSION['x'] == -2 and $_SESSION['y'] == -2) {
                $_SESSION['x'] = $_SESSION['x'] + 2;

            } else {
                $_SESSION['x'] = $_SESSION['x'] + 1;
            }

        } elseif($move == 's' or $move == 'south') {

            if($_SESSION['x'] == -1 and $_SESSION['y'] == -1){
                $emsg = "You cannot leave";

            } elseif($_SESSION['x'] == -3 and $_SESSION['y'] == 0) {
                if(in_array("key", $inventory)) {
                    $_SESSION['x'] = -3;
                    $_SESSION['y'] = -3;
                } else {
                    $_SESSION['x'] = -3;
                    $_SESSION['y'] = 0;
                    $emsg = "You need a key to pass through the gate";
                }

            } elseif($_SESSION['x'] == -2 and $_SESSION['y'] == -2) {
                if(in_array("key", $inventory)) {
                    $_SESSION['x'] = -3;
                    $_SESSION['y'] = -3;
                } else {
                    $_SESSION['x'] = -2;
                    $_SESSION['y'] = -2;
                    $emsg = "You need a key to pass through the gate";
                }
            
             } elseif($_SESSION['x'] == -2 and $_SESSION['y'] == -2) {
                $_SESSION['y'] = -3;
                $_SESSION['x'] = -3;
            } else {
                $_SESSION['y'] = $_SESSION['y'] - 1;
            }

        // Specific moves 

        } elseif($move == 'engage') {
            if($_SESSION['x'] == -1 and $_SESSION['y'] == -1 or $_SESSION['x'] == -1 and $_SESSION['y'] == -3) {
                $msg = "Fight Time!";
            } else {
                $emsg = "you can't fight here";
            }

        } elseif($move == 'leave') {
            if($_SESSION['x'] == -1 and $_SESSION['y'] == -1 or $_SESSION['x'] == -1 and $_SESSION['y'] == -3) {

                $_SESSION['x'] = $_SESSION['x'] + 1;
                echo "you ran from the fight";

            } else {
                echo "there is nothing to run away from!";
            }
            // shield
        } elseif($move == 'drink shieldpotion' or $move == 'drink shield') {
            if(in_array("shieldpotion", $inventory)) {
                $_SESSION['shield'] = $_SESSION['shield'] + 25;
                $key2 = array_search("shieldpotion", $_SESSION['inventory']);
                unset($_SESSION['inventory'][$key2]);
                $msg = "you drank the shield potion!";
            } else {
                $emsg = "You have nothing to drink!";
            }
            //health
        } elseif($move == 'drink healthpotion' or $move == 'drink health') {
            if(in_array("healthpotion", $inventory)) {
                if($health < 100) {
                    $_SESSION['health'] = 100;
                    $key2 = array_search("healthpotion", $_SESSION['inventory']);
                    unset($_SESSION['inventory'][$key2]); 
                } else {
                    $emsg = "You cannot do that. You must be hurt in order to drink this potion";
                }
            } else {
                $emsg = "You have nothing to drink!";
            }
            // accuracy
        } elseif($move == 'drink accuracypotion' or $move == 'drink accuracy') {
            if(in_array("accuracypotion", $inventory)) {
                $macedmg = $macedmg + 10;
                $daggerdmg = $daggerdmg + 10;
                $sworddmg = $sworddmg + 10;
                $msg = "you drank the accuracy potion!";
                $key2 = array_search("accuracypotion", $_SESSION['inventory']);
                unset($_SESSION['inventory'][$key2]);
            } else {
                $emsg = "You have nothing to drink!";
            }

            // shield
        } elseif($move == 'pickup potion' or $move == 'pickup shieldpotion') {
            if($_SESSION['x'] == -1 and $_SESSION['y'] == 0){
                array_push($inventory, "shieldpotion");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up a shield potion." . "<br>" . "As you were picking up the potion you stepped on a spike and lost some health.";
                $health = $health - 10;
	            $_SESSION['health'] = $health;
            } else {
                $emsg = "There is nothing to pickup!";
            }

            // key
        } elseif($move == 'pickup key') {
            if($_SESSION['x'] == -2 and $_SESSION['y'] == 0){
                array_push($inventory, "key");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up a key";
                $key = $key + 1;
            } else {
                $emsg = "There is nothing to pickup!";
            }

            // dagger
        } elseif($move == 'pickup dagger') {
            if($_SESSION['x'] == -2 and $_SESSION['y'] == -1){
                array_push($inventory, "dagger");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up a dagger" ;
            } else {
                $emsg = "There is nothing to pickup!";
            }

            // mace
        } elseif($move == 'pickup mace') {
            if($_SESSION['x'] == -2 and $_SESSION['y'] == -1){
                array_push($inventory, "mace");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up a mace" ;
            } else {
                $emsg = "There is nothing to pickup!";
            }

            // health potion
        } elseif($move == 'pickup potion' or $move == 'pickup healthpotion') {
            if($_SESSION['x'] == 0 and $_SESSION['y'] == -2){
                array_push($inventory, "healthpotion");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up a health potion" ;
            } else {
                $emsg = "There is nothing to pickup!";
            }

            // accuracy potion
        } elseif($move == 'pickup potion' or $move == 'pickup accuracypotion') {
            if($_SESSION['x'] == -3 and $_SESSION['y'] == -3){
                array_push($inventory, "accuracypotion");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up an accuracy potion" ;
            } else {
                $emsg = "There is nothing to pickup!";
            }

            // sword
        } elseif($move == 'pickup sword') {
            if($_SESSION['x'] == 0 and $_SESSION['y'] == -2){
                array_push($inventory, "sword");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up a sword" ;
            } else {
                $emsg = "There is nothing to pickup!";
            }
            // gold
        } elseif($move == 'pickup gold') {
            if($_SESSION['x'] == -3 and $_SESSION['y'] == -3){
                array_push($inventory, "gold");
                $_SESSION['inventory'] = $inventory;
                $msg  = "You picked up gold" ;
            } else {
                $emsg = "There is nothing to pickup!";
            }

        } elseif($move == 'bribe guard' or $move == 'use gold') {
            if($_SESSION['x'] == 0 and $_SESSION['y'] == -3) {
                if(in_array("gold", $inventory)) {
                    $msg = "You bribed the guard. You can now move towards the west where the castle lies.";
                } else {
                    $emsg = "You don't have any gold! you must collect gold to move past the guard.";
                }
            }

        } elseif($move == 'use key') {
            if($_SESSION['x'] == -3 and $_SESSION['y'] == 0) {
                if(in_array("key", $inventory)) {
                    $_SESSION['x'] = -3;
                    $_SESSION['y'] = 0;
                    $msg = "Gate unlocked! you can now procced through the gate.";
                } else {
                    $_SESSION['x'] = -3;
                    $_SESSION['y'] = 0;
                    $emsg = "You need a key to pass through the gate";
                }
            }

        } elseif($move == 'use key') {
            if($_SESSION['x'] == -2 and $_SESSION['y'] == -2) {
                if(in_array("key", $inventory)) {
                    $_SESSION['x'] = -2;
                    $_SESSION['y'] = -2;
                    $msg = "Gate unlocked! you can now procced through the gate.";
                } else {
                    $_SESSION['x'] = -2;
                    $_SESSION['y'] = -2;
                    $emsg = "You need a key to pass through the gate";
                }
            }
        }

    } else {
        $emsg = "I do not understand the word: " . "*" . $move . "*" . ", it does not exist or it is mispelt";
    }

    // goblin fight
    if($_SESSION['x'] == -1 and $_SESSION['y'] == -1) {
        if($move == 'hit dagger'){

            if($shield == 25){

                $goblindmg = $goblindmg - 25;

            }
        
        if(in_array("dagger", $inventory)) {
            $goblinhp = $goblinhp - $daggerdmg; 
        }

        $health = $health - $goblindmg;

        $_SESSION['health'] = $health; 

        $_SESSION['goblinhp'] = $goblinhp; 

        if($_SESSION['health'] <= 0){

            //reset hp and position if defeated

            $health = 100; 

            $goblinhp = 100;

            $msg = "You were defeated by the goblin and become stranded again";

            $_SESSION['goblinhp'] = $goblinhp; 

            $_SESSION['health'] = $health;  

            $_SESSION['x'] = 0;
            $_SESSION['y'] = 0;
            $_SESSION['shield'] = 0;
            unset($_SESSION['inventory']);

        }

        if($_SESSION['goblinhp'] <= 0){

            $_SESSION['x'] = 0 ;
            $_SESSION['y'] = -1 ;

            $msg = "You have defeated the goblin! You can now advance"; 
            }
        } elseif($move == 'hit mace'){

            if($shield == 25){

                $goblindmg = $goblindmg - 25;

            }
        
        if(in_array("mace", $inventory)) {
            $goblinhp = $goblinhp - $macedmg; 
        }

        $health = $health - $goblindmg;

        $_SESSION['health'] = $health; 

        $_SESSION['goblinhp'] = $goblinhp; 

        if($_SESSION['health'] <= 0){

            //reset hp and position if defeated

            $health = 100; 

            $_SESSION['shield'] = 0;
            
            unset($_SESSION['inventory']);

            $goblinhp = 100;

            $msg = "You were defeated by the goblin and become stranded again";

            $_SESSION['goblinhp'] = $goblinhp; 

            $_SESSION['health'] = $health;  

            $_SESSION['x'] = 0 ;
            $_SESSION['y'] = 0 ;

        }

        if($_SESSION['goblinhp'] <= 0){

            $_SESSION['x'] = 0 ;
            $_SESSION['y'] = -1 ;

            $msg = "You have defeated the goblin! You can now advance"; 
            }
        }
    }
    // knight 
    if($_SESSION['x'] == -1 and $_SESSION['y'] == -3) {
        if($move == 'hit dagger'){

            if($shield == 25){

                $knightdmg = $knightdmg - 25;

            }
        
        if(in_array("dagger", $inventory)) {
            $knighthp = $knighthp - $daggerdmg; 
        }

        $health = $health - $knightdmg;

        $_SESSION['health'] = $health; 

        $_SESSION['knighthp'] = $knighthp; 

        if($_SESSION['health'] <= 0){

            //reset hp and position if defeated

            $health = 100; 
            $knighthp = 100;
            $msg = "You were defeated by the knight and become stranded again";
            $_SESSION['knighthp'] = $knighthp; 
            $_SESSION['health'] = $health;  
            $_SESSION['x'] = 0;
            $_SESSION['y'] = 0;
            unset($_SESSION['inventory']);
            $_SESSION['shield'] = 0;

        }

        if($_SESSION['knighthp'] <= 0){
            header('location:endscreen.php'); 
            }
        } elseif($move == 'hit mace'){

            if($shield == 25){
    
                $knightdmg = $knightdmg - 25;
    
            }
        
        if(in_array("mace", $inventory)) {
            $knighthp = $knighthp - $macedmg; 
        }
    
        $health = $health - $knightdmg;
    
        $_SESSION['health'] = $health; 
    
        $_SESSION['knighthp'] = $knighthp; 
    
        if($_SESSION['health'] <= 0){
    
            //reset hp and position if defeated
    
            $health = 100; 
            
            $knighthp = 100;
    
            $msg = "You were defeated by the knight and become stranded again";
    
            $_SESSION['knighthp'] = $knighthp; 
    
            $_SESSION['health'] = $health;  
    
            $_SESSION['x'] = 0;
            $_SESSION['y'] = 0;
            $_SESSION['shield'] = 0;
            unset($_SESSION['inventory']);
    
        }
    
        if($_SESSION['knighthp'] <= 0){
            header('location:endscreen.php'); 
            }
        } elseif($move == 'hit sword'){
    
            if($shield == 25){
    
                $knightdmg = $knightdmg - 25;
    
            }
        
        if(in_array("sword", $inventory)) {
            $knighthp = $knighthp - $sworddmg; 
        }
    
        $health = $health - $knightdmg;
    
        $_SESSION['health'] = $health; 
    
        $_SESSION['knighthp'] = $knighthp; 
    
        if($_SESSION['health'] <= 0){
    
            //reset hp and position if defeated
    
            $health = 100; 
            
            $knighthp = 100;
    
            $msg = "You were defeated by the knight and become stranded again";
    
            $_SESSION['knighthp'] = $knighthp; 
    
            $_SESSION['health'] = $health;  
    
            $_SESSION['x'] = 0;
            $_SESSION['y'] = 0;
            $_SESSION['shield'] = 0;
            unset($_SESSION['inventory']);
    
        }
    
        if($_SESSION['knighthp'] <= 0){
            $_SESSION['x'] = 0;
            $_SESSION['y'] = 0;
            $health = 100;
            $_SESSION['health'] = 100;
            $_SESSION['shield'] = 0;
            unset($_SESSION['inventory']);
            $title = $start_title;
            $desc = $start_desc;	
            $knighthp = 100;
            $goblinhp = 100;
            header('location:endscreen.php'); 
            }
        }
    } 
}   

if($_SESSION['x'] == -1 and $_SESSION['y'] == -1) {
    $enemyhealth = $goblinhp;
} elseif($_SESSION['x'] == -1 and $_SESSION['y'] == -3) {
    $enemyhealth = $knighthp;
} else {
    $enemyhealth = 0;
}

?>