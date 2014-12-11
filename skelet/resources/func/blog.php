<?php

function add_post($title, $contents, $category)
{
    $title = mysql_real_escape_string($title);
    $contents = mysql_real_escape_string($contents);
    $category = (int)$category;
    mysql_query("INSERT INTO `posts` SET
                    `cat_id` = '{$category}',
                    `title` = '{$title}',
                    `contents` = '{$contents}',
                    `date_posted` = NOW() ");
}

function edit_post($title, $contents, $category)
{

}

function add_category($name)
{
    $name = mysql_real_escape_string($name);

    mysql_query("INSERT INTO `categories` SET `name` = '{$name}'");
}

function delete($table, $id)
{
    $table = mysql_real_escape_string($table);
    $id = (int)$id;

    mysql_query("DELETE FROM `{$table}` WHERE `id`={$id}");
}

function get_posts($id = null, $cat_id = null)
{

}

function get_categories($id = null)
{
    $categories = array();

    $query = mysql_query("SELECT `id`, `name` FROM `categories`");

    while($row = mysql_fetch_assoc($query)) {
        $categories[] = $row;
    }

    return $categories;

}

function category_exist($field, $value)
{
    $field = mysql_real_escape_string($field);
    $value = mysql_real_escape_string($value);


    $query = mysql_query("SELECT COUNT(1) FROM `categories` WHERE `{$field}`='{$value}'");

    echo mysql_error();

    return(mysql_result($query, 0) == '0') ? false : true;
}

?>
 