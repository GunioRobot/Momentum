<?php
    include_once 'resources/init.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="Content-Type" content="IE=edge,chrome=1">
        <title>Lista de categorias</title>
    </head>
    <body>
        <?php
            foreach (get_categories() as $category) {?>
        <p><a href="category.php?id=<?php echo $category['id']; ?>"><?php echo $category['nombre']?></a> - <a href="delete_category.php?id=<?php echo $category['id']; ?>">Borrar</a></p>
        <?php
            }
        ?>
    </body>
</html>
