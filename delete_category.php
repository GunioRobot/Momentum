<?php
    include_once 'resources/init.php';
    
    if (!isset($_GET['id'])) {
        header('Location: index.php');
        die();
    }
    
    delete("categorias", $_GET['id']);
    
    header('Location: category_list.php');
    die();
?>
