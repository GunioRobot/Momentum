<?php
    include_once 'resources/init.php';
    
    if (isset($_GET['id'])) {
        header('Location: index.php');
        die();
    }
    
    delete();
    
    header('Location: index.php');
    die();
?>
