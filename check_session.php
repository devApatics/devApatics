<?php
session_start();

if (isset($_SESSION['is_modal'])) // For check the session variable
{
        if($_POST['id'] == 'provider') // For check the blog page modal id 
        {
            echo json_encode(0);
        }
        if($_POST['id'] == 'fraud') // For check the blog page modal id 
        {
            echo json_encode(1);
        }
    }
    else{
        echo json_encode(false); // If session var not exist.
    }


?>