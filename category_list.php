<?php

require_once('resources/init.php');
$categories = get_categories();
$element = 'views/elements/category_list.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';

