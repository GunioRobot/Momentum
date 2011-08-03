<?php
    include_once 'resources/init.php';
    
    if (isset($_POST['title'], $_POST['contents'], $_POST['category'])) {
        $errors = array();
        
        $title = trim($_POST['title']);
        $contents = trim($_POST['contents']);
        
        if (empty($title)) {
            $errors[] = "Por favor, agrega un titulo.";
        } else if (strlen($title) > 255) {
            $errors[] = "El titulo no puede ser mas largo de 255 caracteres.";
        }
        
        if (empty($contents)) {
            $errors[] = "Por favor, agrega contenido.";
        } 
        
        if (!category_exists('id', $_POST['category'])) {
            $errors[] = "La categoria no existe.";
        }
        
        if (empty($errors)) {
            add_post($title, $contents, $_POST['category']);
            
            $id = mysql_insert_id();
            
            header("Location: index.php?id={$id}");
            die();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="Content-Type" content="IE=edge,chrome=1">
        
        <style>
            label {
                display: block;
            }
        </style>
        
        <title>Agregar post</title>
    </head>
    <body>
        <h1>Agrega un post</h1>
        <?php 
            if (isset($errors) && !empty($errors)) {
                echo "<ul><li>",implode("</li><li>", $errors),"</li></ul>";
            }
        ?>
        <form action="" method="POST">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php if (isset($_POST['title'])) { echo $_POST['title']; } ?>"/>
            </div>
            <div>
                <label for="contents">Contents</label>
                <textarea name="contents" rows="15" cols="50"><?php if (isset($_POST['contents'])) { echo $_POST['contents']; } ?></textarea>
            </div>
            <div>
                <label for="category">Category</label>
                <select name="category">
                    <?php 
                        foreach (get_categories() as $category) {?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['nombre']; ?></option>
                        <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Agregar post"></input>
            </div>
        </form>
    </body>
</html>
