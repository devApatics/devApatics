<?php
session_start();


if (isset($_SESSION['is_modal'])) {
        if($_POST['id'] == 'provider'){
            echo json_encode(0);
        }
        if($_POST['id'] == 'fraud'){
            echo json_encode(1);
        }
        //return true;
        //echo "session";
        // echo json_encode(true);
    }
    else{
        echo json_encode(false);
        //return false;
        //echo "session not";
    }


?>