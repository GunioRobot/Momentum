<?php 
    include_once 'resources/init.php';

    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
        
        if (empty($name)) {
            $error = "Debes poner un nombre a la categoria.";
        } else if (category_exists('name', $name)) {
            $error = "Esa categoria ya existe.";
        } else if (strlen($name) > 24) {
            $error = "El nombre de la categoria no puede ser mayor de 24 caracteres.";
        }
        
        if (!isset($error)) {
            add_category($name);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="Content-Type" content="IE=edge,chrome=1">
        <title>Agregar categorias</title>
    </head>
    <body>
        <h1>Agregar categoria</h1>
        
        <?php
            if (isset($error)) {
                echo "<p>$error</p>\n";
            }
        ?>
        
        <form action="" method="POST">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" value=""/>
            </div>
            <div>
                <input type="submit" value="Agregar categoria"/>
            </div>
        </form>
    </body>
</html>
