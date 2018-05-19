<?php

require_once 'services/users_service.php';
require_once 'services/articles_service.php';

require_once 'models/users.php';
require_once 'models/articles.php';


function is_set_in()
{
    foreach (array_slice(func_get_args(), 1) as $v) {
        if (!isset(func_get_arg(0)[$v])) return false;
    }
    return true;
}

function is_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}


function set_error_message($msg)
{
    $_SESSION['msg_err'] = $msg;
}

function has_error_message()
{
    return isset($_SESSION['msg_err']) && strlen($_SESSION['msg_err']) > 0;
}

function get_error_message()
{
    if (has_error_message()) {
        $msg = $_SESSION['msg_err'];
        $_SESSION['msg_err'] = NULL;
        return $msg;
    }
    return "";
}

function set_success_message($msg)
{
    $_SESSION['msg_success'] = $msg;
}

function has_success_message()
{
    return isset($_SESSION['msg_success']) && strlen($_SESSION['msg_success']) > 0;
}

function get_success_message()
{
    if (has_success_message()) {
        $msg = $_SESSION['msg_success'];
        $_SESSION['msg_success'] = NULL;
        return $msg;
    }
    return "";
}

function html_message()
{
    if (!isset(getallheaders()['Location'])) {
        if (has_error_message()) { ?> <h3>Error: <?php echo get_error_message() ?></h3> <?php }
        if (has_success_message()) { ?> <h3>Success: <?php echo get_success_message() ?></h3> <?php }
    }
}