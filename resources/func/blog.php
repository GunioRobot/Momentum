<?php
    function add_post($title, $contents, $category) {
        
    }
    
    function edit_post($id, $title, $contents, $category) {
        
    }
    
    function add_category($name) {
        $name = mysql_real_escape_string($name);
        $query = mysql_query("INSERT INTO categorias(nombre) VALUES ('{$name}')") or die(mysql_error());
    }
    
    function delete($field, $id) {
        
    }
    
    function get_posts($id = null, $cat_id = null) {
        
    }
    
    function get_categories($id = null) {
        
    }
    
    function category_exists($name) {
        $name = mysql_real_escape_string($name);
        $query = mysql_query("SELECT COUNT(1) FROM categorias WHERE nombre = '{$name}'");
        
        return (mysql_result($query, 0) == '0') ? false : true;
    }
?>
