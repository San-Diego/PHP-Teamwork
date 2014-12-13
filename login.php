<?php
require_once('resources/init.php');

if(isset($_SESSION['user'])) {
    header('Location: index.php');
    die('Already logged in, redirecting to index.php');
}

$element = 'views/elements/login_form.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';

$submitted_username = '';

if(!empty($_POST)) {

    $query = "
            SELECT
                id,
                username,
                password,
                email
            FROM users
            WHERE
                username = :username
        ";

    $query_params = array(
        ':username' => $_POST['username']
    );

    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    $login_ok = false;

    $row = $stmt->fetch();
    if ($row) {

		$salt = "hdhwYU*w(544OIOw";
		$check_password = md5($_POST['password']+$salt);	

        if ($check_password === $row['password']) {
            $login_ok = true;
        }
    }

    if ($login_ok) {

        unset($row['salt']);
        unset($row['password']);

        $_SESSION['user'] = $row;

        header("Location: index.php");
        die("Redirecting to: index.php");
    } else {

        print("Login Failed.");

        $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
    }
}
?>