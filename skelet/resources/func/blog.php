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
    $id = (int)$_GET['id'];
    $title = mysql_real_escape_string($title);
    $contents = mysql_real_escape_string($contents);
    $category = (int)$category;

    mysql_query("UPDATE `posts` SET
                  `cat_id` = {$category},
                  `title` = '{$title}',
                  `contents` = '{$contents}',
                  WHERE `id` = {$id}");
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

    mysql_query("DELETE FROM {$table} WHERE `id`={$id}");
}

function get_posts($id = null, $cat_id = null)
{
    $posts = array();

    $query = "SELECT `posts`.`id` AS `post_id`,
                     `categories`.`id` AS `category_id`,
                `title`, `contents`, `date_posted`, `categories`.`name`
                FROM `posts`
                INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id`";

    if(isset($id)) {
        $id = (int)$id;
        $query .= "WHERE `posts`.`id` = '{$id}'";
    }

    if(isset($cat_id)) {
        $cat_id = (int)$cat_id;
        $query .= "WHERE `cat_id` = '{$cat_id}'";
    }

    $query .= "ORDER BY `posts`.`id` DESC";

    $query = mysql_query($query);

    while($row = mysql_fetch_assoc($query)){
        $posts[] = $row;
    }

    return $posts;
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


// this function is used only for presentation - created views/elements/category.php to replace it - still accepts $posts variable
function display_content($posts)
{
//    foreach ($posts as $post):
//
//        ?>
<!--        <h2><a href="index.php?id=--><?//=$post['post_id']?><!--">--><?//=$post['title']?><!--</a></h2>-->
<!--        <div>--><?//=nl2br($post['contents'])?><!--</div>-->
<!--        <div>-->
<!--            <p>Posted on --><?//=date('d-m-Y h:i:s', strtotime($post['date_posted']))?>
<!--                in <a href="category.php?id=--><?//=$post['category_id']?><!--">--><?//=$post['name']?><!--</a>-->
<!--            </p>-->
<!--        </div>-->
<!---->
<!--        <menu>-->
<!--            <ul>-->
<!--                <li><a href="delete_post.php?id=--><?//=$post['post_id']?><!--">Delete This Post</a></li>-->
<!--                <li><a href="edit_post.php?id=--><?//=$post['post_id']?><!--">Edit This Post</a></li>-->
<!--            </ul>-->
<!--        </menu>-->
<!--    --><?php //endforeach; ?>
<?php
}

?>
 