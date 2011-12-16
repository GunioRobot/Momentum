<?php
    include_once 'resources/init.php';

    $posts = (isset($_GET['id'])) ? get_posts($_GET['id']) : get_posts();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="Content-Type" content="IE=edge,chrome=1">
        <title>Momentum.</title>
        <style>
            ul {
                list-style: none;
            }

            li {
                display: inline;
                margin-right: 20px;
            }
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php">Index</a></li>
                <li><a href="add_post.php">Agregar post</a></li>
                <li><a href="add_category.php">Agregar categoria</a></li>
                <li><a href="category_list.php">Lista de categorias</a></li>
            </ul>
        </nav>
        <h1>Momentum.</h1>
        <?php
            foreach ($posts as $post) {
                if (!category_exists('nombre', $post['nombre'])) {
                    $post['nombre'] = "Sin categoria";
                }?>
                <h2><a href="index.php?id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?></a></h2>
                <p>Posted on <?php echo date("d-m-Y h:i:s", strtotime($post['date_posted'])); ?>
                    en <a href="category.php?id=<?php echo $post['category_id'] ?>"><?php echo $post['nombre']; ?></a>
                </p>
                <div><?php echo nl2br($post['contents']); ?></div>
                <menu>
                    <ul>
                        <li><a href="delete_post.php?id=<?php echo $post['post_id']; ?>">Borrar post</a></li>
                        <li><a href="edit_post.php?id=<?php echo $post['post_id']; ?>">Editar post</a></li>
                    </ul>
                </menu>
            <?php
            }
        ?>
    </body>
</html>
