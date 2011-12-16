<?php
    function add_post($title, $contents, $category) {
        $title = mysql_real_escape_string($title);
        $contents = mysql_real_escape_string($contents);
        $category = (int)$category;

        mysql_query("INSERT INTO `posts` SET `cat_id` = {$category}, `title` = '{$title}', `contents` = '{$contents}', `date_posted` = NOW()");
    }

    function edit_post($id, $title, $contents, $category) {
        $id = (int)$id;
        $title = mysql_real_escape_string($title);
        $contents = mysql_real_escape_string($contents);
        $category = (int)$category;

        mysql_query("UPDATE `post` SET `cat_id` = '{$category}', `title` = '{$title}', `contents` = '{$contents}' WHERE `id` = '{$id}'");
    }

    function add_category($name) {
        $name = mysql_real_escape_string($name);
        $query = mysql_query("INSERT INTO categorias(nombre) VALUES ('{$name}')");
    }

    function delete($table, $id) {
        $table = mysql_real_escape_string($table);
        $id = (int)$id;

        mysql_query("DELETE FROM {$table} WHERE id = {$id}");
    }

    function get_posts($id = null, $cat_id = null) {
        $posts = array();

        $query = "SELECT `posts`.`id` AS `post_id`, `categorias`.`id` AS `category_id`, `title`, `contents`, `date_posted`, `nombre`
                  FROM `posts`
                  INNER JOIN `categorias` ON `categorias`.`id` = `posts`.`cat_id`";

        if (isset($id)) {
            $id = (int)$id;
            $query .= "WHERE `posts`.`id` = '{$id}'";
        }

        if (isset($cat_id)) {
            $cat_id = (int)$cat_id;
            $query .= "WHERE `cat_id` = '{$cat_id}'";
        }

        $query .= "ORDER BY `posts`.`id` DESC";

        $query = mysql_query($query);

        while ($row = mysql_fetch_assoc($query)) {
            $posts[] = $row;
        }

        return $posts;
    }

    function get_categories($id = null) {
        $categories = array();

        $query = mysql_query("SELECT id, nombre FROM categorias");

        while ($row = mysql_fetch_assoc($query)) {
            $categories[] = $row;
        }

        return $categories;
    }

    function category_exists($field, $value) {
        $field = mysql_real_escape_string($field);
        $value = mysql_real_escape_string($value);

        if ($field == "id") {
            $query = mysql_query("SELECT COUNT(1) FROM categorias WHERE id = '{$value}'");
        } else {
            $query = mysql_query("SELECT COUNT(1) FROM categorias WHERE nombre = '{$value}'");
        }

        return (mysql_result($query, 0) == '0') ? false : true;
    }
?>
