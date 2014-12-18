<?php
require_once('resources/init.php');

$element = 'views/elements/register_form.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';


if (!empty($_POST)) {

    if (empty($_POST['username'])) {
        die("Please enter a username.");
    }

    if (empty($_POST['password'])) {
        die("Please enter a password.");
    }

    $query = "
            SELECT
                1
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
    } // remove getMessage on production
    catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }

    $row = $stmt->fetch();

    if ($row) {
        die("This username is already in use");
    }

    $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";

    $query_params = array(
        ':email' => $_POST['email']
    );

    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }

    $row = $stmt->fetch();

    if ($row) {
        die("This email address is already registered");
    }

    $query = "
            INSERT INTO users (
                username,
                password,
                email
            ) VALUES (
                :username,
                :password,
                :email
            )
        ";

    $salt = "hdhwYU*w(544OIOw";
    $password = md5($_POST['password'] . $salt);

    $query_params = array(
        ':username' => $_POST['username'],
        ':password' => $password,
        ':email' => $_POST['email']
    );

    try {
        // Execute the query to create the user
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }

    header("Location: login.php");

    die("Redirecting to login.php");
}