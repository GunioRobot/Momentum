<?php
    include_once 'resources/init.php';
    
    $post = get_posts($_GET['id']);
    
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
            edit_post($_GET['id'], $title, $contents, $_POST['category']);
            
            header("Location: index.php?id={$post[0]['post_id']}");
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
        
        <title>Editar post</title>
    </head>
    <body>
        <h1>Editar post</h1>
        <?php 
            if (isset($errors) && !empty($errors)) {
                echo "<ul><li>",implode("</li><li>", $errors),"</li></ul>";
            }
        ?>
        <form action="" method="POST">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo $post[0]['title']?>"/>
            </div>
            <div>
                <label for="contents">Contents</label>
                <textarea name="contents" rows="15" cols="50"><?php echo $post[0]['contents']; ?></textarea>
            </div>
            <div>
                <label for="category">Category</label>
                <select name="category">
                    <?php 
                        foreach (get_categories() as $category) {
                            $selected = ($category['name'] == $post[0]['name']) ? ' selected' : ''; ?>
                            <option value="<?php echo $category['id']; ?>"<?php echo $selected; ?>><?php echo $category['nombre']; ?></option>
                        <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Editar post"></input>
            </div>
        </form>
    </body>
</html>
